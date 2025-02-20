<?php
class settings
{
    private int $id;
    private bool $start_session;
    private int $active_bill;
    public function __construct(array $data)
    {
        $this->id = $data["st_id"];
        $this->start_session = $data["st_start_session"];
        $this->active_bill = $data["st_active_bill"];
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_start_session(): bool{
        return $this->start_session;
    }

    public function get_active_bill(): int{
        return $this->active_bill;
    }

}

?>