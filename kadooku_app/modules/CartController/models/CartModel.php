<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CartModel extends CI_Model {

    var $transactions          = 'transactions';
    var $transactions_products = 'transactions_products';
    var $pk                    = 'id';
    var $key                   = 'key';
    var $products              = 'products';
    var $users                 = 'users';
    var $address               = 'users_address';
    var $payment               = 'payment_method';

    public function getProductItem($id)
    {
        $get    = $this->db->get_where($this->products, array($this->pk => $id))->row();
        $result = [
            'slug'  => $get->product_url,
            'image' => json_decode($get->product_image)
        ];
        return $result;
    }

    public function getProduct($id)
    {
        return $this->db->get_where($this->products, array($this->pk => $id))->row();
	}

	public function getPayment()
	{
		return $this->db->get($this->payment)->result();
	}

	public function getPaymentById($id)
	{
		return $this->db->get_where($this->payment, array($this->pk => $id))->row();
	}
	
	public function getProductByKey($id, $userId)
    {
        return $this->db->get_where($this->transactions, array($this->key => $id, 'user_id' => $userId))->row();
    }

    public function getAddressByUsername($username)
    {
        $this->db->select('a.id, a.name, a.`address`, a.`phone`, a.`status`, a.`zipcode`, a.user_id, 
							p.`name` province, p.id province_id, 
							r.`name` regency, r.id regency_id,
							d.`name` district, d.id district_id,
							v.`name` village, v.id village_id')
				 ->from("users u")
				 ->join("users_address a", "u.id = a.user_id")
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
	
	public function get_user_detail($username){
		$this->db->where("username", $username);
		$query = $this->db->get($this->users);

		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}

	// address
	public function addAddress($data = null)
	{
		if($data != NULL){
        	$this->db->insert($this->address, $data);
            $insert_id = $this->db->insert_id();

   			return  $insert_id;
        }else{
            return false;
        }
	}

    public function getAddressById($id)
    {
        $this->db->select('a.id, a.name, a.`address`, a.`phone`, a.`status`, a.`zipcode`, a.user_id, 
							p.`name` province, p.id province_id, 
							r.`name` regency, r.id regency_id,
							d.`name` district, d.id district_id,
							v.`name` village, v.id village_id')
				 ->from("users u")
				 ->join("users_address a", "u.id = a.user_id")
				 ->join("provinces p", "p.id = a.province_id")
				 ->join("regencies r", "r.id = a.regency_id")
				 ->join("districts d", "d.id = a.district_id")
				 ->join("villages v", "v.id = a.village_id")
		         ->where("a.id", $id);
		$query = $this->db->get();

		if($query->num_rows() > 0){
			$data = $query->row();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
	}
	

	// product

	public function addTransaction($data = NULL)
	{
		if($data != NULL){
            $this->db->insert($this->transactions, $data);
            $insert_id = $this->db->insert_id();

   			return  $insert_id;
        }else{
            return false;
        }
	}

	public function addTransactionProduct($data = NULL)
	{
		if($data != NULL){
            $this->db->insert_batch($this->transactions_products, $data);
            return true;
        }else{
            return false;
        }
	}

	public function updateProduct($data = NULL, $where = NULL)
	{
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->products, $data)){
            return true;
        }else{
            return false;
        }
	}
}