<?php
class Parties{
    private int $id;
    private string $party_name;
    private string $party_location;

    private string $party_color;
    public function __construct($data){
        $this->id = $data['pa_id'];
        $this->party_name = $data['pa_name'];
        $this->party_location = $data['pa_location'];
        $this->party_color = $data['pa_color'];
    }

    public function get_id(): int{
        return $this->id;
    }

    public function get_party_name(): string{
        return $this->party_name;
    }

    public function get_party_location(): string{
        return $this->party_location;
    }

    public function get_party_color():string{
        return $this->party_color;
    }

}



?>