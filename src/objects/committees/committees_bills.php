<?php

class committees_bills
{
    private int $id;
    private string $committee_name;
    private string $committee_location;

    private array $committee_bills;

    public function __construct(array $data, array $bills)
    {
        $this->id = $data['co_id'];
        $this->committee_name = $data['co_name'];
        $this->committee_location = $data['co_location'];
        $this->committee_bills = $bills;
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_committee_name(): string
    {
        return $this->committee_name;
    }

    public function get_committee_location(): string
    {
        return $this->committee_location;
    }

    public function get_committee_bills(): array
    {
        return $this->committee_bills;
    }

    public function get_agenda_url(): string{
        return '<a href = /pages/agenda.php?c='.$this->id.'>Agenda</a>';
    }
}

?>