<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();

        // Load Language
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }
    

    public function index()
    {
        $this->template->load('backend/template', 'adm_kadooku/transaction/transaction_view');
    }
    
    public function ajax_list()
    {
        $this->load->model("DatatableModel");
        $status = array("pending", "canceled", "paid", "verified", "sent");
        $color  = array("default", "danger", "warning", "info", "success");

        $option = array(
            'table'         => 'transactions',
            'column_search' => array(null, 'key','order_time','price_total','status'),
            'column_order'  => array('key','order_time','price_total','status'),
            'order'         => array('order_time' => 'desc')
        );
        $getData = $this->DatatableModel->get_datatables($option);
        $data    = array();
        $no      = $_POST['start'];
        foreach ($getData as $res) {
            $no++;
            $idx = array_search($res->status, $status);
            $row = array();
            $row[] = $no;
            $row[] = $res->key;
            $row[] = tanggal_indo($res->order_time);
            $row[] = rupiah($res->price_total);
            $row[] = '<span class="badge badge-pill badge-'.$color[$idx].'">'.uc_words($res->status).'</span>';
            $row[] = "customers->city";
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw"            => $_POST['draw'],
                        "recordsTotal"    => $this->DatatableModel->count_all($option),
                        "recordsFiltered" => $this->DatatableModel->count_filtered($option),
                        "data"            => $data,
                );
        //output to json format
        echo json_encode($output);
    }

}

/* End of file Transaction.php */
