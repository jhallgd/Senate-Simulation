<?php

class settings_dao_implementation implements settings_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function find_by_id($settings_id): settings
    {
        $sql = "SELECT st_id, st_start_session, st_active_bill, st_default_vt, st_default_pvt
		FROM Settings 
		WHERE st_id = $settings_id;";
        $raw_data = $this->db->get_data($sql);
        return new settings($raw_data[0]);

    }

    
    public function update(settings $settings): bool
    {
        $sql = 'UPDATE Settings
        SET st_start_session = "' . $settings->get_start_session() . '", 
        st_active_bill = "' . $settings->get_active_bill() . '", 
        WHERE se_id = ' . $settings->get_id() . ';';
        return $this->db->update_data($sql);
    }

}




?>