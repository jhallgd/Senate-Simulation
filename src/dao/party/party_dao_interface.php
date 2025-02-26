<?php

interface party_dao_interface
{
    public function create(parties $party):bool;
    public function delete(parties $party):bool;
    public function find_by_id(int $party_id): parties;
    public function get_all(): array;
    public function update(parties $party):bool;

    public function check_by_id(int $party_id): bool;

}

?>