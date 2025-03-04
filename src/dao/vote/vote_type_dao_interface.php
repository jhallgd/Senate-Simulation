<?php

interface vote_type_dao_interface
{

    public function create(vote_types $vote_types);
    public function delete(vote_types $vote_types);
    public function find_by_id(int $vote_id): vote_types;

    public function get_all(): array;
    public function get_all_totals(int $bl_id): array;
    public function update(vote_types $vote_types):bool;


}

?>