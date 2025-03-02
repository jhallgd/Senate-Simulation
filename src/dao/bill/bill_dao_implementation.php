<?php

class bill_dao_implementation implements bill_dao_interface {
    private database $db;

    public function __construct(database $db) {
        $this->db = $db;
    }

    public function create(bills $bill, int $default_pv, int $default_vt): bool{
        return $this->db->create_bill($bill, $default_pv, $default_vt);
    }
    public function delete($bill): bool{
        $bill_parties_sql = 'DELETE FROM PartiesBills WHERE pb_bl_id = '.$bill->get_bill_id().';';
        $votes_sql = 'DELETE FROM Votes WHERE vo_bl_id = '.$bill->get_bill_id().';';
        $committee_bills_sql = 'DELETE FROM CommitteesBills WHERE cb_bl_id = '.$bill->get_bill_id().';';
        $settings_sql = 'UPDATE Settings SET st_active_bill = NULL WHERE st_active_bill = '.$bill->get_bill_id().';';
        $bill_sql = 'DELETE FROM Bills WHERE bl_id ='.$bill->get_bill_id().';';
        return $this->db->run_transaction([$bill_parties_sql, $votes_sql, $committee_bills_sql, $settings_sql, $bill_sql]);
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
    public function update(bills $bill): bool{
        $sql = 'UPDATE Bills
        SET bl_title = "' . $bill->get_bill_title() . '", 
        bl_short_text = "' . $bill->get_bill_short_text() . '", 
        bl_url = "' . $bill->get_bill_url() . '"
        WHERE bl_id = ' . $bill->get_bill_id() . ';';
        return $this->db->update_data($sql);
    }

}




?>