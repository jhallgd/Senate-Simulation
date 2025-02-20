<?php

class vote_type_dao_implementation implements vote_type_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create(vote_types $vote_types)
    {
    }
    public function delete(vote_types $vote_types)
    {

    }

    public function update(vote_types $vote_types): bool
    {
        $sql = 'UPDATE Votes
        SET vt_name = "' . $vote_types->get_vt_name() . '", 
        vt_color = "' . $vote_types->get_vt_color() . '" 
        WHERE vt_id = ' . $vote_types->get_id() . ';';
        return $this->db->update_data($sql);
    }

    public function find_by_id(int $vt_id): vote_types
    {
        $sql = "SELECT vt_id, vt_name, vt_color  
		FROM VoteTypes
		WHERE vt_id = $vt_id;";

        $raw_data = $this->db->get_data($sql);

        return new vote_types($raw_data[0]);

    }


    public function get_all(): array
    {
        $sql = "SELECT vt_id, vt_name, vt_color  
		FROM VoteTypes;";

        $raw_data = $this->db->get_data($sql);
        $vote_types = [];

        foreach ($raw_data as $bill_data) {
            array_push($vote_types, new vote_types($bill_data));
        }
        return $vote_types;

    }

    public function get_all_totals(int $bl_id): array
    {
        $sql = "SELECT vt_id, vt_name, vt_color, vo_total  
        FROM VoteTypes
        LEFT JOIN (SELECT vo_vt_id, COUNT(vo_id) as vo_total 
        FROM Votes
        WHERE vo_bl_id = $bl_id
        GROUP BY vo_vt_id) AS VoteCount
        ON VoteTypes.vt_id = VoteCount.vo_vt_id;";

        $raw_data = $this->db->get_data($sql);
        $vote_types = [];

        foreach ($raw_data as $bill_data) {
            array_push($vote_types, new vote_types_totals($bill_data));
        }
        return $vote_types;
    }


}




?>