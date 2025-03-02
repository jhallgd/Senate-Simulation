<?php

class commitee_postion_type
{
    private int $id;
    private string $committee_position_name;
    private int $committee_postion_order;

    public function __construct(array $data)
    {
        $this->id = $data["cpt_id"];
        $this->committee_position_name = $data["cpt_name"];
        $this->committee_postion_order = $data["cpt_order"];
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_committee_position_name(): string
    {
        return $this->committee_position_name;
    }
    public function get_committee_postion_order(): int
    {
        return $this->committee_postion_order;
    }
}


?>