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

    public function confirm($key = NULL)
    {
        if($key == null) redirect(base_url('user/orders'),'refresh');

        $sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }
        
        $this->load->model(array("UserModel", "OrderModel"));        
        $this->load->model("OrderModel");
        $user     = $this->UserModel->getUserDetailByUsername($sess['username']);
        $getOrder = $this->OrderModel->getOrderDetail($key, $user->id);

        //upload
        $config['upload_path']   = './kadooku_uploads/confirm/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']      = '100000';
        $config['encrypt_name']  = TRUE;
        
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $data = [
            "transaction_id" => $getOrder[0]->id,
            "user_id"        => $user->id,
            "created"        => date("Y-m-d G:i:s")
        ];
        if(!empty($_FILES['featured_image']['name'])){
            if(!$this->upload->do_upload('featured_image'))
            {
                redirect(base_url('user/orders/detail/'.$key),'refresh');
            }
            else{
                $file     = $this->upload->data();
                $file_img = !empty($file['file_name']) ? $file['file_name'] : "default.jpg";
                $data['featured_image'] = $file_img;

                if($this->OrderModel->changeStatusPaid($key)) {
                    if($this->OrderModel->insertConfirm($data)) redirect(base_url('user/orders/detail/'.$key),'refresh');
                    else redirect(base_url('user/orders/detail/'.$key),'refresh');
                }
                else redirect(base_url('user/orders/detail/'.$key),'refresh');
            }
        }else {
            redirect(base_url('user/orders/detail/'.$key),'refresh');
        }
    }
}

/* End of file Orders.php */
