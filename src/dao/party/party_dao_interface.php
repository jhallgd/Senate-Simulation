<?php

interface party_dao_interface
{
    public function create(parties $party, int $default_pvt):bool;
    public function delete(parties $party):bool;
    public function find_by_id(int $party_id): parties;
    public function get_all(): array;
    public function update(parties $party):bool;

    public function check_by_id(int $party_id): bool;

    public function get_all_party_views():array;

    public function get_count(int $party_id): int;

}

?>