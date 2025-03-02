<?php
class admins{
    private int $id;
    private string $username;

    public function __construct($data){
        $this->id = $data['ad_id'];
        $this->username = $data['ad_username'];
    }

    public function get_id(): int{
        return $this->id;
    }

    public function get_username(): string{
        return $this->username;
    }

}
