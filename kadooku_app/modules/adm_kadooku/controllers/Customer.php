<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load Language
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }

    public function index()
    {
        $this->template->load('backend/template', 'adm_kadooku/customer/customer_view');
    }

    public function ajax_list()
    {
        $this->load->model("DatatableModel");
        $status = array(1 => 'Active', 'Suspended');
        $color  = array(1 => "info", "danger");

        $option = array(
            'table'         => 'users',
            'column_search' => array(null, 'username','full_name','email','isActive'),
            'column_order'  => array('username','full_name','email','isActive'),
            'order'         => array('id' => 'asc')
        );
        $getData = $this->DatatableModel->get_datatables($option);
        $data    = array();
        $no      = $_POST['start'];
        foreach ($getData as $res) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $res->full_name;
            $row[] = $res->username;
            $row[] = $res->email;
            $row[] = '<span class="badge badge-pill badge-'.$color[$res->isActive].'">'.$status[$res->isActive].'</span>';
            $row[] = $res->username == "default_user" ? "" : "action";
 
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

/* End of file Customer.php */
