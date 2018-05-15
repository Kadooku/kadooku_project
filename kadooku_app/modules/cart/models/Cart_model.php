<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    var $table    = 'transaction';
    var $pk       = 'id';
    var $products = 'products';

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

}