<?php

class party_dao_implementation implements party_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create(parties $party, int $default_pvt):bool
    {
       return $this->db->create_party($party, $default_pvt);
    }
    public function delete(parties $party): bool
    {
        $bill_parties_sql = 'DELETE FROM PartiesBills WHERE pb_pa_id = '.$party->get_id().';';
        $senators_sql = 'UPDATE Senators SET se_pa_id = NULL WHERE se_pa_id = '.$party->get_id().';';
        $party_sql = 'DELETE FROM Parties WHERE pa_id ='.$party->get_id().';';
        return $this->db->run_transaction([$bill_parties_sql, $senators_sql, $party_sql]);
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

    public function get_all_party_views(): array{
        $sql = "SELECT pvt_id, pvt_view, pvt_color 
		FROM PartyViewTypes;";
        $raw_data = $this->db->get_data($sql);
        $party_views = [];
        foreach ($raw_data as $party_data) {
            array_push($party_views, new party_views($party_data));
        }
        return $party_views;
    }

    public function get_count(int $party_id): int{
        $sql = "SELECT COUNT(se_id) as 'Count' FROM Senators WHERE se_pa_id =".$party_id." GROUP BY se_pa_id;";
        $count = $this->db->get_data($sql);
        if(sizeof($count) > 0){
        return $count[0]['Count'];
        }
        return 0;
    }

}




?>