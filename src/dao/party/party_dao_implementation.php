<?php

class party_dao_implementation implements party_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create(parties $party):bool
    {
        return false; //TODO Add Party Bills,  Add party
    }
    public function delete(parties $party): bool
    {
        return false;//TODO Remove Party Bills, Set senator party id to null. Remove party
    }

    
    public function update(parties $party):bool{
        $sql = 'UPDATE Parties
        SET pa_name = "' . $party->get_party_name() . '", 
        pa_location = "' . $party->get_party_location() . '", 
        pa_color = "' . $party->get_party_color() . '" 
        WHERE pa_id = ' . $party->get_id() . ';';
        return $this->db->update_data($sql);
    }
    
    public function find_by_id(int $party_id): parties
    {
        $sql = "SELECT pa_id, pa_name, pa_location, pa_color 
		FROM Parties
		WHERE pa_id = $party_id;";

        $raw_data = $this->db->get_data($sql);

        return new parties($raw_data[0]);

    }
    public function get_all(): array
    {
        $sql = "SELECT pa_id, pa_name, pa_location, pa_color 
		FROM Parties;";
        $raw_data = $this->db->get_data($sql);
        $parties = [];
        foreach ($raw_data as $party_data) {
            array_push($parties, new parties($party_data));
        }
        return $parties;

    }
    public function check_by_id(int $party_id):bool{
        $sql = 'SELECT pa_id
        FROM Parties
        WHERE pa_id = '.$party_id.';';
        return $this->db->check_data($sql);
    }

}




?>