<?php

class common_functions
{

    private $db;

    /**
     * Summary of __construct
     * Builds the common_function object and assigns the database object.
     */
    public function __construct()
    {
        require(dirname(__DIR__) . '/functions/db.php');
        $this->db = new database();
    }

    /**
     * Summary of simpleTable
     * 
     * Builds a simple table using all of the information from the SQL table.
     * 
     * @param string $table_name The table name.
     * 
     */
    public function simpleTable(string $table_name)
    {
        $output = '<table class="basicTable"><tr>';

        $result = $this->db->get_column_names($table_name);
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $col) {
                foreach ($col as $item) {
                    $output .= '<th>' . $item . '</th>';
                }
            }
        }
        $output .= '</tr>';

        $result = $this->db->get_all($table_name);
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $col) {
                $output .= '<tr>';
                foreach ($col as $item) {
                    $output .= '<td>' . $item . '</td>';
                }
                $output .= '</tr>';
            }
        }

        $output .= '</table>';

        echo $output;
    }

    public function create_custom_table($column_headers, $data)
    {
        $output = '<table class="basicTable"><tr>';
        foreach ($column_headers as $col_head) {
            $output .= '<th>' . $col_head . '</th>';
        }
        foreach ($data as $row) {
            $output .= '<tr>';
            foreach ($row as $item) {
                $output .= '<td>' . $item . '</td>';
            }
            $output .= '</tr>';
        }

        $output .= '</table>';

        echo $output;

    }

    public function checkSenateId(int $se_id)
    {
        return $this->db->check_senator_id($se_id);
    }

    public function getSenator(int $se_id)
    {
        return $this->db->get_senator($se_id);
    }

    public function get_parties(){
        return $this->db->get_parties();
    }

    public function create_party_views(int $pa_id){
        $data = $this->db->get_party_views($pa_id);
        $table = [];
        foreach ($data as $bill) {
            array_push($table, [$bill->get_bill_title(), $bill->get_bill_short_text(), '<a href = "'.$bill->get_bill_url().'">Click Here</a>', $bill->get_party_view()]);
        }
        $this->create_custom_table(['Bill', 'Bill Text', 'Bill Url', 'Party View'],  $table); 
    }

    public function check_party_id(int $pa_id){
        return $this->db->check_party_id($pa_id);
    }

    public function change_party(int $se_id, int $pa_id){
        return $this->db->change_party($se_id, $pa_id);
    }

    public function create_bill_table(){
        $data = $this->db->get_bill_data();
        $this->create_custom_table(['Bill', 'Bill Text', 'Bill URL', 'Bill Location'],  $data); 
    }

    public function get_committee_senator_id(int $se_id){
        $data = $this->db->get_committee_senator_id($se_id);
        return $data;
    }

    public function get_committee(int $co_id): Committees{
        return $this->db->get_committee($co_id);
    }

    public function get_party(int $pa_id): Parties{
        return $this->db->get_party($pa_id);
    }

    public function create_party_senators(int $pa_id) {
        $dataset =  $this->db->create_party_senators($pa_id);
        $table_data = [];
        foreach($dataset as $data){
            array_push($table_data, [$data->get_full_name(), $data->get_title(), $data->get_committee()]);
        }
        $this->create_custom_table(['Member', 'Title','Committee'],  $table_data); 
    }


}



?>