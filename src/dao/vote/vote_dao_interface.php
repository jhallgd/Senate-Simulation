<?php

interface vote_dao_interface
{
    public function create(votes $vote);
    public function delete(votes $vote);
    public function find_by_id(int $vote_id): votes;

    public function find_by_se_bl_id(int $se_id, int $bl_id):votes;
    public function find_all_by_bl_id(int $bl_id): array;
    public function find_all_by_se_id(int $se_id): array;
    public function get_all(): array;
    public function update(votes $vote);
    public function clear_votes_by_bl_id(int $bl_id):bool;
}

?>