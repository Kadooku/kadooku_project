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

    public function change_language($lang = 'ID')
    {
        $url = $this->input->get('redirect');
        switch($lang){
            case 'en' : 
                $this->session->set_userdata('language', 'english');
                break;
            
            default : 
                $this->session->set_userdata('language', 'indonesia');
                break;
        }

        
        redirect(base_url($url),'refresh');
        
    }

    

}

/* End of file Home.php */
