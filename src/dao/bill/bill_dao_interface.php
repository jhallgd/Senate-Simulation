<?php

interface bill_dao_interface
{
    public function create(bills $bill, int $default_pv, int $default_vt): bool;
    public function delete(bills $bill): bool;
    public function find_by_id($bill_id): bills;
    public function get_all(): array;
    public function update(bills $bill): bool;

}

?>