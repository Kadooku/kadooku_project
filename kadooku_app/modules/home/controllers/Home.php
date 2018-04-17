<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
	}

    /**
     * @description
     * @param
     * @return 
     */
    public function index()
    {
        $this->template->load('public/template', 'home_view');
    }

    

}

/* End of file Home.php */
