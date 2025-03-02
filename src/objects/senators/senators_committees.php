<?php
class senators_committees
{
    private int $id;
    private int $committee_posotion_id;
    private string $committee_posotion;
    private int $senator_id;
    private int $committeee_id;


    public function __construct(array $data)
    {
        $this->id = $data["sc_id"];
        $this->committee_posotion_id = $data["sc_cpt_id"];
        $this->committee_posotion = $data["cpt_name"];
        $this->senator_id = $data["sc_se_id"];
        $this->committeee_id = $data["sc_co_id"];
    }

    public function get_id(): int{
        return $this->id;
    }
    public function get_committee_posotion_id(): int{
        return $this->committee_posotion_id;
    }
    public function get_committee_posotion(): string{
        return $this->committee_posotion;
    }
    public function get_senator_id(): int{
        return $this->senator_id;
    }
    public function get_committeee_id(): int{
        return $this->committeee_id;
    }

}
?>