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
		include_once(dirname(__DIR__) . '/objects/senators.php');
		include_once(dirname(__DIR__) . '/objects/parties.php');
		include_once(dirname(__DIR__) . '/objects/committees.php');
		include_once(dirname(__DIR__) . '/objects/bills.php');
		include_once(dirname(__DIR__) . '/objects/bills_parties.php');
		include_once(dirname(__DIR__) . '/objects/senators_committees.php');
		$this->username = "sim_admin";
		$this->password = "test123";
		$this->servername = "mysql:host=database;port=3306;dbname=senate_sim";
		$this->conn = new PDO($this->servername, $this->username, $this->password);
	}


	//  -------------------------------------------------------------------------------------------- Senator Functions
// Check Senator Id
	public function check_senator_id($se_id)
	{
		$sql = "SELECT se_id FROM Senators WHERE se_id = $se_id;";
		$result = $this->conn->query($sql)->rowCount();
		if ($result == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function get_senator_data_id($se_id)
	{
		$sql =
			"SELECT se_id, se_first_name, se_last_name, se_title, se_pa_id, pa_name 
		FROM Senators 
		LEFT JOIN Parties ON se_pa_id = pa_id 
		WHERE se_id = $se_id;";

		return $this->get_data($sql);

	}

	/**
	 * Summary of get_senator_object
	 * @param mixed $se_id
	 * @return Senators single senator object
	 */
	public function get_senator_object($se_id): Senators
	{

		$senators = [];
		$dataset = $this->get_senator_data_id($se_id);
		foreach ($dataset as $data) {

			$committees = $this->get_senator_committees_object_id($data['se_id']);
			array_push($senators, new Senators($data, $committees));
		}

		//TODO; Make sure there is only one not zero.
		return $senators[0];

	}



	// -------------------------------------------------------------------------------------------- Committee Functions

	public function get_senator_committees_data_id($se_id)
	{
		$sql = "SELECT cpt_name, sc_co_id 
		FROM SenatorsCommittees 
		LEFT JOIN CommitteePositionTypes on sc_cpt_id = cpt_id
		WHERE sc_se_id = $se_id;";
		return $this->get_data($sql);
	}



	/**
	 * Summary of get_senator_committees_object_id
	 * @param mixed $se_id the Senator Id
	 * @return array of senator_committees objects
	 */
	public function get_senator_committees_object_id($se_id): array
	{

		$com_dataset = $this->get_senator_committees_data_id($se_id);
		$senator_committees = [];
		foreach ($com_dataset as $se_co) {
			$committees_data = $this->get_committee_data_id($se_co['sc_co_id']);
			$bills_objects = $this->get_bill_object_co_id($se_co['sc_co_id']);
			array_push($senator_committees, new Senators_Committees($se_co, $committees_data[0], $bills_objects));
		}
		return $senator_committees;
	}


	// Get Committee data with id
	public function get_committee_data_id(int $co_id): array
	{
		$sql = "SELECT co_id, co_name, co_location 
		FROM Committees 
		WHERE co_id = $co_id;";
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			$data = $dataset;
		}
		return $data;

	}

	//Get Committee with id
	public function get_committee(int $co_id): array
	{
		$bills = $this->get_bill_object_co_id($co_id);
		$dataset = $this->get_committee_data_id($co_id);
		$committees = [];
		foreach ($dataset as $data) {
			array_push($committees, new Committees($data, $bills));
		}
		return $committees;
	}

	// -------------------------------------------------------------------------------------------- Bill Functions

	// Get Bill Data 
	public function get_bill_data()
	{
		$sql = "SELECT bl_title, bl_short_text, bl_url, co_name FROM CommitteesBills LEFT JOIN Committees ON cb_co_id = co_id LEFT JOIN Bills ON cb_bl_id = bl_id ORDER BY bl_title;";
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			$formated_dataset = [];
			foreach ($dataset as $item) {
				array_push($formated_dataset, [$item['bl_title'], $item['bl_short_text'], '<a href=' . $item['bl_url'] . ' target = "_blank">Click Here</a>', $item['co_name']]);
			}
			return $formated_dataset;
		}
	}

	public function get_bill_data_co_id(int $co_id)
	{
		$sql = "SELECT bl_id,
		bl_title,
		bl_short_text, 
		bl_url 
		FROM CommitteesBills 
		LEFT JOIN Bills ON cb_bl_id = bl_id
		WHERE cb_co_id = $co_id
		ORDER BY bl_title;";
		return $this->get_data($sql);
	}

	public function get_bill_object_co_id(int $co_id)
	{
		$bills_data = $this->get_bill_data_co_id($co_id);
		$bills = [];
		foreach ($bills_data as $bill) {
			array_push($bills, new Bills($bill));
		}
		return $bills;

	}
	public function get_bill_data_bi_id(int $bi_id)
	{
		$sql = "SELECT bl_id, bl_title, bl_short_text, bl_url 
		FROM Bills
		WHERE bl_id = $bi_id;";
		return $this->get_data($sql);
	}


	// -------------------------------------------------------------------------------------------- Party Functions
	/**
	 * Summary of get_party
	 * @param int $pa_id
	 * @return Parties
	 */
	public function get_party(int $pa_id)
	{
		$sql = "SELECT pa_id, pa_name, pa_location, pa_color FROM Parties WHERE pa_id = $pa_id;";
		$results = $this->conn->query($sql);

		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				$party = new Parties($data);
			}
		}
		return $party;
	}

	/**
	 * Summary of check_party_id
	 * @param mixed $pa_id
	 * @return bool
	 */
	public function check_party_id($pa_id)
	{
		$sql = "SELECT pa_id FROM Parties WHERE pa_id = $pa_id;";
		$result = $this->conn->query($sql)->rowCount();
		if ($result == 1) {
			return true;
		} else {
			return false;
		}
	}

	// Get Parties
	public function get_parties()
	{
		$sql = "SELECT pa_id,pa_name,pa_location,pa_color   FROM Parties;";
		$results = $this->conn->query($sql);
		$parties = [];
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				$party = new Parties($data);
				array_push($parties, $party);
			}
		}
		return $parties;
	}

	public function get_bill_party_data_id($pa_id)
	{
		$sql = "SELECT pb_bl_id, pa_id, pa_name, pb_view 
		FROM PartiesBills 
		LEFT JOIN Bills ON pb_bl_id = bl_id 
		LEFT JOIN Parties ON pb_pa_id = pa_id 
		WHERE pb_pa_id = $pa_id 
		ORDER BY bl_title;";
		return $this->get_data($sql);
	}

	// Get Party Views Data
	public function get_party_views($pa_id)
	{
		$dataset = $this->get_bill_party_data_id($pa_id);
		$bill_parties = [];
		foreach ($dataset as $pv) {
			$bill_data = $this->get_bill_data_bi_id($pv['pb_bl_id']);
			array_push($bill_parties, new BillsParties($pv, $bill_data[0]));
		}
		return $bill_parties;
	}


	public function create_party_senators_data_id($pa_id)
	{
		$sql = "SELECT se_id 
		FROM Senators
		WHERE se_pa_id = $pa_id;";

		return $this->get_data($sql);
	}


	public function create_party_senators($pa_id)
	{
		$dataset = $this->create_party_senators_data_id($pa_id);
		$parties_senators = [];
		foreach ($dataset as $data) {
			array_push($parties_senators, $this->get_senator_object($data['se_id']));
		}
		return $parties_senators;
	}
	/**
	 * Summary of change_party
	 * @param mixed $se_id
	 * @param mixed $pa_id
	 * @return bool
	 */
	public function change_party($se_id, $pa_id)
	{
		$sql = "UPDATE Senators SET se_pa_id = $pa_id WHERE se_id = $se_id;";
		return ($this->conn->query($sql) == TRUE);
	}

	// -------------------------------------------------------------------------------------------- MISC Functions

	private function get_data(string $sql)
	{
		$data = [];
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			$data = $dataset;
		}
		return $data;
	}

	// Gets all items from table
	public function get_all($table_name)
	{
		$sql = "SELECT * FROM $table_name;";
		$data = $this->conn->query($sql);
		return $data;
	}

	// Get the Column names
	public function get_column_names($table_name)
	{
		$sql = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table_name' ORDER BY ordinal_position;";
		$columns = $this->conn->query($sql);
		return $columns;
	}




























}
?>