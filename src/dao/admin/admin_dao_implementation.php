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
        //TODO
    }
    public function delete(admins $admin)
    {
        //TODO
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
    public function update(admins $admin, string $password):bool
    {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = 'UPDATE Admins SET ad_password = "'.$password_hash.'" WHERE ad_id = '.$admin->get_id().'';
        return $this->db->update_data($sql);
    }

    public function check_by_credentials(string $username, string $password): int
    {
        $password_hash = $this->get_password_hash($username);
        if ( password_verify($password, $password_hash['ad_password'])){
            return $password_hash['ad_id'];
        }else{
            return -1;
        }

    }

    private function get_password_hash(string $username): array
    {
        $sql = 'SELECT ad_id, ad_password FROM Admins WHERE ad_username = "' . $username . '";';
        return $this->db->get_data($sql)[0];
    }

}



?>