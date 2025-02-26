<?php

class bill_committee_dao_implementation implements bill_committee_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function find_by_id($bill_id): bills_committees
    {
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, co_name 
		FROM CommitteesBills
        LEFT JOIN Bills ON cb_bl_id = bl_id
        LEFT JOIN Committees ON cb_co_id = co_id 
		WHERE cb_bl_id = $bill_id;";

        $raw_data = $this->db->get_data($sql);

        if(sizeof($raw_data) == 0){
            $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, 'Unassigned' AS co_name 
            FROM Bills
            WHERE bl_id = $bill_id;";
            $raw_data = $this->db->get_data($sql);
        }

        return new bills_committees($raw_data[0]);

    }

    public function find_all_by_co_id(int $co_id): array
    {
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, co_name 
		FROM CommitteesBills
        LEFT JOIN Bills ON cb_bl_id = bl_id
        LEFT JOIN Committees ON cb_co_id = co_id 
		WHERE cb_co_id = $co_id;";

        $raw_data = $this->db->get_data($sql);

        $bills = [];

        foreach ($raw_data as $bill_data) {
            array_push($bills, new bills_committees($bill_data));
        }
        return $bills;
    }
    public function get_all(): array
    {
        $sql = "SELECT bl_id, bl_title, bl_short_text, bl_url, co_name 
		FROM Bills
        LEFT JOIN CommitteesBills ON cb_bl_id = bl_id
        LEFT JOIN Committees ON cb_co_id = co_id;";

        $raw_data = $this->db->get_data($sql);

        $bills = [];

        foreach ($raw_data as $bill_data) {
            array_push($bills, new bills_committees($bill_data));
        }
        return $bills;

    }

}

?>