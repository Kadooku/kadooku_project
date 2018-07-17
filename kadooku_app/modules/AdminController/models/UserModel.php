<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    protected $table   = 'users';
    protected $admin   = 'admins';

    /**
     * Description :
     * Fungsi model untuk mengambil data dari database
     * @param {array} $where
     * @param {string} $order, $type [ASC, DESC]
     * @param {int} $limit, $offset
     * @author Rangga Djatikusuma Lukman
     */
    public function read($where=NULL, $order=NULL, $type=NULL, $limit=NULL, $offset=NULL)
    {
		$this->db->from($this->table);

		if($where != null)
            $this->db->where($where);

        if(($limit) && ($offset)){
            $this->db->limit($limit,$offset);
        }
        else if($limit){
            $this->db->limit($limit);
        }
        
        if($order && $type)
			$this->db->order_by($order, $type);

		$query = $this->db->get();
        
		return $query;
    }

    /**
     * Description :
     * Fungsi model untuk mengubah data
     * @created 16 April 2018
     * @param {array} data inputan
     * @author Rangga Djatikusuma Lukman
     */
    public function update($data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
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
		$this->db->from($this->admin);
		$query = $this->db->get();
		return $query->num_rows();
	}

     /**
     * Fungsi untuk mengambil detail data user
     * @param   [string]    $username   acuan username yang akan diambil
     * @return  [array]     array data user
     * @author  Rangga Djatikusuma Lukman
     */
	public function getAdminDetailByUsername($username){
		$this->db->where("username", $username);
		$query = $this->db->get($this->admin);

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

/* End of file UserModel.php */
