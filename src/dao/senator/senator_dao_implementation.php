<?php

class senator_dao_implementation implements senator_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create($senator)
    {

    }
    public function delete($senator)
    {

    }

    public function update(senators $senator): bool
    {
        if($senator->get_pa_id() == 0){
            $party_id = 'NULL';
        }else{
            $party_id = $senator->get_pa_id();
        }
        $sql = 'UPDATE Senators
        SET se_first_name = "' . $senator->get_first_name() . '", 
        se_last_name = "' . $senator->get_last_name() . '", 
        se_title = "' . $senator->get_title() . '", 
        se_pa_id = ' . $party_id . ' 
        WHERE se_id = ' . $senator->get_id() . ';';
        return $this->db->update_data($sql);
    }
    public function find_by_id($senator_id): senators
    {
        $sql = "SELECT se_id, se_first_name, se_last_name, se_title, se_pa_id, pa_name 
		FROM Senators 
		LEFT JOIN Parties ON se_pa_id = pa_id 
		WHERE se_id = $senator_id;";

        $raw_data = $this->db->get_data($sql);

        return new senators($raw_data[0]);

    }

    public function find_all_by_party_id($party_id): array
    {
        $sql = "SELECT se_id, se_first_name, se_last_name, se_title, se_pa_id, pa_name 
		FROM Senators 
		LEFT JOIN Parties ON se_pa_id = pa_id
        WHERE se_pa_id = $party_id;";
        $raw_data = $this->db->get_data($sql);
        $senators = [];

        foreach ($raw_data as $senator_data) {
            array_push($senators, new senators($senator_data));
        }
        return $senators;
    }
    public function get_all(): array
    {
        $sql = "SELECT se_id, se_first_name, se_last_name, se_title, se_pa_id, pa_name 
		FROM Senators 
		LEFT JOIN Parties ON se_pa_id = pa_id
        ORDER BY se_last_name;";
        $raw_data = $this->db->get_data($sql);
        $senators = [];

        foreach ($raw_data as $senator_data) {
            array_push($senators, new senators($senator_data));
        }
        return $senators;

    }


}




?>