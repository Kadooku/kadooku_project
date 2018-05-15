<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    var $table      = 'products';
    var $pk         = 'id';
    var $categories = 'categories';

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

     /**
     * Description :
     * Fungsi model untuk mengambil data kategori dari database
     * @param {array} $where
     * @author Rangga Djatikusuma Lukman
     */
    public function get_categories($where=NULL)
    {
        $this->db->from($this->categories);
        
        if($where)
            $this->db->where($where);

		$query = $this->db->get();
        
		return $query;
    }

    public function get_detail($slug)
    {
        $this->db->select("{$this->table}.*, {$this->categories}.category_name, {$this->categories}.category_url");
        $this->db->from($this->table); 
        $this->db->join($this->categories, "{$this->table}.category_id={$this->categories}.id", 'left');
        $this->db->where("{$this->table}.product_url", $slug);
        $query = $this->db->get();

        return $query;
    }

    public function getProductImage($id)
    {
        $get = $this->db->get_where($this->table, array($this->pk => $id))->row();
        return json_decode($get->product_image);
    }

}

/* End of file Product_model.php */
