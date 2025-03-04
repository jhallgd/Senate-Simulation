<?php
class votes_senators extends votes{
    private string $se_first_name;
    private string $se_last_name;
    private string $vt_color;

    public function __construct(array $data){
        parent::__construct($data);
        $this->se_first_name = $data["se_first_name"];

        if($data["ct_count"]>1){
            $this->se_last_name = substr($data["se_first_name"], 0,1).'. '.$data["se_last_name"];
        }else{
            $this->se_last_name = $data["se_last_name"];
        }

        $this->vt_color = $data["vt_color"];

    }

    public function get_se_first_name(): string{
        return $this->se_first_name;
    }

    public function get_se_last_name(): string{
    return $this->se_last_name;
    }

    public function get_vt_color(): string{
        return $this->vt_color;
    }

}


?>