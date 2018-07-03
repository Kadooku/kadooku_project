<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        // Load Model
        $this->load->model(array('ProductModel'));
    }

    public function index($page=1)
    {
        $data = [
            'title'      => 'Product',
            'categories' => $this->ProductModel->getCategories()->result()
        ];
        $this->template->load('public/template', 'productListView', $data);
    }
    
    /**
     * Description :
     * Fungsi untuk mengambil 8 data product yang ada di database
     * @return {json} mengembalikan nilai data array dalam bentuk json
     * @author Rangga Djatikusum Lukman
     */
    public function getJson()
    {
        $getAllProduct = $this->ProductModel->read(null, "created_at", "DESC", 8, 1)->result();
        $data = [
            'message' => 'success',
            'result'  => $getAllProduct
        ];

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Description :
     * Fungsi untuk mengambil semua data product yang ada di database
     * @return {json} mengembalikan nilai data array dalam bentuk json
     * @author Rangga Djatikusum Lukman
     */
    public function getList()
    {
        // Mengambil kondisi berdasarkan inputan user
        $where = [];
        $sort  = [
            'order' => null,
            'type'  => null
        ];
        
        if($this->input->get('category'))
            $category = $this->ProductModel->getCategories(array('category_url' => $this->input->get('category')))->row();
        if(!empty($category))
            $where['category_id'] = $category->id;
        if($this->input->get('q'))
            $where['product_name LIKE'] = "%".$this->input->get('q')."%";
        if($this->input->get('maxPrice'))
            $where['product_price <='] = $this->input->get('maxPrice');
        if($this->input->get('minPrice'))
            $where['product_price >='] = $this->input->get('minPrice');
        if($this->input->get('sort'))
            $sort = ['order' => 'product_price', 'type' => $this->input->get('sort')];


        $page           = empty($this->input->get('page')) ? 1 : $this->input->get('page');
        $perpage        = 9;
        $getListProduct = $this->ProductModel->read($where, $sort['order'], $sort['type'], $perpage, ($page-1)*$perpage)->result();
        $queryProduct   = $this->ProductModel->read($where);
        $countProducts  = $queryProduct->num_rows();
        $totalPage      = floor($countProducts / $perpage);
        $data           = [
            'message'       => count($getListProduct) < 1 ? 'fail' : 'success',
            'total_product' => $countProducts,
            'per_page'      => $perpage,
            'total_page'    => $totalPage,
            'next_page'     => ($page==$totalPage || $page>$totalPage) ? null : $page+1,
            'result'        => $getListProduct
        ];

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Description :
     * Fungsi untuk menampilkan detail product berdasarkan product url 
     * @return {view} menampilkan halaman detail product
     * @author Rangga Djatikusum Lukman
     */
    public function getDetailBySlug($slug = null)
    {
        $getProduct = $this->ProductModel->getDetailBySlug($slug);
        if($slug && $getProduct->num_rows() > 0){
            $resultProduct = $getProduct->row();
            $data = [
                'title'  => $resultProduct->product_name,
                'result' => $resultProduct
            ];

            $this->template->load('public/template', 'productDetailView', $data);
        }else{ 
            redirect('/','refresh');
            
        }
    }

}

/* End of file Product.php */
