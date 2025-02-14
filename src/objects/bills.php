<?php

class Bills
{
    private int $bill_id;
    private string $bill_title;

    private string $bill_short_text;

    private string $bill_url;

    public function __construct(int $bill_id, string $bill_title, string $bill_short_text, string $bill_url){
        $this->bill_id = $bill_id;
        $this->bill_title = $bill_title;
        $this->bill_short_text = $bill_short_text;
        $this->bill_url = $bill_url;
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
        echo '<a href = "'.$this->get_bill_url().'" target="_blank">'.$this->get_bill_title(). ': '. $this->get_bill_short_text() .'</a>';
    }
}

?>