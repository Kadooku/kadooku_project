<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk fungsi cart/pembelian
 * @date 27 April 2018
 * @project KadooKu
 * @author Rangga Djatikusuma Lukman
 */
class CartController extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        $this->load->model('CartModel');
    }
    
    public function index()
    {
        $data = [
            'title'    => "Shopping Cart",
            'products' => $this->cart->contents(),
            'total'    => $this->cart->total()
        ];
        $this->template->load('public/template', 'cartView', $data);
    }

    /**
     * Fungsi untuk menambah ke session keranjang pembelian
     * @return  [json]   $result    array data pembelian user
     * @author  Rangga Djatikusuma Lukman
     */
    public function addToCart(){
        $productId = $this->input->post('product_id');
        if(!empty($productId)){
            $product = $this->CartModel->getProduct($productId);
            $data    = array(
                'id'    => $productId,
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
        }else{
            redirect('','refresh');
        }
    }

    /**
     * Fungsi untuk mengubah item session keranjang pembelian
     * @return  [json]   $result    array data pembelian user
     * @author  Rangga Djatikusuma Lukman
     */
    public function updateCart()
    {
        
        $item    = $this->cart->get_item($this->input->post('product_id'));
        $product = $this->CartModel->getProduct($item['id']);
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

    public function payment()
    {
        $sess = $this->session->userdata('userData');

        if($this->cart->total_items() < 1){
            redirect('cart','refresh');
        }
        $post = $this->input->post(NULL, TRUE);
        if(!@$post['payment_method']){
            $data = [
                'title'    => "Payment",
                'sess'     => $sess,
                'products' => $this->cart->contents(),
                'subtotal' => $this->cart->total(),
                'payments' => $this->CartModel->getPayment()
            ];
            
            $this->template->load('public/template', 'paymentView', $data);
        }else{
            unset($_SESSION['cart_session']);
            // set payment method
            if(!$this->session->has_userdata('cart_session')){
                $this->session->set_userdata('cart_session', [
                    'payment_method' => $post['payment_method']
                ]);
            }
           redirect('cart/checkout');
           //printData($_SESSION['cart_session']);
            
        }
        
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
    public function removeCart()
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
