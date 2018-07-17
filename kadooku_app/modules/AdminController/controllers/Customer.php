<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load Language
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model("UserModel");

        $sess = $this->session->userdata('adminData');
        // Cek Status Login
        if(!$sess['isAdmin'] && !$sess['isLogin']){ 
            redirect(base_url('adm_kadooku/login'),'refresh');
        }
    }

    public function index()
    {
        $this->template->load('backend/template', 'customer/customer_view');
    }

    public function edit($id)
    {
        $data['user'] = $this->UserModel->read(array('id' => $id))->row();
        $this->template->load('backend/template', 'customer/customer_edit', $data);
    }

    public function change_status()
	{
		$key 				= $this->uri->segment(5);
		$data['isActive'] 	= $this->uri->segment(4);
        if($this->UserModel->update($data, array('id' => $key))){
            $message = array(
                'msg'   => 'Data Costumer berhasil diperbarui',
                'code'  => 1,
                'alert' => 'success',
                'icon'  => 'check'
            );
            $this->session->set_flashdata($message);
            redirect(base_url('adm_kadooku/customer'));
        }else{
            $message = array(
                'msg'   => 'Data Customer gagal diperbarui',
                'code'  => 1,
                'alert' => 'danger',
                'icon'  => 'info'
            );
            $this->session->set_flashdata($message);
            redirect(base_url('adm_kadooku/customer'));
        }
				
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

            if($res->isActive == 2) $otherStatus = 1;
            else $otherStatus = 2;

            $row = array();
            $row[] = $no;
            $row[] = $res->full_name;
            $row[] = $res->username;
            $row[] = $res->email;
            $row[] = '<div class="dropdown">
                        <button class="btn btn-'.$color[$res->isActive].' btn-xs dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="true">
                            '.$status[$res->isActive].'
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" 
                                href="customer/change_status/'.$otherStatus.'/'.$res->id.'">
                                    '.$status[$otherStatus].'
                                </a>
                            </li>
                        </ul>
                    </div>';
            $row[] = $res->username == "default_user" ? "" 
                    : '<a href="customer/edit/'.$res->id.'" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> Edit Akun</a>';
 
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
