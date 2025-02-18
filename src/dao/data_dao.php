<?php

interface data_dao{
    public function create($object);

    public function find_by_id($object_id);

    public function get_all();

    public function update($object);

    public function delete($object);
}

?>