<?php

interface bill_party_dao_interface
{
    public function find_by_id($bill_id): bills_parties;
    public function find_all_party_id($party_id): array;
    public function get_all(): array;

}

?>