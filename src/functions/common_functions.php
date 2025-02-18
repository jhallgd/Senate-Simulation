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


}



?>