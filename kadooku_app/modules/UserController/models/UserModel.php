<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan komunikasi antara database users
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class UserModel extends CI_Model {
    protected $table   = 'users';
    protected $pk      = 'id';
    protected $address = 'users_address';
    
    /**
     * Fungsi untuk mendaftarkan data user kedalam database
     * @param   [array]     $input  Array data inputan user
     * @author  Rangga Djatikusuma Lukman
     */
    public function userRegister($input){
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
	public function getUserDetailByUsername($username){
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

	public function getAddressDetailById($id){
		$this->db->where("id", $id);
		$query = $this->db->get($this->address);

		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	public function getUserAddressbyUsername($username){
		$this->db->select('a.id, a.name, a.`address`, a.`phone`, a.`status`, a.`zipcode`, a.user_id, 
							p.`name` province, p.id province_id, 
							r.`name` regency, r.id regency_id,
							d.`name` district, d.id district_id,
							v.`name` village, v.id village_id')
				 ->from("{$this->table} u")
				 ->join("{$this->address} a", "u.id = a.user_id")
				 ->join("provinces p", "p.id = a.province_id")
				 ->join("regencies r", "r.id = a.regency_id")
				 ->join("districts d", "d.id = a.district_id")
				 ->join("villages v", "v.id = a.village_id")
		         ->where("u.username", $username);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			$data = $query->result();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	public function addAddress($data = null)
	{
		if($data != NULL){
        	$this->db->insert($this->address, $data);
            return true;
        }else{
            return false;
        }
	}

	public function updateProfile($data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->table, $data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function updateAddress($data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->address, $data)){
            return true;
        }else{
            return false;
        }
	}
	
	public function deleteAddress($where=NULL){
		if($where)
            $this->db->where($where);
		if($this->db->delete($this->address)){
            return true;
        }else{
            return false;
        }
	}

}

/* End of file User_model.php */
