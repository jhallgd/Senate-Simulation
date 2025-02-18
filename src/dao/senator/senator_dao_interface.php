<?php

interface senator_dao_interface
{
    public function create($senator);
    public function delete($senator);
    public function find_by_id($senator_id): senators;
    public function find_all_by_party_id($party_id): array;
    public function get_all(): array;
    public function update(senators $senator):bool;

}

?>