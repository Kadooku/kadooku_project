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
        $this->datatables->add_column('action', '<a href="product/edit/$1" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; <button data-id="$1" id="product-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>', 'id');
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
     * Fungsi model untuk mengubah data
     * @created 21 April 2018
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
     * Description :
     * Fungsi model untuk menghapus data data
     * @created 22 April 2018
     * @param {array} data inputan
     * @author Rangga Djatikusuma Lukman
     */
    public function delete($where=NULL){
		if($where)
            $this->db->where($where);
		$this->db->delete($this->table);
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
