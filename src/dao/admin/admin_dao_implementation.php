<?php

class admin_dao_implementation implements admin_dao_interface
{
    private database $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function create(admins $admin)
    {
    }
    public function delete(admins $admin)
    {
    }
    public function find_by_id(int $admin_id): admins
    {
        $sql = "SELECT ad_id, ad_username
        FROM Admins
        WHERE ad_id = $admin_id;";
        $raw_data = $this->db->get_data($sql);
        return new admins($raw_data[0]);

    }
    public function get_all(): array
    {
        $sql = "SELECT ad_id, ad_username
        FROM Admins;";
        $raw_data = $this->db->get_data($sql);
        $admins = [];
        foreach ($raw_data as $admin_data) {
            array_push($parties, new parties($admin_data));
        }
        return $admins;

    }
    public function update(admins $admin)
    {

    }

    public function check_by_credentials(string $username, string $password): bool
    {
        $sql = "SELECT ad_id
        FROM Admins
        WHERE ad_username = '$username'
        AND ad_password = '$password'";
        return $this->db->check_data($sql);
    }


}



?>