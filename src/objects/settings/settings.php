<?php
class settings
{
    private int $id;
    private bool $start_session;
    private int $active_bill;
    private int $default_vote_type;

    private int $default_party_view;
    public function __construct(array $data)
    {
        $this->id = $data["st_id"];
        $this->start_session = $data["st_start_session"];
        if (is_null($data["st_active_bill"])) {
            $this->active_bill = -1;
        } else {
            $this->active_bill = $data["st_active_bill"];
        }
        $this->default_vote_type = $data["st_default_vt"];
        $this->default_party_view = $data["st_default_pvt"];
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_start_session(): bool
    {
        return $this->start_session;
    }

    public function get_active_bill(): int
    {
        return $this->active_bill;
    }

    public function get_default_vote_type(): int
    {
        return $this->default_vote_type;
    }

    public function get_default_party_view(): int
    {
        return $this->default_party_view;
    }

}

?>