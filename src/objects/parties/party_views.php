<?php
class party_views{
    private $id;
    private $view_name;

    private $view_color;

    public function __construct(array $data){
        $this->id = $data["pvt_id"];
        $this->view_name = $data["pvt_view"];
        $this->view_color = $data["pvt_color"];
    }

    public function get_id(){
        return $this->id;
    }
    public function get_view_name(){
        return $this->view_name;
    }
    public function get_color(){
        return $this->view_color;
    }
}
?>