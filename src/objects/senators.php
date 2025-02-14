<?php
class Senators{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $title;
    private int $co_id;
    private string $committee;
    private string $party;
    private int $pa_id;

    public function __construct(int $id, string $first_name, string $last_name, string $title, $co_id, $committee, $pa_id, $party){
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->title = $title;

        if(is_null($co_id)){
            $this->co_id = 0;
            $this->committee = 'No Committee';
        }else{
            $this->co_id = $co_id;
            $this->committee = $committee;
        }
        
        if(is_null($pa_id)){
            $this->pa_id = 0;
            $this->party = 'No Party Selected';
        }else{
            $this->pa_id = $pa_id;
            $this->party = $party;
        }

       
    }

    public function get_id(): int{
        return $this->id;
    }
    public function get_first_name(): string{
        return $this->first_name;
    }

    public function get_last_name(): string{
        return $this->last_name;
    }

    public function get_full_name(): string{
        return $this->first_name.' '.$this->last_name;
    }

    public function get_title(): string{
        return $this->title;
    }

    public function get_co_id(): int{
        return $this->co_id;
    }

    public function get_committee(): string{
        return $this->committee;
    }

    public function get_pa_id(): int{
        return $this->pa_id;
    }


    public function get_party(): string{
        return $this->party;
    }

}



?>