<?php
class senators
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $title;
    private int $pa_id;
    private string $party;



    public function __construct(array $data)
    {
        $this->id = $data['se_id'];
        $this->first_name = $data['se_first_name'];
        $this->last_name = $data['se_last_name'];
        $this->title = $data['se_title'];


        if (is_null($data['se_pa_id'])) {
            $this->pa_id = 0;
            $this->party = 'none';
        } else {
            $this->pa_id = $data['se_pa_id'];
            $this->party = $data['pa_name'];
        }
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_first_name(): string
    {
        return $this->first_name;
    }

    public function get_last_name(): string
    {
        return $this->last_name;
    }

    public function get_full_name(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function get_title(): string
    {
        return $this->title;
    }

    public function get_pa_id(): int
    {
        return $this->pa_id;
    }


    public function get_party(): string
    {
        return $this->party;
    }


}



?>