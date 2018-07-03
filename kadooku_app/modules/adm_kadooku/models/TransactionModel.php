<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class TransactionModel extends CI_Model {

    var $table      = 'transactions';
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

    public function get_json() {
        $this->datatables->select('id, key, order_time, concat("Rp. ", format(price_total, 0)) price_total, status');
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', '<a href="product/edit/$1" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; <button data-id="$1" id="product-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>', 'id');
        return $this->datatables->generate();
    }    

}

/* End of file TransactionModel.php */
