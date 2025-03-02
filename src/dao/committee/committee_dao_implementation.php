<?php

class committee_dao_implementation implements committee_dao_interface {
    private database $db;

    public function __construct(database $db) {
        $this->db = $db;
    }

    public function create(committees $committee):bool{
        $sql = 'INSERT INTO `Committees` (co_name, co_location) 
        VALUES ("'.$committee->get_committee_name().'", 
        "'.$committee->get_committee_location().'");';
        return $this->db->update_data($sql);
    }
    public function delete(committees $committee):bool{
        $committee_senators_sql = 'DELETE FROM `SenatorsCommittees` WHERE sc_co_id = '.$committee->get_id().';';
        $committee_bill_sql = 'DELETE FROM `CommitteesBills` WHERE cb_co_id = '.$committee->get_id().';';
        $committee_sql = 'DELETE FROM `Committees` WHERE co_id = '.$committee->get_id().';';

        return $this->db->run_transaction([$committee_senators_sql,$committee_bill_sql ,$committee_sql]);
    }
    public function find_by_id(int $committee_id): committees{
        $sql = "SELECT co_id, co_name, co_location 
		FROM Committees 
		WHERE co_id = $committee_id;";
        $raw_data = $this->db->get_data($sql);
        return new committees($raw_data[0]);

    }
    public function get_all(): array{
        $sql = "SELECT co_id, co_name, co_location 
		FROM Committees;";
        $raw_data = $this->db->get_data($sql);
        $committees = [];
        foreach($raw_data as $committee_data){
            array_push($committees, new committees($committee_data));
        }
        return $committees;
    }
    public function update(committees $committee): bool{
        $sql = 'UPDATE Committees
        SET co_name = "' . $committee->get_committee_name() . '", 
        co_location = "' . $committee->get_committee_location() . '" 
        WHERE co_id = ' . $committee->get_id() . ';';
        return $this->db->update_data($sql);
    }

    public function get_all_committee_position_types(): array{
        $sql = "SELECT cpt_id, cpt_name, cpt_order 
		FROM CommitteePositionTypes;";
        $raw_data = $this->db->get_data($sql);
        $committees_position_types = [];
        foreach($raw_data as $committee_data){
            array_push($committees_position_types, new commitee_postion_type($committee_data));
        }
        return $committees_position_types;
    }

}




?>