<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan login dan register user
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class UserController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }

    public function index()
    {
        $sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }

        // Get Detail User
        $this->load->model("UserModel");
        $user = $this->UserModel->getUserDetailByUsername($sess['username']);
        $data = [
            'title' => "Profile[{$user->full_name}]",
            'user'  => $user,
            'sess'  => $sess
        ];

        $this->template->load('public/template', 'profile_user', $data);
    }

    /**
     * Fungsi update profil user
     * @author Rangga Djatikusuma Lukman
     */
    public function update()
    {
        $this->load->model("UserModel");
        $sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }

        $this->load->library('form_validation');
        $post = $this->input->post(NULL, TRUE);
        $this->username_temp = @$post['username'];

        if(empty($post['username'])){
            redirect(base_url('user'));
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('phone', 'No Telephone', 'min_length[10]');
        if(!$sess['isSocialLogin'] && !empty($post['current_password']) && !empty($post['new_password'])){
            $this->form_validation->set_rules('new_password', 'New Password', 'min_length[5]');
            $this->form_validation->set_rules('current_password', 'Current Password', 'callback_password_check');
        }
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} kurang dari 5 digit');


		if($this->form_validation->run() == FALSE){
			$this->index();
        }else{
            $newsletter = @$post['enableNewsLetter'];
            $data = [
                'full_name'        => $post['full_name'],
                'phone'            => $post['phone'],
                'enableNewsLetter' => ($newsletter == 'on') ? true : false,
                'gender'           => $post['gender'],
                'birthday'         => date('Y-m-d',strtotime($post['birthday']))
            ];
            if(!empty($post['current_password']) && !empty($post['new_password'])){
                $data['password'] = bCrypt($post['new_password'],12);
            }
            $this->UserModel->updateProfile($data, array('username' => $post['username']));
            
            redirect(base_url('user'),'refresh');
            
        }
    }
    
    /**
     * Fungsi register user
     * @author Rangga Djatikusuma Lukman
     */
    public function register(){
        // inisialisasi form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
		$this->form_validation->set_rules('full_name', 'Nama Lengkap', 'required|max_length[30]');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
		$this->form_validation->set_message('valid_email', 'silahkan ketikkan format email yang benar');
		$this->form_validation->set_message('min_length', 'password kurang dari 5 digit');
        $this->form_validation->set_error_delimiters('<p class="alert">','</p>');
        
        // cek validasi
		if($this->form_validation->run() == FALSE){
			$this->template->load('public/template', 'form_register');
		}
		else{
			$this->load->model('UserModel');
			$this->UserModel->userRegister($this->input->post(NULL,TRUE));
			
            redirect(base_url('user/login'),'refresh');
		}
    }
    
    public function login($redirect = NULL){
		$this->load->library('form_validation');
		$input = $this->input->post(NULL,TRUE);
		$this->username_temp = @$input['username'];

		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');


		if($this->form_validation->run() == FALSE){
			$this->template->load('public/template', 'form_login');
		}
		else{
			$this->load->library('session');
            $this->load->model('UserModel');
            $redirectUrl = !is_null($redirect) ? $redirect : "";
            $getUser = $this->UserModel->getUserDetailByUsername($input['username']);
			$login_data = array(
                'full_name'       => $getUser->full_name,
                'username'        => $input['username'],
                'profile_picture' => base_url('kadooku_uploads/product/img/'.$getUser->profile_picture),
                'isSocialLogin'   => FALSE,
                'login_status'    => TRUE,
                'isAdmin'         => FALSE
            );

			$this->session->set_userdata('userData', $login_data);

			redirect(base_url($redirect));
		}
		
	}

    /**
     * Fungsi untuk mengecek email yang sama pada database
     * @param   [string]    $str    inputan email user
     * @return  [boolean]   true/false
     * @author  Rangga Djatikusuma Lukman
     */
	public function email_check($str){
		$this->load->model('UserModel');
		if($this->UserModel->exist_row_check('email', $str) > 0){
            $this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_message('email_check', 'Email telah digunakan');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

    /**
     * Fungsi untuk mengecek username yang sama pada database
     * @param   [string]    $str    inputan username user
     * @return  [boolean]   true/false
     * @author  Rangga Djatikusuma Lukman
     */
	public function username_check($str){
		$this->load->model('UserModel');
		if($this->UserModel->exist_row_check('username', $str) > 0){
            $this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_message('username_check', 'Username telah digunakan');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}	

    /**
     * Fungsi untuk mengecek password yang sama pada database pada saat login
     * @param   [string]    $str    inputan password user
     * @return  [boolean]   true/false
     * @author  Rangga Djatikusuma Lukman
     */
	public function password_check($str){
        $this->load->model('UserModel');
        
        if($this->UserModel->exist_row_check('username', $this->username_temp) > 0){
            $user_detail = $this->UserModel->getUserDetailByUsername($this->username_temp);
            if($user_detail->password == crypt($str,$user_detail->password)){
                return TRUE;
            }
            else{
                $this->form_validation->set_message('password_check','Password yang dimasukkan tidak sesuai');
                return FALSE;
            }
        }else{
            $this->form_validation->set_message('password_check','Username yang dimasukkan tidak sesuai');
            return FALSE;
        }
  
    }
    
    public function logout(){
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file User.php */
