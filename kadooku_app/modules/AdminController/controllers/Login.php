<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->load->library('form_validation');
		$input = $this->input->post(NULL,TRUE);
		$this->username_temp = @$input['username'];

		$this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_password_check');
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');


		if($this->form_validation->run() == FALSE){
			$this->template->load('backend/login_form', 'login/form_view');
		}
		else{
			$this->load->library('session');
            $this->load->model('UserModel');
            
            $getUser = $this->UserModel->getAdminDetailByUsername($input['username']);
			$login_data = array(
                'name'            => $getUser->name,
                'username'        => $input['username'],
                'isSocialLogin'   => FALSE,
                'login_status'    => TRUE,
                'isAdmin'         => TRUE
            );

			$this->session->set_userdata('adminData', $login_data);

			redirect(base_url('adm_kadooku'));
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
            $user_detail = $this->UserModel->getAdminDetailByUsername($this->username_temp);
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

}

/* End of file Login.php */
