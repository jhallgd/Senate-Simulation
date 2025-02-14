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
		$this->username = "sim_admin";
		$this->password = "test123";
		$this->servername = "mysql:host=database;port=3306;dbname=senate_sim";
		$this->conn = new PDO($this->servername, $this->username, $this->password);
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

	// Get Parties
	public function get_parties()
	{
		$sql = "SELECT pa_id,pa_name,pa_location,pa_color   FROM Parties;";
		$results = $this->conn->query($sql);
		$parties = [];
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				$party = new Parties($data['pa_id'], $data['pa_name'], $data['pa_location'], $data['pa_color']);
				array_push($parties, $party);
			}
		}
		return $parties;
	}


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

	// Get Senator
	public function get_senator($se_id)
	{
		$sql = "SELECT se_id, se_first_name, se_last_name, se_title, se_co_id, co_name, se_pa_id, pa_name FROM Senators LEFT JOIN Committees ON se_co_id = co_id LEFT JOIN Parties ON se_pa_id = pa_id WHERE se_id = $se_id;";
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				if (is_null($data['co_name'])) {
					$committeeName = 'none';
				} else {
					$committeeName = $data['co_name'];
				}

				if (is_null($data['pa_name'])) {
					$partyName = 'none';
				} else {
					$partyName = $data['pa_name'];
				}
				$senator = new Senators($data['se_id'], $data['se_first_name'], $data['se_last_name'], $data['se_title'], $data['se_co_id'],$committeeName, $data['se_pa_id'], $partyName);
			}
		}
		return $senator;

	}

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

	public function change_party($se_id, $pa_id)
	{
		$sql = "UPDATE Senators SET se_pa_id = $pa_id WHERE se_id = $se_id;";
		return ($this->conn->query($sql) == TRUE);
	}

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

	// Get Committee ID from Senator ID
	public function get_committee_senator_id($se_id)
	{
		$sql = 'SELECT se_co_id FROM Senators WHERE se_id =' . $se_id;
		$results = $this->conn->query($sql);
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $item) {
				$data = $item['se_co_id'];
			}
		}
		return $data;
	}

	//Get Committee with id
	public function get_committee(int $co_id)
	{
		$sql ="SELECT bl_id, bl_title, bl_short_text, bl_url FROM CommitteesBills LEFT JOIN Bills ON cb_bl_id = bl_id WHERE cb_co_id = $co_id;";
		$results = $this->conn->query($sql);
		$bills = [];
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				array_push($bills, new Bills($data['bl_id'], $data['bl_title'], $data['bl_short_text'], $data['bl_url']));
			}
		}
		$sql = "SELECT co_id, co_name, co_location FROM Committees WHERE co_id = $co_id;";
		$results = $this->conn->query($sql);
		
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				$committee = new Committees($data['co_id'], $data['co_name'], $data['co_location'], $bills);
			}
		}
		return $committee;
	}

	public function get_party(int $pa_id)
	{
		$sql = "SELECT pa_id, pa_name, pa_location, pa_color FROM Parties WHERE pa_id = $pa_id;";
		$results = $this->conn->query($sql);
		
		while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($dataset as $data) {
				$party = new Parties($data['pa_id'], $data['pa_name'], $data['pa_location'], $data['pa_color']);
			}
		}
		return $party;
	}

		// Get Party Views Data
		public function get_party_views($pa_id)
		{
			$sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, pa_id, pa_name, pb_view FROM PartiesBills LEFT JOIN Bills ON pb_bl_id = bl_id LEFT JOIN Parties ON pb_pa_id = pa_id WHERE pb_pa_id = $pa_id ORDER BY bl_title;";
			$results = $this->conn->query($sql);
			$bill_parties = [];
			while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
				foreach ($dataset as $data) {
					array_push($bill_parties, new BillsParties($data['bl_id'], $data['bl_title'], $data['bl_short_text'], $data['bl_url'], $data['pa_id'], $data['pa_name'], $data['pb_view']));
				}
			}
			return $bill_parties;
		}

		public function create_party_senators($pa_id){
			$sql = "SELECT se_id, se_first_name, se_last_name, se_title, se_co_id, co_name, se_pa_id, pa_name FROM Senators LEFT JOIN Committees ON se_co_id = co_id LEFT JOIN Parties ON se_pa_id = pa_id WHERE pa_id = $pa_id;";
			$results = $this->conn->query($sql);
			$parties_senators = [];
			while ($dataset = $results->fetchAll(PDO::FETCH_ASSOC)) {
				foreach ($dataset as $data) {
					array_push($parties_senators, new Senators($data['se_id'], $data['se_first_name'], $data['se_last_name'], $data['se_title'], $data['se_co_id'], $data['co_name'], $data['se_pa_id'], $data['pa_name']));
					}
				}
				return $parties_senators;
		}
	

}
?>