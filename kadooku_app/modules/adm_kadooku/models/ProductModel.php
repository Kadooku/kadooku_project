<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

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

    public function get_json() {
        $this->datatables->select('id, product_name, concat("Rp. ", format(product_price, 0)) as product_price, product_amount');
        $this->datatables->from($this->table);
        $this->datatables->add_column('action', '<a href="product/edit/$1" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; <a href="#delete?id=$1" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>', 'id');
        return $this->datatables->generate();
    }

    /**
     * Description :
     * Fungsi model untuk menyimpan data kedalam database
     * @param {array} data inputan
     * @author Rangga Djatikusuma Lukman
     */
    public function insert($data=NULL)
    {
        if($data != NULL){
            $this->db->insert($this->table,$data);
            return true;
        }else{
            return false;
        }
    }

    /**
     * Description :
     * Fungsi model untuk mengambil data kategori dari database
     * @param {array} $where
     * @param {string} $order, $type [ASC, DESC]
     * @param {int} $limit, $offset
     * @author Rangga Djatikusuma Lukman
     */
    public function get_categories($where=NULL, $order=NULL, $type=NULL, $limit=NULL, $offset=NULL)
    {
		$this->db->from($this->categories);

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

/* End of file ProductModel.php */
