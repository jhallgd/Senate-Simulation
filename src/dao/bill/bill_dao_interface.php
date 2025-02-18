<?php

interface bill_dao_interface
{
    public function create(bills $bill);
    public function delete(bills $bill);
    public function find_by_id($bill_id): bills;
    public function get_all(): array;
    public function update(bills $bill);

}

?>