<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }
    

    public function index()
    {
        $data = [
            'title'        => "Checkout",
            'subtotal'     => $this->cart->total()
        ];
        
        //$this->session->set_userdata('payment', $data);
        $this->template->load('public/template', 'checkout', $data);
    }

}

/* End of file Checkout.php */
