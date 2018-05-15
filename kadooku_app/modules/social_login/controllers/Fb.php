<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk menggunakan sosial login dengan akun facebook
 * @date 22 April 2018
 * @project KadooKu
 * @author Rangga Djatikusuma Lukman
 */
class Fb extends CI_Controller {

    
    public function __construct()
	{
		parent::__construct();

		// Load library and url helper
		$this->load->library('facebook');
		$this->load->helper('url');

		// load model 
		$this->load->model(array('User_model'));
	}
	
	public function index()
	{
		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			// User logged in, get user details
			$getUser = $this->facebook->request('get', '/me?fields=id,name,email,picture,gender');
			if (!isset($getUser['error']))
			{
				// Menginput data untuk insert database
				$setUserData['social_login']    = 'facebook';
				$setUserData['oauth_uid']       = $getUser['id'];
				$setUserData['full_name']       = $getUser['name'];
				$setUserData['email']           = isset($getUser['email']) ? $getUser['email'] : null;
				$setUserData['gender']          = $getUser['gender'] ? $getUser['gender'] : "other";
				$setUserData['profile_picture'] = $getUser['picture']['data']['url'];
				$setUserData['isSocialLogin']   = TRUE;
				
				$cUser = isset($getUser['email']) ? $getUser['email'] : trim(strtolower($getUser['name']))."@kadooku.dev";
				// membuat username
				$username = explode('@', $cUser);
				$setUserData['username'] = $username[0];
	
				// Insert dan Update data
				$userID = $this->User_model->checkUser($setUserData);
				if(!empty($userID)){
					$setUserData['login_status'] = TRUE;
					$setUserData['isAdmin'] 	 = FALSE;
					$data['userData'] = $setUserData;
					$this->session->set_userdata('userData', $setUserData);
					
					$this->session->userdata('userData');
					
					redirect('','refresh');
					
				} else {
					$data['userData'] = array();
					$this->session->userdata('userData');
					
					redirect('','refresh');
					
				}
			}
		}else{
			$authUrl =  $this->facebook->login_url();
        
            header('Location: '.$authUrl);
		}
	}

}

/* End of file Fb.php */
