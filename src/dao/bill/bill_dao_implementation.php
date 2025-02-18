<?php

class bill_dao_implementation implements bill_dao_interface {
    private database $db;

    public function __construct(database $db) {
        $this->db = $db;
    }

    public function create($bill){
    }
    public function delete($bill){

    }
    public function find_by_id($bill_id): bills{
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url 
		FROM Bills
		WHERE bl_id = $bill_id;";

        $raw_data = $this->db->get_data($sql);

        return new bills($raw_data[0]);

    }
    public function get_all(): array{
         $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url 
		FROM Bills;";
        
        $raw_data = $this->db->get_data($sql);

        $bills = [];

        foreach($raw_data as $bill_data){
            array_push($bills, new bills($bill_data));
        }
        return $bills;

    }
    public function update(bills $bill){

    }

}




?>