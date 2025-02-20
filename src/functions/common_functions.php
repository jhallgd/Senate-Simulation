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