<?php

interface admin_dao_interface
{
    public function create(admins $admin);
    public function delete(admins $admin);
    public function find_by_id(int $admin_id): admins;
    public function get_all(): array;
    public function update(admins $admin);

    public function check_by_credentials(string $username, string $password): bool;

}

?>