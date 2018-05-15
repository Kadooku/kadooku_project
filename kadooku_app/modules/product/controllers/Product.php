<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');

        // Load Model
        $this->load->model(array('Product_model'));
    }

    public function index($page=1)
    {
        $data = [
            'title' => 'Product',
            'categories' => $this->Product_model->get_categories()->result()
        ];
        $this->template->load('public/template', 'product_list', $data);
    }
    
    /**
     * Description :
     * Fungsi untuk mengambil 8 data product yang ada di database
     * @return {json} mengembalikan nilai data array dalam bentuk json
     * @author Rangga Djatikusum Lukman
     */
    public function get()
    {
        $get = $this->Product_model->read(null, "created_at", "DESC", 8, 1)->result();
        $result = [
            'message' => 'success',
            'result'  => $get
        ];

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Description :
     * Fungsi untuk mengambil semua data product yang ada di database
     * @return {json} mengembalikan nilai data array dalam bentuk json
     * @author Rangga Djatikusum Lukman
     */
    public function get_list()
    {
        // Mengambil kondisi berdasarkan inputan user
        $where = [];
        $sort  = [
            'order' => null,
            'type'  => null
        ];
        
        if($this->input->get('category'))
            $category = $this->Product_model->get_categories(array('category_url' => $this->input->get('category')))->row();
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


        $page      = empty($this->input->get('page')) ? 1 : $this->input->get('page');
        $perpage   = 9;
        $get       = $this->Product_model->read($where, $sort['order'], $sort['type'], $perpage, ($page-1)*$perpage)->result();
        $sql       = $this->Product_model->read($where);
        $totalpage = floor($sql->num_rows() / $perpage);
        $result    = [
            'message'       => count($get) < 1 ? 'fail' : 'success',
            'total_product' => $sql->num_rows(),
            'per_page'      => $perpage,
            'total_page'    => $totalpage,
            'next_page'     => ($page==$totalpage || $page>$totalpage) ? null : $page+1,
            'result'        => $get
        ];

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    /**
     * Description :
     * Fungsi untuk menampilkan detail product berdasarkan product url 
     * @return {view} menampilkan halaman detail product
     * @author Rangga Djatikusum Lukman
     */
    public function detail($slug = null)
    {
        $sql = $this->Product_model->get_detail($slug);
        if($slug && $sql->num_rows() > 0){
            $get = $sql->row();
            $data = [
                'title' => $get->product_name,
                'result' => $get
            ];

            $this->template->load('public/template', 'product_view', $data);
        }else{ 
            redirect('/','refresh');
            
        }
    }

}

/* End of file Product.php */
