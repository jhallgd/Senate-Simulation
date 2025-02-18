<?php

interface bill_committee_dao_interface
{
    public function find_by_id(int $bill_id): bills_committees;

    public function find_all_by_co_id(int $co_id): array;
    public function get_all(): array;

}

?>