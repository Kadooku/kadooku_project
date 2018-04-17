<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    var $table = 'products';
    var $pk    = 'id';

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

}

/* End of file Product_model.php */
