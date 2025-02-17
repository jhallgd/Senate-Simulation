<?php
class Senators_Committees extends Committees
{
    private string $position;
    
    public function __construct(array $data, array $committee_data, array $bills)
    {
        parent::__construct($committee_data, $bills);
        $this->position = $data['cpt_name'];
    }

    public function get_committee_position(): string{
        return $this->position;
    }
}

?>