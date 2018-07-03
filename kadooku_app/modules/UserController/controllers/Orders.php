<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }
    
    public function index()
    {
        $sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }
        $this->load->model(array("UserModel", "OrderModel"));
        // Get Detail User
        $user   = $this->UserModel->getUserDetailByUsername($sess['username']);
        $orders = $this->OrderModel->getUserOrders(array('user_id' => $user->id));

        $data = [
            'title'  => "Orders[{$user->full_name}]",
            'user'   => $user,
            'orders' => $orders->result(),
            'sess'   => $sess
        ];
        $this->template->load('public/template', 'profile_orders', $data);
    }
    
    public function detail($key = NULL)
    {
        $sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }
        if($key != NULL){
            $this->load->model(array("UserModel", "OrderModel"));
            $user       = $this->UserModel->getUserDetailByUsername($sess['username']);
            $getOrder   = $this->OrderModel->getOrderDetail($key, $user->id);
            $getAddress = $this->OrderModel->getAddressById($getOrder[0]->address_id);
            $getPayment = $this->OrderModel->getPayment($getOrder[0]->payment_method);

            $data = [
                'title'   => "Order Detail - {$key}",
                'user'    => $user,
                'orders'  => $getOrder,
                'address' => $getAddress,
                'payment' => $getPayment,
                'sess'    => $sess
            ];
            $this->template->load('public/template', 'detail_order', $data);
        }else{
            
            redirect('user/orders','refresh');
            
        }
    }
}

/* End of file Orders.php */
