<?php

interface committee_dao_interface
{
    public function create(committees $committee);
    public function delete(committees $committee);
    public function find_by_id(int $committee_id): committees;
    public function get_all(): array;
    public function update(committees $committee);

}

?>