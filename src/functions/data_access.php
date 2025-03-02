<?php

$ROOT = dirname(__DIR__);
require($ROOT . '/functions/db.php');
require($ROOT . '/functions/common_functions.php');

require($ROOT . '/objects/senators/senators.php');
require($ROOT . '/objects/senators/senators_committees.php');

require($ROOT . '/objects/committees/committees.php');
require($ROOT . '/objects/committees/committees_senators.php');
require($ROOT . '/objects/committees/committee_position_types.php');

require($ROOT . '/objects/bills/bills.php');
require($ROOT . '/objects/bills/bills_committees.php');
require($ROOT . '/objects/bills/bills_parties.php');

require($ROOT . '/objects/parties/parties.php');
require($ROOT . '/objects/parties/party_views.php');

require($ROOT . '/objects/votes/votes.php');
require($ROOT . '/objects/votes/votes_senators.php');
require($ROOT . '/objects/votes/vote_types.php');
require($ROOT . '/objects/votes/vote_types_totals.php');

require($ROOT . '/objects/settings/settings.php');

require($ROOT . '/dao/senator/senator_dao_interface.php');
require($ROOT . '/dao/senator/senator_dao_implementation.php');

require($ROOT . '/dao/committee/committee_dao_interface.php');
require($ROOT . '/dao/committee/committee_dao_implementation.php');
require($ROOT . '/dao/committee/committee_senator_dao_interface.php');
require($ROOT . '/dao/committee/committee_senator_dao_implementation.php');

require($ROOT . '/dao/bill/bill_dao_interface.php');
require($ROOT . '/dao/bill/bill_dao_implementation.php');
require($ROOT . '/dao/bill/bill_committee_dao_interface.php');
require($ROOT . '/dao/bill/bill_committee_dao_implementation.php');
require($ROOT . '/dao/bill/bill_party_dao_interface.php');
require($ROOT . '/dao/bill/bill_party_dao_implementation.php');

require($ROOT . '/dao/party/party_dao_interface.php');
require($ROOT . '/dao/party/party_dao_implementation.php');

require($ROOT . '/dao/vote/vote_dao_interface.php');
require($ROOT . '/dao/vote/vote_dao_implementation.php');
require($ROOT . '/dao/vote/vote_type_dao_interface.php');
require($ROOT . '/dao/vote/vote_type_dao_implementation.php');


require($ROOT . '/dao/settings/settings_dao_interface.php');
require($ROOT . '/dao/settings/settings_dao_implementation.php');

require($ROOT . '/dao/admin/admin_dao_interface.php');
require($ROOT . '/dao/admin/admin_dao_implementation.php');



class data_access
{
    private database $db;
    private common_functions $cf;
    private senator_dao_interface $senator_dao;
    private committee_dao_interface $committee_dao;
    private committee_senator_dao_interface $committee_senator_dao;
    private bill_dao_interface $bill_dao;
    private bill_committee_dao_interface $bill_committee_dao;
    private bill_party_dao_interface $bill_party_dao;
    private party_dao_interface $party_dao;
    private vote_dao_interface $vote_dao;
    private vote_type_dao_interface $vote_type_dao;
    private settings_dao_interface $settings_dao;
    private admin_dao_interface $admin_dao;




    public function __construct()
    {
        $this->db = new database();
        $this->cf = new common_functions();

        $this->senator_dao = new senator_dao_implementation($this->db);

        $this->committee_dao = new committee_dao_implementation($this->db);
        $this->committee_senator_dao = new committee_senator_dao_implementation($this->db);

        $this->bill_dao = new bill_dao_implementation($this->db);
        $this->bill_committee_dao = new bill_committee_dao_implementation($this->db);
        $this->bill_party_dao = new bill_party_dao_implementation($this->db);

        $this->party_dao = new party_dao_implementation($this->db);

        $this->vote_dao = new vote_dao_implementation($this->db);
        $this->vote_type_dao = new vote_type_dao_implementation($this->db);

        $this->settings_dao = new settings_dao_implementation($this->db);

        $this->admin_dao = new admin_dao_implementation($this->db);
    }

    // Senator Functions

  
    public function create_senator(senators $senator): bool
    {
        return $this->senator_dao->create($senator, $this->get_settings()->get_default_vote_type());
    }
    public function update_senator(senators $senator)
    {
        return $this->senator_dao->update($senator);
    }

    public function delete_senator(senators $senator):bool
    {
        return $this->senator_dao->delete($senator);
    }

    public function check_senate_id($id): bool
    {
        $senator = $this->senator_dao->find_by_id($id);
        return !$senator = [];

    }
    public function get_senator_by_id($id): senators
    {
        return $this->senator_dao->find_by_id($id);
    }

    public function get_all_senators(): array
    {
        return $this->senator_dao->get_all();
    }

    public function get_senators_committees(): array{
        return $this->senator_dao->find_all_senator_committees();
    }

    public function get_all_unassigned_senators_committees():array{
        return $this->senator_dao->find_all_senator_unassigned_committees();
    }

    public function get_senators_committees_by_co_id(int $co_id): array{
        return $this->senator_dao->find_all_senator_committees_co_id($co_id);
    }

    public function update_senators_committees(int $sc_id, int $sc_cpt_id, int $sc_se_id, int $sc_co_id):bool{
        return $this->senator_dao->update_senators_committees($sc_id, $sc_cpt_id, $sc_se_id, $sc_co_id);
    }

    // Committee Functions

    public function create_committee(committees $committee): bool
    {
        return $this->committee_dao->create($committee);
    }

    public function update_committee(committees $committee): bool
    {
        return $this->committee_dao->update($committee);
    }

    public function delete_committee(committees $committee): bool
    {
        return $this->committee_dao->delete($committee);
    }

    public function get_committee_by_id($co_id): committees
    {
        return $this->committee_dao->find_by_id($co_id);
    }
    public function get_committees_by_se_id($se_id): array
    {
        return $this->committee_senator_dao->find_by_se_id($se_id);
    }

    public function get_all_committees(): array{
        return $this->committee_dao->get_all();
    }

    public function get_all_committees_bills(): array{
        return $this->bill_committee_dao->get_all();
    }

    public function create_committee_bill(int $bl_id, int $co_id): bool{
        return $this->bill_committee_dao->create($bl_id, $co_id);
    }
    public function delete_committee_bill(int $bl_id, int $co_id): bool{
        return $this->bill_committee_dao->delete($bl_id, $co_id);
    }

    public function create_commitee_list()
    {
        $committees = $this->committee_dao->get_all();
        $s = '';
        if (sizeof($committees) > 1) {
            $s = 's';
        }
        if (sizeof($committees) > 0) {
            echo '<h2>Committee' . $s . '</h2><ul>';
            foreach ($committees as $committee) {
                echo '<li><a href="/pages/agenda.php?c=' . $committee->get_id() . '">' . $committee->get_committee_name() . '</a></li>';
            }
            echo '</ul>';
        }
    }

    public function get_all_committee_position_types():array{
        return $this->committee_dao->get_all_committee_position_types();
    }

    //Bill Functions

    public function create_bill(bills $bill): bool{
        return $this->bill_dao->create($bill,$this->get_settings()->get_default_party_view(),$this->get_settings()->get_default_vote_type());
    }

    public function update_bill(bills $bill): bool{
        return $this->bill_dao->update($bill);
    }

    public function delete_bill(bills $bill): bool{
        return $this->bill_dao->delete($bill);
    }
    public function get_all_bills(): array{
        return $this->bill_dao->get_all();
    }

    public function get_bill_by_id($bill_id): bills
    {
        return $this->bill_dao->find_by_id($bill_id);
    }
    public function get_bills_by_co_id($co_id): array
    {
        return $this->bill_committee_dao->find_all_by_co_id($co_id);
    }

    public function get_bills_by_pa_id(int $party_id): array{
        return $this->bill_party_dao->find_all_party_id($party_id);
    }

    public function create_bill_table()
    {
        $bills = $this->bill_committee_dao->get_all();
        $data = [];
        foreach ($bills as $bill) {
            array_push($data, [$bill->create_bill_link(), $bill->get_bill_committee()]);
        }
        $s = '';
        if (sizeof($data) > 1) {
            $s = 's';
        }
        if (sizeof($data) > 0) {
            echo '<h2>Bill' . $s . '</h2>';
            $this->cf->create_custom_table(['Bill', 'Bill Location'], $data);
        }

    }

    public function create_bill_party_table($party_id)
    {
        $bills = $this->bill_party_dao->find_all_party_id($party_id);
        $data = [];
        foreach ($bills as $bill) {
            $committee_bill = $this->bill_committee_dao->find_by_id($bill->get_bill_id());
            array_push($data, [$bill->create_bill_link(), $bill->get_party_view(), $committee_bill->get_bill_committee()]);
        }
        $s = '';
        if (sizeof($data) > 1) {
            $s = 's';
        }
        if (sizeof($data) > 0) {
            echo '<h3>Bill' . $s . '</h3>';
            $this->cf->create_custom_table(['Bill', 'Party Position', 'Bill Location'], $data);
        }

    }

    //Party Functions

    public function create_party(parties $party):bool{
        return $this->party_dao->create($party, $this->get_settings()->get_default_party_view());
    }

    public function update_party(parties $party):bool{
        return $this->party_dao->update($party);
    }
    public function delete_party(parties $party):bool{
        return $this->party_dao->delete($party);
    }
    public function check_party_by_id($party_id)
    {
        return $this->party_dao->check_by_id($party_id);
    }
    public function get_all_parties()
    {
        return $this->party_dao->get_all();
    }
    public function get_party_by_id($id)
    {
        return $this->party_dao->find_by_id($id);
    }

    public function get_all_party_views():array{
        return $this->party_dao->get_all_party_views();
    }

    public function update_bills_parties(int $pb_id, int $pvt_id){
        return $this->bill_party_dao->update($pb_id, $pvt_id);
    }

    public function create_party_senators_table($party_id)
    {
        $senators = $this->senator_dao->find_all_by_party_id($party_id);
        $data = [];
        foreach ($senators as $senator) {
            array_push($data, [$senator->get_full_name()]);
        }
        $s = '';
        if (sizeof($data) > 1) {
            $s = 's';
        }
        if (sizeof($data) > 0) {
            echo '<h3>Party Member' . $s . '</h3>';
            $this->cf->create_custom_table(['Senator Name'], $data);
        }
    }

    // Vote Functions
    public function update_vote(votes $vote): bool
    {
        return $this->vote_dao->update($vote);
    }

    public function get_vote_by_se_bl_id(int $se_id, int $bl_id)
    {
        return $this->vote_dao->find_by_se_bl_id($se_id, $bl_id);
    }

    public function get_all_votes_by_bl_id(int $bl_id): array
    {
        return $this->vote_dao->find_all_by_bl_id($bl_id);
    }

    public function get_all_vote_types(): array
    {
        return $this->vote_type_dao->get_all();
    }

    public function get_all_vote_types_totals(int $bl_id): array
    {
        return $this->vote_type_dao->get_all_totals($bl_id);
    }


    //Settings
    public function get_settings()
    {
        return $this->settings_dao->find_by_id(1001);
    }
    // Admin Functions
    public function check_admin_login(string $username, string $password): bool
    {
        return $this->admin_dao->check_by_credentials($username, $password);
    }

    public function update_settings(settings $settings):bool
    {
        return $this->settings_dao->update( $settings);
    }

    // MISC Functions
    public function show_all_tables()
    {
        $sql = 'SHOW tables;';
        $tables = $this->db->get_data($sql);
        foreach ($tables as $table) {
            echo '<h2>' . $table['Tables_in_senate_sim'] . '</h2>';
            $this->simple_table($table['Tables_in_senate_sim']);
        }
    }

    /**
     * Summary of simpleTable
     * 
     * Builds a simple table using all of the information from the SQL table.
     * 
     * @param string $table_name The table name.
     * 
     */
    public function simple_table(string $table_name)
    {
        $output = '<table class="basicTable"><tr>';

        $result = $this->get_column_names($table_name);
        foreach ($result as $col) {
            foreach ($col as $item) {
                $output .= '<th>' . $item . '</th>';
            }

        }
        $output .= '</tr>';

        $result = $this->db->get_all($table_name);

        foreach ($result as $col) {
            $output .= '<tr>';
            foreach ($col as $item) {
                $output .= '<td>' . $item . '</td>';
            }
            $output .= '</tr>';
        }


        $output .= '</table>';

        echo $output;
    }

    public function get_column_names($table_name)
    {
        $sql = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table_name' ORDER BY ordinal_position;";
        $columns = $this->db->get_data($sql);
        return $columns;
    }
}






?>