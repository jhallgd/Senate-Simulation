<?php
class BillsParties extends Bills{
    private int $pa_id;
    private string $pa_name;
    private string $pa_view;

    public function __construct(int $bill_id, string $bill_title, string $bill_short_text, string $bill_url, int $pa_id, string $pa_name, string $pa_view){
        parent::__construct($bill_id, $bill_title, $bill_short_text, $bill_url);
        $this->pa_id = $pa_id;
        $this->pa_name = $pa_name;
        $this->pa_view = $pa_view;
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