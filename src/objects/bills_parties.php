<?php
class BillsParties extends Bills{
    private int $pa_id;
    private string $pa_name;
    private string $pa_view;

    public function __construct(array $data, array $bill_data){
        parent::__construct($bill_data);
        $this->pa_id = $data['pa_id'];
        $this->pa_name = $data['pa_name'];
        $this->pa_view = $data['pb_view'];
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