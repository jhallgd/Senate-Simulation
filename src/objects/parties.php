<?php
class Parties{
    private int $id;
    private string $party_name;
    private string $party_location;

    private string $party_color;
    public function __construct(int $id, string $party_name, string $party_location, string $party_color){
        $this->id = $id;
        $this->party_name = $party_name;
        $this->party_location = $party_location;
        $this->party_color = $party_color;
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