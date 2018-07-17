<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan sosial login dengan menggunakan akun google
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class Google extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('User_model'));
    }
    

    public function index()
    {
        $gapi          = $this->config->item('googleplus_api');
        $client_id     = $gapi['client_id'];
        $client_secret = $gapi['client_secret'];
        $redirect_uri  = base_url('social_login/google');

        // Konfigurasi Client Google
        $client = new Google_Client();
        $client->setApplicationName('Login to KadooKu');
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("email");
        $client->addScope("profile");
        $google_oauthV2 = new Google_Service_Oauth2($client);

        if (isset($_REQUEST['code'])) {
            $client->authenticate($_REQUEST['code']);
            $this->session->set_userdata('token', $client->getAccessToken());
            redirect($redirect_uri);
        }

        $token = $this->session->userdata('token');
        if (!empty($token)) {
            $client->setAccessToken($token);
        }

        if ($client->getAccessToken()) {
            $getUser = $google_oauthV2->userinfo->get();

            // Menginput data untuk insert database
            $setUserData['social_login']    = 'google';
            $setUserData['oauth_uid']       = $getUser['id'];
            $setUserData['full_name']       = $getUser['given_name']." ".$getUser['family_name'];
            $setUserData['email']           = $getUser['email'];
            $setUserData['gender']          = $getUser['gender'] ? $getUser['gender'] : "O";
            $setUserData['profile_picture'] = $getUser['picture'];
            $setUserData['isSocialLogin']   = TRUE;

            // membuat username
            $username = explode('@', $getUser['email']);
            $setUserData['username'] = $username[0];

            // Insert dan Update data
            $userID = $this->User_model->checkUser($setUserData);
            if(!empty($userID)){
                $setUserData['login_status'] = TRUE;
                $setUserData['isAdmin']      = FALSE;
                $data['userData'] = $setUserData;
                $this->session->set_userdata('userData', $setUserData);
                
                redirect('','refresh');
            } else {
                $data['userData'] = array();
                redirect('','refresh');
            }
        } else {
            $authUrl = $client->createAuthUrl();
        
            header('Location: '.$authUrl);
        }
    }

}

/* End of file Google.php */
