<?php

class bills
{
    private int $bill_id;
    private string $bill_title;
    private string $bill_short_text;
    private string $bill_url;

    public function __construct($data){
        $this->bill_id = $data['bl_id'];
        $this->bill_title = $data['bl_title'];
        $this->bill_short_text = $data['bl_short_text'];
        $this->bill_url = $data['bl_url'];
    }

    public function get_bill_id(): int{
        return $this->bill_id;
    }
    public function get_bill_title(): string{
        return $this->bill_title;
    }
    public function get_bill_short_text(): string{
        return $this->bill_short_text;
    }
    public function get_bill_url(): string{
        return $this->bill_url;
    }

    public function create_bill_link(){
        return '<a href = "'.$this->get_bill_url().'" target="_blank">'.$this->get_bill_title(). '</a>'.': '. $this->get_bill_short_text();
    }
}

?>