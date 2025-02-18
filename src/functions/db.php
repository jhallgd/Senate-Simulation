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

	private function get_connection(){
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

	// Gets all items from table
	public function get_all($table_name)
	{
		$sql = "SELECT * FROM $table_name;";
		$data = $this->conn->query($sql);
		return $data;
	}

	// Check if data exists
	public function check_data($sql){
		$result = $this->conn->query($sql)->rowCount();
		return $result >= 1;
	}

	// Update Success 
	public function update_data($sql){
		return $this->conn->query($sql) == TRUE;
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