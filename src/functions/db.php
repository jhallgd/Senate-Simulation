<?php

class database
{

	private $username;
	private $password;
	private $host;
	private $port;
	private $database_name;
	private $conn;


	// Constructor
	public function __construct()
	{
		$this->load_environment();
		$this->username = $this->get_env('DB_USERNAME', '');
		$this->password = $this->get_env('DB_PASSWORD', '');
		$this->host = $this->get_env('DB_HOST', 'localhost');
		$this->port = $this->get_env('DB_PORT', '3306');
		$this->database_name = $this->get_env('DB_DATABASE', '');
		$this->conn = $this->create_connection();
		$this->initialize_admin_account();
	}

	private function create_connection(): PDO
	{
		$hosts_to_try = [$this->host];

		// If the Docker service alias is configured but not resolvable (e.g., shared hosting),
		// try standard local MySQL hosts before failing.
		if (strtolower($this->host) === 'database') {
			$hosts_to_try[] = 'localhost';
			$hosts_to_try[] = '127.0.0.1';
		}

		$hosts_to_try = array_values(array_unique($hosts_to_try));
		$last_exception = null;

		foreach ($hosts_to_try as $host) {
			try {
				return new PDO(
					$this->build_dsn($host),
					$this->username,
					$this->password,
					[
						PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					]
				);
			} catch (PDOException $exception) {
				$last_exception = $exception;
			}
		}

		if ($last_exception !== null) {
			throw $last_exception;
		}

		throw new PDOException('Unable to establish database connection.');
	}

	private function build_dsn(string $host): string
	{
		return 'mysql:host=' . $host . ';port=' . $this->port . ';dbname=' . $this->database_name;
	}

	private function load_environment()
	{
		$current_dir = __DIR__;
		while ($current_dir !== '/' && $current_dir !== '.') {
			$env_file = $current_dir . DIRECTORY_SEPARATOR . '.env';
			if (is_file($env_file)) {
				$loaded_any = false;
				$lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				foreach ($lines as $line) {
					$trimmed_line = trim($line);
					if ($trimmed_line === '' || strpos($trimmed_line, '#') === 0) {
						continue;
					}
					if (strpos($line, '=') === false) {
						continue;
					}
					$parts = explode('=', $line, 2);
					$name = trim($parts[0]);
					$value = trim($parts[1] ?? '');
					if ($name !== '') {
						$_ENV[$name] = $value;
						putenv($name . '=' . $value);
						$loaded_any = true;
					}
				}

				if ($loaded_any) {
					break;
				}
			}

			$parent_dir = dirname($current_dir);
			if ($parent_dir === $current_dir) {
				break;
			}
			$current_dir = $parent_dir;
		}
	}

	private function get_env(string $key, string $default): string
	{
		if (array_key_exists($key, $_ENV) && $_ENV[$key] !== '') {
			return $_ENV[$key];
		}

		$from_env = getenv($key);
		if ($from_env !== false && $from_env !== '') {
			return $from_env;
		}

		return $default;
	}

	private function get_connection()
	{
		return $this->conn;
	}

	public function initialize_admin_account(): void
	{
		try {
			$admin_table_exists = $this->conn->query("SHOW TABLES LIKE 'Admins'")->rowCount() > 0;
			if (!$admin_table_exists) {
				return;
			}

			$existing_admins = $this->conn->query('SELECT COUNT(*) AS admin_count FROM Admins')->fetch(PDO::FETCH_ASSOC);
			if ((int) $existing_admins['admin_count'] > 0) {
				return;
			}

			$username = $this->get_env('ADMIN_USERNAME', 'admin');
			$password = $this->get_env('ADMIN_PASSWORD', 'test123');
			$password_hash = password_hash($password, PASSWORD_DEFAULT);

			$statement = $this->conn->prepare('INSERT INTO Admins (ad_username, ad_password) VALUES (:username, :password)');
			$statement->execute([
				':username' => $username,
				':password' => $password_hash,
			]);
		} catch (Exception $exception) {
			// Ignore bootstrap failures during startup so the app can continue to load.
		}
	}

	public function get_data(string $sql)
	{
		$data = [];
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			$data = $dataset;
		}
		return $data;
	}

	// Run transaction
	public function run_transaction(array $sqls): bool
	{
		$this->conn->beginTransaction();
		foreach ($sqls as $sql) {
			$sth = $this->conn->prepare($sql);
			$sth->execute();
		}
		$update = $this->conn->commit();
		if ($update === false) {
			$this->conn->rollBack();
		}

		return $update;
	}

	// Gets all items from table
	public function get_all($table_name)
	{
		$sql = "SELECT * FROM $table_name;";
		$data = $this->get_data($sql);
		return $data;
	}

	// Check if data exists
	public function check_data($sql)
	{
		$result = $this->conn->query($sql)->rowCount();
		return $result >= 1;
	}

	// Update Success 
	public function update_data($sql)
	{
		return $this->conn->query($sql) == TRUE;
	}

	// Get the Column names
	public function get_column_names($table_name)
	{
		$sql = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table_name' ORDER BY ordinal_position;";
		$columns = $this->conn->query($sql);
		return $columns;
	}

	// Senator Functions
	public function create_senator(senators $senator, int $default_vt): bool
	{
		$this->conn->beginTransaction();

		if ($senator->get_pa_id() == 0) {
			$party_id = 'NULL';
		} else {
			$party_id = $senator->get_pa_id();
		}
		$senator_sql = 'INSERT INTO `Senators` (se_first_name, se_last_name, se_title, se_pa_id)
        VALUES ("' . $senator->get_first_name() . '", 
        "' . $senator->get_last_name() . '", 
        "' . $senator->get_title() . '", 
        ' . $party_id . ');';

		$sth = $this->conn->prepare($senator_sql);
		$sth->execute();

		$id_sql = 'SELECT se_id FROM Senators ORDER BY se_id DESC LIMIT 1;';
		$id_array = $this->get_data($id_sql);
		$id = $id_array[0]['se_id'];
		$votes_sql = 'INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) SELECT ' . $default_vt . ' AS "vo_vt_id", ' . $id . ' AS "vo_se_id", bl_id as "vo_bl_id" FROM Bills';

		$sth = $this->conn->prepare($votes_sql);
		$sth->execute();

		$update = $this->conn->commit();
		if ($update === false) {
			$this->conn->rollBack();
		}

		return $update;

	}

	// Bill Functions
	public function create_bill(bills $bill, int $default_pv, int $default_vt): bool
	{
		$this->conn->beginTransaction();

		//Add Bill
		$bill_sql = 'INSERT INTO `Bills` (bl_title, bl_short_text, bl_url)
        VALUES ("' . $bill->get_bill_title() . '", 
        "' . $bill->get_bill_short_text() . '", 
        "' . $bill->get_bill_url() . '");';

		$sth = $this->conn->prepare($bill_sql);
		$sth->execute();

		$id_sql = 'SELECT bl_id FROM Bills ORDER BY bl_id DESC LIMIT 1;';
		$id_array = $this->get_data($id_sql);
		$bill_id = $id_array[0]['bl_id'];

		//Add Bill Party View
		$bill_party_sql = 'INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) SELECT ' . $default_pv . ' AS "pb_pvt_id", pa_id AS "pb_pa_id", ' . $bill_id . ' as "pb_bl_id" FROM Parties';

		$sth = $this->conn->prepare($bill_party_sql);
		$sth->execute();

		//Add Votes
		$votes_sql = 'INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) SELECT ' . $default_vt . ' AS "vo_vt_id", se_id AS "vo_se_id", ' . $bill_id . ' as "vo_bl_id" FROM Senators';
		$sth = $this->conn->prepare($votes_sql);
		$sth->execute();

		$update = $this->conn->commit();
		if ($update === false) {
			$this->conn->rollBack();
		}

		return $update;
	}
	// Party Functions
	public function create_party(parties $party, int $default_pvt): bool
	{
		$this->conn->beginTransaction();
		// Add Party
		$party_sql = 'INSERT INTO `Parties` (pa_name, pa_location, pa_color)
        VALUES ("' . $party->get_party_name() . '", 
        "' . $party->get_party_location() . '", 
        "' . $party->get_party_color() . '");';

		$sth = $this->conn->prepare($party_sql);
		$sth->execute();

		$id_sql = 'SELECT pa_id FROM Parties ORDER BY pa_id DESC LIMIT 1;';
		$id_array = $this->get_data($id_sql);
		$party_id = $id_array[0]['pa_id'];

		// Add Bills Parties
		$bill_party_sql = 'INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id)
		SELECT ' . $default_pvt . ' AS pb_pvt_id, ' . $party_id . ' AS pb_pa_id, bl_id as pb_bl_id FROM Bills;';

		$sth = $this->conn->prepare($bill_party_sql);
		$sth->execute();

		$update = $this->conn->commit();
		if ($update === false) {
			$this->conn->rollBack();
		}

		return $update;


	}

}
?>