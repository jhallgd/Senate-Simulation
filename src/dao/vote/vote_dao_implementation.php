<?php

class vote_dao_implementation implements vote_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create($vote)
    {
    }
    public function delete($vote)
    {

    }

    public function update(votes $votes)
    {
        $sql = 'UPDATE Votes
        SET vo_vt_id = "' . $votes->get_vote_type_id() . '", 
        vo_se_id = "' . $votes->get_se_id() . '", 
        vo_bl_id = "' . $votes->get_bl_id() . '" 
        WHERE vo_id = ' . $votes->get_id() . ';';
        return $this->db->update_data($sql);
    }

    public function find_by_id(int $vote_id): votes
    {
        $sql = "SELECT vo_id, vo_vt_id, vt_name, vo_se_id, vo_bl_id  
		FROM Votes
        LEFT JOIN VoteTypes ON vo_vt_id = vt_id
		WHERE vo_id = $vote_id;";

        $raw_data = $this->db->get_data($sql);

        return new votes($raw_data[0]);

    }

    public function find_by_se_bl_id(int $se_id, int $bl_id):votes{
        $sql = "SELECT vo_id, vo_vt_id, vt_name, vo_se_id, vo_bl_id  
		FROM Votes
        LEFT JOIN VoteTypes ON vo_vt_id = vt_id
		WHERE vo_se_id = $se_id
        AND vo_bl_id = $bl_id;";

        $raw_data = $this->db->get_data($sql);

        return new votes($raw_data[0]);
    }


    public function get_all(): array
    {
        $sql = "SELECT vo_id, vo_vt_id, vt_name, vo_se_id, vo_bl_id  
		FROM Votes
        LEFT JOIN VoteTypes ON vo_vt_id = vt_id;";

        $raw_data = $this->db->get_data($sql);
        $votes = [];

        foreach ($raw_data as $bill_data) {
            array_push($votes, new votes($bill_data));
        }
        return $votes;

    }

    public function find_all_by_bl_id(int $bl_id): array
    {
        $sql = "SELECT vo_id, vo_vt_id, vt_name, vt_color, vo_se_id, vo_bl_id, se_first_name, se_last_name, se_title, ct_count  
		FROM Votes
        LEFT JOIN VoteTypes ON vo_vt_id = vt_id
        LEFT JOIN Senators ON vo_se_id = se_id
		LEFT JOIN (SELECT se_last_name AS ct_last_name, COUNT(se_id) AS ct_count FROM Senators GROUP BY se_last_name) AS Senators_count ON se_last_name = ct_last_name
		
        WHERE vo_bl_id = ".$bl_id."
        ORDER BY se_last_name;";

        $raw_data = $this->db->get_data($sql);
        $votes = [];

        foreach ($raw_data as $bill_data) {
            array_push($votes, new votes_senators($bill_data));
        }
        return $votes;
    }
    public function find_all_by_se_id(int $se_id): array
    {
        $sql = "SELECT vo_id, vo_vt_id, vt_name, vo_se_id, vo_bl_id  
		FROM Votes
        LEFT JOIN VoteTypes ON vo_vt_id = vt_id
        WHERE vo_se_id = $se_id;";

        $raw_data = $this->db->get_data($sql);
        $votes = [];

        foreach ($raw_data as $bill_data) {
            array_push($votes, new votes($bill_data));
        }
        return $votes;
    }


}




?>