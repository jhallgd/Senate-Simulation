<?php


class database
{

	private $username;
	private $password;
	private $servername;
	private $conn;


	// Constructor
	public function __construct()
	{
		$this->username = "sim_admin";
		$this->password = "test123";
		$this->servername = "mysql:host=database;port=3306;dbname=senate_sim";
		$this->conn = new PDO($this->servername, $this->username, $this->password);
	}

	private function get_connection()
	{
		return $this->conn;
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
	public function create_bill(bills $bill, int $default_pv ,int $default_vt): bool{
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
		$bill_party_sql = 'INSERT INTO `PartiesBills`(pb_pvt_id, pb_pa_id, pb_bl_id) SELECT ' . $default_pv . ' AS "pb_pvt_id", pa_id AS "pb_pa_id", '.$bill_id.' as "pb_bl_id" FROM Parties';

		$sth = $this->conn->prepare($bill_party_sql);
		$sth->execute();

		//Add Votes
		$votes_sql = 'INSERT INTO `Votes`(vo_vt_id, vo_se_id, vo_bl_id) SELECT ' . $default_vt . ' AS "vo_vt_id", se_id AS "vo_se_id", '.$bill_id.' as "vo_bl_id" FROM Senators';
		$sth = $this->conn->prepare($votes_sql);
		$sth->execute();

		$update = $this->conn->commit();
		if ($update === false) {
			$this->conn->rollBack();
		}

		return $update;
	}


}
?>