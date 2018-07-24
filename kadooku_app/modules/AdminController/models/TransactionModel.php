<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionModel extends CI_Model {

    protected $table     = "transactions";
    protected $product   = "products";
    protected $t_product = "transactions_products";
    protected $confirm   = "transactions_confirms";
    protected $t_user    = "users";

    var $pk         = 'id';

    public function read($where=NULL, $order=NULL, $type=NULL, $limit=NULL, $offset=NULL)
    {
		$this->db->from($this->table);

		if($where)
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
	
	public function updateTransaction($data = NULL, $where = NULL)
	{
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->table, $data)){
            return true;
        }else{
            return false;
        }
	}

    public function getTransactionByKey($key){
        $this->db->select('t.*, u.full_name,
                            p.product_name, p.product_price, tp.qty, tp.subtotal')
				 ->from("{$this->table} t")
				 ->join("{$this->t_product} tp", "t.id = tp.transaction_id")
				 ->join("{$this->t_user} u", "t.user_id = u.id")
				 ->join("{$this->product} p", "p.id = tp.product_id")
		         ->where(array("t.key" => $key));
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
	
	public function getTransactionConfirm($key){
		$this->db->select('t.*, tc.featured_image, tc.created, tc.updated')
				 ->from("transactions_confirms tc")
				 ->join("transactions t", "t.id = tc.transaction_id")
		         ->where("t.key", $key);
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

    public function get_json() {
        $this->datatables->select('id, key, order_time, concat("Rp. ", format(price_total, 0)) price_total, status');
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', '<a href="product/edit/$1" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; <button data-id="$1" id="product-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>', 'id');
        return $this->datatables->generate();
    }    

}

/* End of file TransactionModel.php */
