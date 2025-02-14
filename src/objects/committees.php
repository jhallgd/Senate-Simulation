<?php

class Committees
{
    private int $id;
    private string $committee_name;
    private string $committee_location;

    private array $committee_bills;

    public function __construct(int $id, string $committee_name, string $committee_location, array $committee_bills)
    {
        $this->id = $id;
        $this->committee_name = $committee_name;
        $this->committee_location = $committee_location;
        $this->committee_bills = $committee_bills;
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

}

?>