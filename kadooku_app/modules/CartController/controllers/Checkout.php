<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    private $transId;
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model("CartModel");
    }
    
    public function index()
    {
        $sess = $this->session->userdata('userData');

        if($this->cart->total_items() < 1){
            redirect('cart','refresh');
        }

        $post = $this->input->post(NULL, TRUE);
        if(!$post){
            $resultAddress = $this->CartModel->getAddressByUsername($sess['username']);
            $data = [
                'title'    => "Checkout",
                'address'  => $resultAddress,
                'sess'     => $sess,
                'products' => $this->cart->contents(),
                'subtotal' => $this->cart->total()
            ];
            
            //$this->session->set_userdata('payment', $data);
            $this->template->load('public/template', 'checkoutView', $data);
        }else{
            // set random number
            if(!@$_SESSION['cart_session']['random']){
                $_SESSION['cart_session']['random'] = mt_rand(111, 999);
            }
            $rand = $this->session->get_userdata('cart_session');

            switch($post['address']){
                case 'new' :
                    if(!empty($post['name'])){
                        // save address
                        $getUser = $this->CartModel->get_user_detail($sess['username']);
                        $address = [
                            'user_id'     => $getUser->id,
                            'email'       => $post['email'],
                            'address'     => $post['fulladdress'],
                            'province_id' => $post['province_id'],
                            'regency_id'  => $post['regency_id'],
                            'district_id' => $post['district_id'],
                            'village_id'  => $post['village_id'],
                            'phone'       => $post['phone'],
                            'name'        => $post['name'],
                        ];
                        $addressId = $this->CartModel->addAddress($address);


                        // save product
                        $data = [
                            'user_id'       => $getUser->id,
                            'address_id'    => $addressId,
                            'amount'        => $this->cart->total_items(),
                            'price_total'   => $post['totalpayment'] + $rand['cart_session']['random'],
                            'random_number' => $rand['cart_session']['random'],
                            'key'           => "KADOOKU".date("Ymd").$getUser->id.time(),
                            'time_late'     => date('Y-m-d G:i:s', strtotime("+1 days")),
                            'payment_method'=> $rand['cart_session']['payment_method']
                        ];
                        $this->saveProduct($data, $this->cart->contents());
                    }else{
                        print_r($post);
                    }
                    break;
                
                case 'old' :
                    if(empty($post['address_id'])){
                        redirect('cart/checkout','refresh');
                    }else{
                        $getUser = $this->CartModel->get_user_detail($sess['username']);
                        $data = [
                            'user_id'       => $getUser->id,
                            'address_id'    => $post['address_id'],
                            'amount'        => $this->cart->total_items(),
                            'price_total'   => $post['totalpayment'] + $rand['cart_session']['random'],
                            'random_number' => $rand['cart_session']['random'],
                            'key'           => "KADOOKU".date("Ymd").$getUser->id.time(),
                            'time_late'     => date('Y-m-d G:i:s', strtotime("+1 days")),
                            'payment_method'=> $rand['cart_session']['payment_method']
                        ];

                        $this->saveProduct($data, $this->cart->contents());
                    }
                    break;
            }
        }
        
    }

    private function saveProduct($data = array(), $items = array())
    {
        $transactionId = $this->CartModel->addTransaction($data);
        $product = array();
        foreach($items as $item){
            $product[] = array(
                'transaction_id' => $transactionId,
                'product_id'     => $item['id'],
                'qty'            => $item['qty'],
                'subtotal'       => $item['subtotal']
            );
            $p    = $this->CartModel->getProduct($item['id']);
            $stok = ($p->product_amount - $item['qty']);
            if($this->CartModel->updateProduct(['product_amount' => $stok], ['id' => $item['id']]))
                continue;
        }
        
        if($this->CartModel->addTransactionProduct($product)){
            $this->cart->destroy();
            unset($_SESSION['cart_session']);
            redirect('order-received/'.$data['key'],'refresh');
        }
    }
    
    public function test()
    {
        
        //unset($_SESSION['cart_session']);
            //unset($_SESSION['cart_session']);
            $rand = $this->session->get_userdata('cart_session');
            
        printData($rand);
    }
}

/* End of file Checkout.php */
