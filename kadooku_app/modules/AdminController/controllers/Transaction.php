<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();

        // Load Language
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model("TransactionModel");

        $sess = $this->session->userdata('adminData');
        // Cek Status Login
        if(!$sess['isAdmin'] && !$sess['isLogin']){ 
            redirect(base_url('adm_kadooku/login'),'refresh');
        }
    }
    

    public function index()
    {
        $this->template->load('backend/template', 'transaction/transaction_view');
    }

    public function edit($key = NULL)
    {
        if($key == null){
            $message = array(
				'msg'   => 'Transaksi tidak ditemukan.',
				'code'  => 1,
				'alert' => 'warning',
				'icon'  => 'info'
			);
			$this->session->set_flashdata($message);
            redirect(base_url('adm_kadooku/transaction'));
        }

        if(empty($this->input->post('status'))){
            $getTransaction = $this->TransactionModel->getTransactionByKey($key);
            $data = [
                'transaction' => $getTransaction,
                'payment'     => $this->TransactionModel->getPayment($getTransaction[0]->payment_method),
                'address'     => $this->TransactionModel->getAddressById($getTransaction[0]->address_id),
                'confirms'    => $this->TransactionModel->getTransactionConfirm($key)
            ];

            $this->template->load('backend/template', 'transaction/transaction_edit', $data);
        }else{
            if($this->TransactionModel->updateTransaction($this->input->post(NULL, TRUE), array('key' => $key))){
                $message = array(
                    'msg'   => 'Transaksi dengan Invoice '.$key.' telah diperbarui',
                    'code'  => 1,
                    'alert' => 'success',
                    'icon'  => 'check'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/transaction'));
            }else{
                $message = array(
                    'msg'   => 'Transaksi dengan Invoice '.$key.' gagal diperbarui',
                    'code'  => 1,
                    'alert' => 'danger',
                    'icon'  => 'info'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/transaction'));
            }
           
        }
        
    }
    
    public function ajax_list()
    {
        $this->load->model("DatatableModel");
        $status = array("pending", "canceled", "paid", "verified", "sent");
        $color  = array("default", "danger", "warning", "info", "success");
        $icon   = array("fa-clock-o", "fa-remove", "fa-history", "fa-check", "fa-gift");

        $option = array(
            'table'         => 'transactions',
            'column_search' => array('status'),
            'column_order'  => array(NULL,'order_time','price_total','status'),
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
            $row[] = '<span class="badge badge-pill badge-'.$color[$idx].'"><i class="fa '.$icon[$idx].'"></i> '.uc_words($res->status).'</span>';
            $row[] = "<a href='transaction/edit/{$res->key}' class='btn btn-info btn-xs btn-block'><i class='fa fa-pencil'></i> Kelola</a>";
 
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

    public function getTransaction($key)
    {
        printData($this->TransactionModel->getTransactionConfirm($key));
    }

}

/* End of file Transaction.php */
