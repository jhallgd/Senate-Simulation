<?php
class Senators
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $title;
    private int $co_id;
    private string $party;
    private int $pa_id;

    private array $committees;

    public function __construct(array $data, $committees)
    {
        $this->id = $data['se_id'];
        $this->first_name = $data['se_first_name'];
        $this->last_name = $data['se_last_name'];
        $this->title = $data['se_title'];
        $this->committees = $committees;

        if (is_null($data['se_pa_id'])) {
            $this->pa_id = 0;
            $this->party = 'none';
        } else {
            $this->pa_id = $data['se_pa_id'];
            $this->party = $data['pa_name'];
        }
    }

    public function get_id(): int
    {
        return $this->id;
    }
    public function get_first_name(): string
    {
        return $this->first_name;
    }

    public function get_last_name(): string
    {
        return $this->last_name;
    }

    public function get_full_name(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function get_title(): string
    {
        return $this->title;
    }

    public function get_pa_id(): int
    {
        return $this->pa_id;
    }


    public function get_party(): string
    {
        return $this->party;
    }

    public function get_committees()
    {
        $committee_string = '';
        foreach ($this->committees as $committee) {
            $committee_string .= $committee->get_committee_name() . ' | '. $committee->get_committee_position() .  '<br>';
        }
        return $committee_string;
    }

    public function show_committees()
    {
        if (sizeof($this->committees) == 0) {
            echo '<h2>Committee:</h2>';
            echo '<p>You have not been placed on a committee.</p>';
        } else {
            if (sizeof($this->committees) > 1) {
                echo '<h2>Committees:</h2>';
            } else {
                echo '<h2>Committee:</h2>';
            }
            foreach ($this->committees as $committee) {
                echo '<h3>' . $committee->get_committee_name() . '</h3>';
                echo '<p>Position: ' . $committee->get_committee_position() . '</p>';
                echo '<p>' . $committee->get_agenda_url() . '</p>';
            }


        }



    }

}



?>