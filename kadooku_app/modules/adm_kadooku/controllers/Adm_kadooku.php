<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_kadooku extends CI_Controller {

    public function index()
    {
        $this->template->load('backend/template', 'dashboard');
    }

    public function sendemail()
    {
        $this->load->model("ProductModel");
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

        $data = [
            'product' => $product,
            'nama' => "Rangga Djatikusuma Lukman"
        ];
        $this->email_lib->sendMail([
            'email'   => 'djatikusumadata@gmail.com',
            'subject' => "Lagi cari barang buat hadiah?"
        ], $data);
    }

}

/* End of file Adm_kadooku.php */
