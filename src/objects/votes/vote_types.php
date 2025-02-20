<?php
class vote_types
{
    private int $id;
    private string $vt_name;
    private string $vt_color;

    public function __construct(array $data){
        $this->id = $data["vt_id"];
        $this->vt_name = $data["vt_name"];
        $this->vt_color = $data["vt_color"];
    }

    public function get_id(): int{
        return $this->id;
    }

    public function get_vt_name(): string{
        return $this->vt_name;
    }

    public function get_vt_color(): string{
        return $this->vt_color;
    }
}

?>