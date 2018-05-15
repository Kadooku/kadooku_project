<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan komunikasi antara database users
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class User_model extends CI_Model {
    protected $table = 'users';
    protected $pk    = 'id';
    
    /**
     * Fungsi untuk mendaftarkan data user kedalam database
     * @param   [array]     $input  Array data inputan user
     * @author  Rangga Djatikusuma Lukman
     */
    public function user_register($input){
		$encrypt_password = bCrypt($input['password'],12);
		$array_user = array(
				'full_name' => $input['full_name'],
				'username'  => $input['username'],
				'password'  => $encrypt_password,
				'email'     => $input['email']
			);

		$this->db->insert($this->table, $array_user);
	}

    /**
     * Fungsi untuk mengecek data user
     * @param   [string]    $field  kolom pada database
     * @param   [string]    $data   data acuan
     * @return  [int]       jumlah data yang sesuai
     * @author  Rangga Djatikusuma Lukman
     */
	public function exist_row_check($field,$data){
		$this->db->where($field, $data);
		$this->db->from($this->table);
		$query = $this->db->get();
		return $query->num_rows();
	}

    /**
     * Fungsi untuk mengambil detail data user
     * @param   [string]    $username   acuan username yang akan diambil
     * @return  [array]     array data user
     * @author  Rangga Djatikusuma Lukman
     */
	public function get_user_detail($username){
		$this->db->where("username", $username);
		$query = $this->db->get($this->table);

		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

}

/* End of file User_model.php */
