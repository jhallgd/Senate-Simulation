<?php

class senator_dao_implementation implements senator_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create(senators $senator, int $default_vt):bool{
        return $this->db->create_senator($senator, $default_vt);
    }
    public function delete(senators $senator):bool
    {
        $votes_sql = 'DELETE FROM `Votes` WHERE vo_se_id = '.$senator->get_id().';';
        $senator_committees_sql = 'DELETE FROM `SenatorsCommittees` WHERE sc_se_id = '.$senator->get_id().';';
        $senator_sql = 'DELETE FROM `Senators` WHERE se_id = '.$senator->get_id().';';
        return $this->db->run_transaction([$votes_sql, $senator_committees_sql,$senator_sql]);
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

    public function find_all_senator_committees(): array{
        $sql = "SELECT sc_id, sc_cpt_id, cpt_name, sc_se_id, sc_co_id
		FROM SenatorsCommittees 
		LEFT JOIN CommitteePositionTypes ON sc_cpt_id = cpt_id;";
        $raw_data = $this->db->get_data($sql);
        $senators_committees = [];

        foreach ($raw_data as $senator_data) {
            array_push($senators_committees, new senators_committees($senator_data));
        }
        return $senators_committees;
    }

    public function find_all_senator_committees_co_id(int $co_id): array{
        $sql = "SELECT sc_id, sc_cpt_id, cpt_name, sc_se_id, sc_co_id
		FROM SenatorsCommittees 
		LEFT JOIN CommitteePositionTypes ON sc_cpt_id = cpt_id
        WHERE sc_co_id = ". $co_id ." ORDER BY cpt_order;";
        $raw_data = $this->db->get_data($sql);
        $senators_committees = [];

        foreach ($raw_data as $senator_data) {
            array_push($senators_committees, new senators_committees($senator_data));
        }
        return $senators_committees;
    }

    public function find_all_senator_unassigned_committees(): array{
        $sql = "SELECT -1 AS sc_id, 1003 AS sc_cpt_id, 'Unassigned' AS cpt_name, se_id AS sc_se_id, -1 AS sc_co_id
		FROM Senators
		WHERE se_id NOT IN (SELECT sc_co_id FROM SenatorsCommittees);";
        $raw_data = $this->db->get_data($sql);
        $senators_committees = [];

        foreach ($raw_data as $senator_data) {
            array_push($senators_committees, new senators_committees($senator_data));
        }
        return $senators_committees;
    }

    public function update_senators_committees(int $sc_id, int $sc_cpt_id, int $sc_se_id, int $sc_co_id): bool{
        if($sc_id == -1 AND $sc_co_id != -1){
            $sql = 'INSERT INTO SenatorsCommittees(sc_cpt_id, sc_se_id, sc_co_id) 
            VALUES('.$sc_cpt_id.', '.$sc_se_id.', '.$sc_co_id.');';
        }elseif($sc_co_id == -1){
            $sql = 'DELETE FROM SenatorsCommittees WHERE sc_id = '.$sc_id.';';
        }else{
            $sql = 'UPDATE SenatorsCommittees 
            SET sc_cpt_id = '.$sc_cpt_id.',
            sc_se_id = '. $sc_se_id . ', 
            sc_co_id = '. $sc_co_id . '
            WHERE sc_id = '.$sc_id.';';
        }
        return $this->db->update_data($sql);
    }
}




?>