<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    private $sess;
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model("CartModel");
    }

    public function index($orderId = null)
    {        
        $sess       = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }
        
        $getUser    = $this->CartModel->get_user_detail($sess['username']);
        $getProduct = $this->CartModel->getProductByKey($orderId, $getUser->id);

        if(count($getProduct) < 1)
            redirect('user/order','refresh');
            

        $data = [
            'user'    => $getUser,
            'sess'    => $sess,
            'product' => $getProduct,
            'payment' => $this->CartModel->getPaymentById($getProduct->payment_method)
        ];

        $this->template->load('public/template', 'orderView', $data);
    }
}