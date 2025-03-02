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
        if($settings->get_start_session() == True){
            $bool_ss = 1;
        }else{
            $bool_ss = 0;
        }
        
        
        $sql = 'UPDATE Settings
        SET st_start_session = ' . $bool_ss . ', 
        st_active_bill = ' . $settings->get_active_bill() . ', 
        st_default_vt = ' . $settings->get_default_vote_type() . ', 
        st_default_pvt = ' . $settings->get_default_party_view() . ' 
        WHERE st_id = ' . $settings->get_id() . ';';
        return $this->db->update_data($sql);
    }

}




?>