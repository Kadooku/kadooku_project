<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SocialController extends CI_Controller {

    public function index()
    {
        
    }

    public function logout()
    {
        $this->session->unset_userdata('token');
        $this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect('');
    }

}

/* End of file Social_login.php */
