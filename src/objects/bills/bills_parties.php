<?php
class bills_parties extends bills{
    private int $pa_id;
    private string $pa_name;
    private string $pa_view;

    private string $pa_view_color;

    public function __construct(array $data){
        parent::__construct($data);
        $this->pa_id = $data['pa_id'];
        $this->pa_name = $data['pa_name'];
        $this->pa_view = $data['pvt_view'];
        $this->pa_view_color = $data['pvt_color'];
    }

    public function get_party_id(): int{
        return $this->pa_id;
    }

    public function get_party_name(): string{
        return $this->pa_name;
    }

    public function get_party_view(): string{
        return $this->pa_view;
    }
}


?>