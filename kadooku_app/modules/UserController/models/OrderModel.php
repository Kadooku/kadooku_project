<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderModel extends CI_Model {

    protected $table     = "transactions";
    protected $confirm   = "transactions_confirms";
    protected $product   = "products";
    protected $t_product = "transactions_products";

    public function getUserOrders($where = NULL)
    {
        $this->db->from($this->table);

		if($where != NULL)
            $this->db->where($where);

		$query = $this->db->get();
        
		return $query;
    }

    public function getAddressById($id){
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
			$data = $query->result();
			$query->free_result();
		}
		else{
			$data = NULL;
		}

		return $data;
    }
    
    public function getOrderDetail($key, $user_id){
        $this->db->select('t.*,
                            p.product_name, p.product_price, tp.qty, tp.subtotal')
				 ->from("{$this->table} t")
				 ->join("{$this->t_product} tp", "t.id = tp.transaction_id")
				 ->join("{$this->product} p", "p.id = tp.product_id")
		         ->where(array("t.key" => $key, "t.user_id" => $user_id));
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
    
    public function getPayment($id)
    {
        return $this->db->get_where('payment_method', array('id' => $id))->row();
	}
	
	public function changeStatusPaid($key = NULL)
	{
		$data = array('status' => 'paid');

		$this->db->where('key', $key);
		$this->db->set($data);
		if($this->db->update($this->table, $data)){
            return true;
        }else{
            return false;
        }
	}

	public function insertConfirm($data = NULL)
	{
		if($data != NULL){
        	$this->db->insert($this->confirm, $data);
            return true;
        }else{
            return false;
        }
	}

}

/* End of file Order_model.php */
