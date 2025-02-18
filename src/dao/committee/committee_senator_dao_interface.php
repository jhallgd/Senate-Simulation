<?php

interface committee_senator_dao_interface
{
    public function find_by_se_id(int $se_id): array;
    public function get_all(): array;
   

}

?>