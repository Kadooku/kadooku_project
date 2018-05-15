<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk fungsi cart/pembelian
 * @date 27 April 2018
 * @project KadooKu
 * @author Rangga Djatikusuma Lukman
 */
class Cart extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model('Cart_model');
    }
    
    public function index()
    {
        $data = [
            'title'    => "Shopping Cart",
            'products' => $this->cart->contents(),
            'total'    => $this->cart->total()
        ];
        $this->template->load('public/template', 'cart', $data);
    }

    /**
     * Fungsi untuk menambah ke session keranjang pembelian
     * @return  [json]   $result    array data pembelian user
     * @author  Rangga Djatikusuma Lukman
     */
    public function add_to_cart(){
        $product = $this->Cart_model->getProduct($this->input->post('product_id'));
        $data    = array(
            'id'    => $this->input->post('product_id'),
            'name'  => $this->input->post('product_name'),
            'price' => $this->input->post('product_price'),
            'qty'   => $this->input->post('quantity'),
        );
        if($product->product_amount < $this->input->post('quantity')){
            $result = [
                'status'  => false,
                'message' => "Stok untuk {$this->input->post('product_name')} hanya tersedia sebanyak {$product->product_amount} item"
            ];
        }else if($product->product_amount === 0){
            $result = [
                'status'  => false,
                'message' => "Mohon maaf stok item habis"
            ];
        }else{
            $this->cart->insert($data);
            $result = [
                'status'     => true,
                'total_item' => $this->cart->total_items()
            ];
        }
        
        echo json_encode($result);
    }

    /**
     * Fungsi untuk mengubah item session keranjang pembelian
     * @return  [json]   $result    array data pembelian user
     * @author  Rangga Djatikusuma Lukman
     */
    public function update_cart()
    {
        
        $item    = $this->cart->get_item($this->input->post('product_id'));
        $product = $this->Cart_model->getProduct($item['id']);
        $data    = array(
            'rowid' => $this->input->post('product_id'),
            'qty'   => $this->input->post('quantity')
        );
        if($product->product_amount < $this->input->post('quantity')){
            $result = [
                'status'  => false,
                'message' => "Stok untuk {$this->input->post('product_name')} hanya tersedia sebanyak {$product->product_amount} item"
            ];
        }else if($product->product_amount === 0){
            $result = [
                'status'  => false,
                'message' => "Mohon maaf stok item habis"
            ];
        }else{
            if($this->cart->update($data)){
                $item   = $this->cart->get_item($this->input->post('product_id'));
                $result = [
                    'status'     => true,
                    'total_item' => $this->cart->total_items(),
                    'subtotal'   => rupiah($item['subtotal']),
                    'total'      => rupiah($this->cart->total())
                ];
            }
        }

        echo json_encode($result);   
    }

    public function show_cart()
    {
        echo "<pre>";
        print_r($this->cart->contents());        
        echo "</pre>";
    }

    public function destroy_cart()
    {
        $this->cart->destroy();
        echo "<pre>";
        print_r($this->cart->contents());        
        echo "</pre>";
    }

    /**
     * Fungsi untuk menghapus session item dari keranjang pembelian
     * @return  [json]   $result    array data pembelian user
     * @author  Rangga Djatikusuma Lukman
     */
    public function remove_cart()
    {
        $rowid = $this->input->post('product_id');

        $result = [];
        if($this->cart->remove($rowid))
            $result = [
                'status'     => true,
                'total_item' => $this->cart->total_items(),
                'total'      => rupiah($this->cart->total())
            ];

        echo json_encode($result);        
    }
}

/* End of file Cart.php */
