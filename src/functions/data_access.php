<?php

$ROOT = dirname(__DIR__);
require($ROOT.'/functions/db.php');
require($ROOT.'/functions/common_functions.php');

require($ROOT.'/objects/senators/senators.php');

require($ROOT.'/objects/committees/committees.php');
require($ROOT.'/objects/committees/committees_senators.php');

require($ROOT.'/objects/bills/bills.php');
require($ROOT.'/objects/bills/bills_committees.php');
require($ROOT.'/objects/bills/bills_parties.php');

require($ROOT.'/objects/parties/parties.php');

require($ROOT.'/dao/senator/senator_dao_interface.php');
require($ROOT.'/dao/senator/senator_dao_implementation.php');

require($ROOT.'/dao/committee/committee_dao_interface.php');
require($ROOT.'/dao/committee/committee_dao_implementation.php');
require($ROOT.'/dao/committee/committee_senator_dao_interface.php');
require($ROOT.'/dao/committee/committee_senator_dao_implementation.php');

require($ROOT.'/dao/bill/bill_dao_interface.php');
require($ROOT.'/dao/bill/bill_dao_implementation.php');
require($ROOT.'/dao/bill/bill_committee_dao_interface.php');
require($ROOT.'/dao/bill/bill_committee_dao_implementation.php');
require($ROOT.'/dao/bill/bill_party_dao_interface.php');
require($ROOT.'/dao/bill/bill_party_dao_implementation.php');

require($ROOT.'/dao/party/party_dao_interface.php');
require($ROOT.'/dao/party/party_dao_implementation.php');



class data_access{
    private database $db;
    private common_functions $cf;
    private senator_dao_interface $senator_dao;
    private committee_dao_interface $committee_dao;
    private committee_senator_dao_interface $committee_senator_dao;
    private bill_dao_interface $bill_dao;
    private bill_committee_dao_interface $bill_committee_dao;
    private bill_party_dao_interface $bill_party_dao;
    private party_dao_interface $party_dao;

    


    public function __construct(){
        $this->db = new database();
        $this->cf = new common_functions();

        $this->senator_dao = new senator_dao_implementation($this->db);

        $this->committee_dao = new committee_dao_implementation($this->db);
        $this->committee_senator_dao = new committee_senator_dao_implementation($this->db);

        $this->bill_dao = new bill_dao_implementation($this->db);
        $this->bill_committee_dao = new bill_committee_dao_implementation($this->db);
        $this->bill_party_dao = new bill_party_dao_implementation($this->db);

        $this->party_dao = new party_dao_implementation($this->db);
    }

    // Senator Functions

    public function update_senator(senators $senator){
        return $this->senator_dao->update($senator);
    }
    public function check_senate_id($id):bool{
        $senator = $this->senator_dao->find_by_id($id);
        return !$senator = [];

    }
    public function get_senator_by_id($id):senators{
        return $this->senator_dao->find_by_id($id);
    }

    // Committee Functions
    public function get_committee_by_id($co_id):committees{
        return $this->committee_dao->find_by_id($co_id);
    }
    public function get_committees_by_se_id($se_id):array{
        return $this->committee_senator_dao->find_by_se_id($se_id);
    }

    public function create_commitee_list(){
        $committees = $this->committee_dao->get_all();
        $s = '';
        if(sizeof($committees) > 1){
            $s = 's';
        }
        if(sizeof($committees) > 0){
            echo '<h2>Committee'.$s.'</h2><ul>';
        foreach($committees as $committee){
            echo '<li><a href="/pages/agenda.php?c='.$committee->get_id().'">'.$committee->get_committee_name().'</a></li>';
        }
        echo '</ul>';
        }
    }

    //Bill Functions
    public function get_bills_by_co_id($co_id):array{
        return $this->bill_committee_dao->find_all_by_co_id($co_id);
    }

    public function create_bill_table(){
        $bills = $this->bill_committee_dao->get_all();
        $data = [];
        foreach($bills as $bill){
            array_push($data, [$bill->create_bill_link(), $bill->get_bill_committee()]);
        }
        $s = '';
        if(sizeof($data) > 1){
            $s = 's';
        }
        if(sizeof($data) > 0){
            echo '<h2>Bill'.$s.'</h2>';
            $this->cf->create_custom_table(['Bill', 'Bill Location'],  $data); 
        }

    }

    public function create_bill_party_table($party_id){
        $bills = $this->bill_party_dao->find_all_party_id($party_id);
        $data = [];
        foreach($bills as $bill){
            $committee_bill = $this->bill_committee_dao->find_by_id($bill->get_bill_id());
            array_push($data, [$bill->create_bill_link(), $bill->get_party_view(), $committee_bill->get_bill_committee()]);
        }
        $s = '';
        if(sizeof($data) > 1){
            $s = 's';
        }
        if(sizeof($data) > 0){
            echo '<h3>Bill'.$s.'</h3>';
            $this->cf->create_custom_table(['Bill', 'Party Position', 'Bill Location'],  $data); 
        }

    }

    //Party Functions

    public function check_party_by_id($party_id){
        return $this->party_dao->check_by_id($party_id);
    }
    public function get_all_parties(){
        return $this->party_dao->get_all();
    }
    public function get_party_by_id($id){
        return $this->party_dao->find_by_id($id);
    }

    public function create_party_senators_table($party_id){
        $senators = $this->senator_dao->find_all_by_party_id($party_id);
        $data = [];
        foreach($senators as $senator){
            array_push($data, [$senator->get_full_name()]);
        }
        $s = '';
        if(sizeof($data) > 1){
            $s = 's';
        }
        if(sizeof($data) > 0){
            echo '<h3>Party Member'.$s.'</h3>';
            $this->cf->create_custom_table(['Senator Name'],  $data); 
        }
    }
}






?>