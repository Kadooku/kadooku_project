<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
    }
    

    public function index()
    {
        $sess = $this->session->userdata('adminData');
        // Cek Status Login
        if(!$sess['isAdmin'] && !$sess['isLogin']){ 
            redirect(base_url('adm_kadooku/login'),'refresh');
        }
        $this->template->load('backend/template', 'dashboard');
    }

    public function sendemail()
    {
        $this->load->model(array("ProductModel", "UserModel"));
        $this->load->library("email_lib");
        $getProduct = $this->ProductModel->read(array("product_price <=" => 300000), "product_price", "ASC")->result();
        $product = array();
        $n = 0;
        while($n < 2){
            $ton = array();
            for($i = 0; $i<3; $i++){
                $res = $getProduct[rand(0, count($getProduct)-1)];
                $img = json_decode($res->product_image);
                $ton[] = [
                    'product_name'  => $res->product_name,
                    'product_price' => $res->product_price,
                    'product_image' => $img[0],
                    'product_url'   => $res->product_url
                ];
            }
            $product[] = $ton;
            $n++;
        }

        $getUser = $this->UserModel->read(array("enableNewsLetter" => 1))->result();

        foreach($getUser as $user){
            $data = [
                'product' => $product,
                'nama'    => $user->full_name
            ];
            $this->email_lib->sendMail([
                'email'   => $user->email,
                'subject' => "Ada barang baru nih kamu sudah mau kasih kado?"
            ], $data);
        }
    }

    public function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file Adm_kadooku.php */
