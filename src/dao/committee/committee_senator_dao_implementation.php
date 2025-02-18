<?php

class committee_senator_dao_implementation implements committee_senator_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function find_by_se_id(int $se_id): array
    {
        $sql = "SELECT cpt_name, co_id, co_name, co_location 
		FROM SenatorsCommittees
        LEFT JOIN CommitteePositionTypes ON sc_cpt_id = cpt_id
        LEFT JOIN Committees ON sc_co_id = co_id
		WHERE sc_se_id = $se_id;";

        $raw_data = $this->db->get_data($sql);
        $committee_senator = [];
        foreach ($raw_data as $raw_committee) {
            array_push($committee_senator, new committees_senators($raw_committee));
        }

        return $committee_senator;

    }
    public function get_all(): array
    {
        $sql = "SELECT co_id, co_name, co_location 
		FROM Committees;";
        $raw_data = $this->db->get_data($sql);
        $committees = [];
        foreach ($raw_data as $committee_data) {
            array_push($committees, new committees($committee_data));
        }
        return $committees;
    }

}

?>