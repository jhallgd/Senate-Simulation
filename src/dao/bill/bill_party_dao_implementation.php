<?php

class bill_party_dao_implementation implements bill_party_dao_interface {
    private database $db;

    public function __construct(database $db) {
        $this->db = $db;
    }

    public function find_by_id($bill_id): bills_parties{
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, pa_id, pa_name, pvt_view, pvt_color   
		FROM PartiesBills
        LEFT JOIN Bills ON pb_bl_id = bl_id
        LEFT JOIN Parties ON pb_bl_id = pa_id 
        LEFT JOIN PartyViewTypes on pb_pvt_id = pvt_id
		WHERE pb_bl_id = $bill_id;";
        $raw_data = $this->db->get_data($sql);
        return new bills_parties($raw_data[0]);
    }

    public function find_all_party_id($party_id):array{
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, pa_id, pa_name, pvt_view, pvt_color   
		FROM PartiesBills
        LEFT JOIN Bills ON pb_bl_id = bl_id
        LEFT JOIN Parties ON pb_bl_id = pa_id 
        LEFT JOIN PartyViewTypes on pb_pvt_id = pvt_id
		WHERE pb_pa_id = $party_id;";
        $raw_data = $this->db->get_data($sql);
        $bills = [];
        foreach($raw_data as $bill_data){
            array_push($bills, new bills_parties($bill_data));
        }
        return $bills;
    }

    public function get_all(): array{
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, pa_id, pa_name, pvt_view, pvt_color  
		FROM PartiesBills
        LEFT JOIN Bills ON pb_bl_id = bl_id
        LEFT JOIN Parties ON pb_bl_id = pa_id 
        LEFT JOIN PartyViewTypes on pb_pvt_id = pvt_id;";
        
        $raw_data = $this->db->get_data($sql);

        $bills = [];

        foreach($raw_data as $bill_data){
            array_push($bills, new bills_parties($bill_data));
        }
        return $bills;

    }
    
}

?>