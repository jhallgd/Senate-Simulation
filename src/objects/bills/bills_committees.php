<?php

class bills_committees extends bills
{
    private string $bill_committee;

    public function __construct(array $bill_data)
    {
        if(is_null($bill_data['co_name'])){
            $this->bill_committee = 'Unassigned';
        }else{
        $this->bill_committee = $bill_data['co_name'];
        }
        parent::__construct($bill_data);
    }
    public function get_bill_committee(): string
    {
        return $this->bill_committee;
    }
}


?>