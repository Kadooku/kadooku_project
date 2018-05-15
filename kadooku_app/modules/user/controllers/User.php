<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan login dan register user
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
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
			$this->load->model('User_model');
			$this->User_model->user_register($this->input->post(NULL,TRUE));
			
            redirect(base_url('user/login'),'refresh');
		}
    }
    
    public function login(){
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
            $this->load->model('User_model');
            
            $getUser = $this->User_model->get_user_detail($input['username']);
			$login_data = array(
                'full_name'       => $getUser->full_name,
                'username'        => $input['username'],
                'profile_picture' => base_url('kadooku_uploads/product/img/'.$getUser->profile_picture),
                'isSocialLogin'   => FALSE,
                'login_status'    => TRUE,
                'isAdmin'         => FALSE
            );

			$this->session->set_userdata('userData', $login_data);

			redirect(base_url());
		}
		
	}

    /**
     * Fungsi untuk mengecek email yang sama pada database
     * @param   [string]    $str    inputan email user
     * @return  [boolean]   true/false
     * @author  Rangga Djatikusuma Lukman
     */
	public function email_check($str){
		$this->load->model('User_model');
		if($this->User_model->exist_row_check('email', $str) > 0){
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
		$this->load->model('User_model');
		if($this->User_model->exist_row_check('username', $str) > 0){
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
        $this->load->model('User_model');
        
        if($this->User_model->exist_row_check('username', $this->username_temp) > 0){
            $user_detail = $this->User_model->get_user_detail($this->username_temp);
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
