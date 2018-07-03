<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Address extends CI_Controller {

    protected $sess;

    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
        $this->load->model('UserModel');

        // Check status login 
        $this->sess = $this->session->userdata('userData');
        // Cek Status Login
        if(!$this->sess['login_status']){ 
            redirect(base_url('user/login'),'refresh');
        }
    }

    public function index()
    {
        // Get Detail User
        $address = $this->UserModel->getUserAddressByUsername($this->sess['username']);
        $user    = $this->UserModel->getUserDetailByUsername($this->sess['username']);

        $data = [
            'title'   => "Address[{$user->full_name}]",
            'user'    => $user,
            'address' => $address,
            'sess'    => $this->sess
        ];
        $this->template->load('public/template', 'profile_address', $data);
    }

    public function add()
    {
        // inisialisasi form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Penerima', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('phone', 'No. Telephone', 'required|min_length[10]');
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
        $this->form_validation->set_message('min_length', '{field} kurang dari 10 digit');
        
        // cek validasi
        if($this->form_validation->run() == FALSE){
            redirect(base_url('user/address'));
        }
        else{
            $this->UserModel->addAddress($this->input->post(NULL,TRUE));
            
            redirect(base_url('user/address'),'refresh');
        }
    }

    public function update($id)
    {
        $post = $this->input->post(NULL, TRUE);
        // cek SESSION ID dengan USER ID dari inputan
        $getUser = $this->UserModel->getUserDetailByUsername($this->sess['username']);
        if($getUser->id == $post['user_id']){
            // Cek ID paramater dengan ID dari field input
            if($id == $post['id']){
                // inisialisasi form validation
                $this->load->library('form_validation');
                $this->form_validation->set_rules('name', 'Nama Penerima', 'required');
                $this->form_validation->set_rules('address', 'Alamat', 'required');
                $this->form_validation->set_rules('phone', 'No. Telephone', 'required|min_length[10]');
                $this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi');
                $this->form_validation->set_message('min_length', '{field} kurang dari 10 digit');
                
                // cek validasi
                if($this->form_validation->run() == FALSE){
                    redirect(base_url('user/address'));
                }
                else{
                    $data = [
                        'name'        => $post['name'],
                        'phone'       => $post['phone'],
                        'address'     => $post['address'],
                        'province_id' => $post['province_id'],
                        'regency_id'  => $post['regency_id'],
                        'district_id' => $post['district_id'],
                        'village_id'  => $post['village_id']
                    ];
                    $this->UserModel->updateAddress($data, array('id' => $post['id']));
                    
                    redirect(base_url('user/address'),'refresh');
                }
            }else{
                redirect(base_url('user/address'),'refresh');
            }
        }else{
            redirect(base_url('user/address'),'refresh');
        }
    }

    public function remove_address()
    {
        $id      = $this->input->post('id');
        $user_id = $this->input->post('user_id');

        $result = [];
        // cek SESSION ID dengan USER ID dari inputan
        $getUser = $this->UserModel->getUserDetailByUsername($this->sess['username']);
        if($getUser->id == $user_id){
            $address = $this->UserModel->getAddressDetailById($id);
            if($address->status != 1){
                if($this->UserModel->updateAddress(array('isActive' => false, 'user_id' => 1), array('id' => $id)))
                    $result = [
                        'status'  => true,
                        'message' => "Alamat berhasil dihapus."
                    ];
            }else{
                $result = [
                    'status'  => false,
                    'message' => "Terjadi kesalahan, alamat yang dihapus merupakan alamat primary."
                ];
            }
        }else{
            $result = [
                'status'  => false,
                'message' => "Terjadi kesalahan, mohon ulangi perintah."
            ];
        }

        echo json_encode($result);        
    }

    public function set_primary()
    {
        $id      = $this->input->post('id');
        $user_id = $this->input->post('user_id');

        $result = [];
        // cek SESSION ID dengan USER ID dari inputan
        $getUser = $this->UserModel->getUserDetailByUsername($this->sess['username']);
        if($getUser->id == $user_id){
            $address = $this->UserModel->getAddressDetailById($id);
            if($address->status != 1){
                // set all to secondary
                $this->UserModel->updateAddress(array('status' => 2), array('user_id' => $user_id));

                // set to primary
                if($this->UserModel->updateAddress(array('status' => 1), array('id' => $id, 'user_id' => $user_id)))
                    $result = [
                        'status'  => true,
                        'message' => "Alamat berhasil diset utama."
                    ];
            }else{
                $result = [
                    'status'  => false,
                    'message' => "Terjadi kesalahan, alamat yang diset merupakan alamat primary."
                ];
            }
        }else{
            $result = [
                'status'  => false,
                'message' => "Terjadi kesalahan, mohon ulangi perintah."
            ];
        }

        echo json_encode($result);  
    }
}

/* End of file Address.php */
