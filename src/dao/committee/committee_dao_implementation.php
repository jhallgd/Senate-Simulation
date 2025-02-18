<?php

class committee_dao_implementation implements committee_dao_interface {
    private database $db;

    public function __construct(database $db) {
        $this->db = $db;
    }

    public function create(committees $committee){

    }
    public function delete(committees $committee){

    }
    public function find_by_id(int $committee_id): committees{
        $sql = "SELECT co_id, co_name, co_location 
		FROM Committees 
		WHERE co_id = $committee_id;";
        $raw_data = $this->db->get_data($sql);
        return new committees($raw_data[0]);

    }
    public function get_all(): array{
        $sql = "SELECT co_id, co_name, co_location 
		FROM Committees;";
        $raw_data = $this->db->get_data($sql);
        $committees = [];
        foreach($raw_data as $committee_data){
            array_push($committees, new committees($committee_data));
        }
        return $committees;
    }
    public function update($senator){

    }

}




?>