<?php
class votes
{
    private int $id;
    private int $vote_type_id;
    private string $vote_type;
    private int $se_id;
    private int $bl_id;
    public function __construct(array $data)
    {
        $this->id = $data["vo_id"];
        $this->vote_type_id = $data["vo_vt_id"];
        $this->vote_type = $data["vt_name"];
        $this->se_id = $data["vo_se_id"];
        $this->bl_id = $data["vo_bl_id"];
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_vote_type_id(): int
    {
        return $this->vote_type_id;
    }
    public function get_vote_type(): string
    {
        return $this->vote_type;
    }

    public function get_se_id(): int{
        return $this->se_id;
    }

    public function get_bl_id(): int
    {
        return $this->bl_id;
    }

    public function change_vote(int $new_vt_id): votes{
        return new votes(['vo_id'=>$this->id, 'vo_vt_id'=>$new_vt_id, 'vt_name'=>$this->vote_type, 'vo_se_id'=>$this->se_id, 'vo_bl_id'=>$this->bl_id]);
    }


}

?>