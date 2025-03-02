<?php
class bills_parties extends bills{
    
    private int $pb_id;

    private int $pa_id;
    private string $pa_name;
    
    private int $pvt_id;
    private string $pa_view;


    private string $pa_view_color;

    public function __construct(array $data){
        parent::__construct($data);
        $this->pb_id = $data["pb_id"];
        $this->pa_id = $data['pa_id'];
        $this->pa_name = $data['pa_name'];
        $this->pvt_id = $data['pvt_id'];
        $this->pa_view = $data['pvt_view'];
        $this->pa_view_color = $data['pvt_color'];
    }

    public function get_party_bill_id(): int{
        return $this->pb_id;
    }
    public function get_party_id(): int{
        return $this->pa_id;
    }

    public function get_party_name(): string{
        return $this->pa_name;
    }

    public function get_pvt_id(): int{
        return $this->pvt_id;
    }
    public function get_party_view(): string{
        return $this->pa_view;
    }
}


?>