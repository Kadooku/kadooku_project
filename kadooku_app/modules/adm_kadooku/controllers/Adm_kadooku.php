<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_kadooku extends CI_Controller {

    public function index()
    {
        $this->template->load('backend/template', 'dashboard');
    }

}

/* End of file Adm_kadooku.php */
