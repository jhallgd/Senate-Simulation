<?php

interface party_dao_interface
{
    public function create(parties $party);
    public function delete(parties $party);
    public function find_by_id(int $party_id): parties;
    public function get_all(): array;
    public function update(parties $party);

    public function check_by_id(int $party_id): bool;

}

?>