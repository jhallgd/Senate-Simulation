<?php

class vote_types_totals extends vote_types
{
    private int $vote_totals;

    public function __construct($data)
    {
        parent::__construct($data);
        if (is_null($data['vo_total'])) {
            $this->vote_totals = 0;
        } else {
            $this->vote_totals = $data["vo_total"];
        }
    }

    public function get_vote_totals(): int{
        return $this->vote_totals;
    }
}


?>