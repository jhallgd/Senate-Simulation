<?php
class committees_senators extends committees
{
    private string $position;
    
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->position = $data['cpt_name'];
    }

    public function get_committee_position(): string{
        return $this->position;
    }
}

?>