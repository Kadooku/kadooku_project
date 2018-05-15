<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ProductModel'));
        $this->load->library(array('Datatables'));

        // Load Language
        $idiom = $this->session->get_userdata('language');
        $this->lang->load('site', 'indonesia');
    }
    
    public function index()
    {
        $this->template->load('backend/template', 'adm_kadooku/product/product_view');
    }

	/**
	 * Description :
	 * Fungsi untuk menampilkan halaman tambah produk pada admin user
	 * @created 10 April 2018
	 * @return view
	 * @author Rangga Djatkusuma Lukman
	 */
    public function add()
    {
        $data = [
            'action'     => 'adm_kadooku/product/store',
            'title'      => "KadooKu - ".lang('add_product'),
            'categories' => $this->ProductModel->get_categories(array('parent_id' => 0))->result()
        ];
        $this->template->load('backend/template', 'adm_kadooku/product/product_add', $data);
	}
	
	/**
	 * Description :
	 * Fungsi untuk menampilkan halaman ubah data produk pada admin user
	 * @created 10 April 2018
	 * @return view
	 * @author Rangga Djatkusuma Lukman
	 */
    public function edit($id = null)
    {
		$getProduct = $this->ProductModel->read(array('id' => $id));
		if($id != null && $getProduct->num_rows() > 0){
			$setProduct = $getProduct->row();
			$data = [
				'action'     => 'adm_kadooku/product/update',
				'title'      => "KadooKu - ".lang('edit_product'),
				'product'    => $setProduct,
				'categories' => $this->ProductModel->get_categories(array('parent_id' => 0))->result(),
				'images'     => json_decode($setProduct->product_image)
			];
			$this->template->load('backend/template', 'adm_kadooku/product/product_edit', $data);
		}
        else{
			$message = array(
				'msg'   => 'Product tidak ditemukan.',
				'code'  => 1,
				'alert' => 'warning',
				'icon'  => 'info'
			);
			$this->session->set_flashdata($message);
			redirect('adm_kadooku/product');
			
		}
    }

	/**
	 * Description :
	 * Fungsi untuk menyimpan data dari inputan field tambah product
	 * @created 10 April 2018
	 * @return notif sukses
	 * @author Rangga Djatikusuma Lukman
	 */
    public function store()
	{
		// Mengambil data inputan dari field
		$post = $this->input->post(NULL);

		if(!empty($post['product_name'])){
			$data = array(
				'product_name'        => $post['product_name'],
				'product_description' => $post['product_description'],
				'product_information' => $post['product_information'],
				'product_price'       => $post['product_price'],
				'product_amount'      => $post['product_amount'],
				'arrival_date'        => $post['arrival_date'],
				'category_id'         => $post['category_id'],
				'discount'            => $post['discount'],
				'start_discount'      => $post['start_discount'],
				'end_discount'        => $post['end_discount'],
				'created_at'          => date('Y-m-d G:i:s'),
				'product_url'         => str_replace('-','', crc32(date('G:i:s')))."_".url_title($post['product_name'], '-', true)
			);

			//upload
			$config['upload_path']   = './kadooku_uploads/product/original/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = '100000';
			$config['encrypt_name']  = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
            $image = array();
			for ($i=1; $i <=3 ; $i++) { 
	            if(!empty($_FILES['featured_image'.$i]['name'])){
	                if(!$this->upload->do_upload('featured_image'.$i))
	                {
                        $file_img = "default.jpg";
	                }
	                else{
	                	$file     = $this->upload->data();
	                	$file_img = !empty($file['file_name']) ? $file['file_name'] : "default.jpg";
						$this->_watermark($file);
                    }
	            }else {
	            	$file_img = "default.jpg";
                }
                array_push($image, $file_img);
	        }
			$data['product_image'] = json_encode($image);
			
			// validasi insert pada database product
	        if($this->ProductModel->insert($data)){
				// pesan 
				$message = array(
					'msg'   => 'Product berhasil ditambahkan.',
					'code'  => 1,
					'alert' => 'success',
					'icon'  => 'disk'
				);
				$this->session->set_flashdata($message);

				// mengalihkan
	        	redirect('adm_kadooku/product');
	        }else{
				// pesan
				$message = array(
					'msg'   => 'Terjadi kesalahan ketika menambah product, mohon ulangi kembali',
					'code'  => 1,
					'alert' => 'error',
					'icon'  => 'info'
				);
				$this->session->set_flashdata($message);

				// mengalihkan
	        	redirect('adm_kadooku/product/add');
	        }
	        
		}
	}

	/**
	 * Description :
	 * Fungsi untuk menyimpan data pembaruan single data
	 * @created 21 April 2018
	 * @return notif sukses
	 * @author Rangga Djatikusuma Lukman
	 */
    public function update()
	{
		// Mengambil data inputan dari field
		$post = $this->input->post(NULL);

		// get single data product
		$getProduct = $this->ProductModel->read(array('id' => $post['id']));
		$setProduct = $getProduct->row();
		$getImage = json_decode($setProduct->product_image);

		if($getProduct->num_rows() > 0){
			$data = array(
				'product_name'        => $post['product_name'],
				'product_description' => $post['product_description'],
				'product_information' => $post['product_information'],
				'product_price'       => $post['product_price'],
				'product_amount'      => $post['product_amount'],
				'arrival_date'        => $post['arrival_date'],
				'category_id'         => $post['category_id'],
				'discount'            => $post['discount'],
				'start_discount'      => $post['start_discount'],
				'end_discount'        => $post['end_discount'],
				'updated_at'          => date('Y-m-d G:i:s'),
				'product_url'         => str_replace('-','', crc32(date('G:i:s')))."_".url_title($post['product_name'], '-', true)
			);

			//upload
			$config['upload_path']   = './kadooku_uploads/product/original/';
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['max_size']      = '100000';
			$config['encrypt_name']  = TRUE;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
            $image = array();
			for ($i=1; $i <=3 ; $i++) { 
	            if(!empty($_FILES['featured_image'.$i]['name'])){
	                if(!$this->upload->do_upload('featured_image'.$i))
	                {
                        $file_img = $getImage[$i-1];
	                }
	                else{
	                	$file     = $this->upload->data();
	                	$file_img = !empty($file['file_name']) ? $file['file_name'] : $getImage[$i-1];
						$this->_watermark($file);

						// hapus file
						if($getImage[$i-1] != "default.jpg"){
							unlink(FCPATH."kadooku_uploads/product/img/".$getImage[$i-1]);
							unlink(FCPATH."kadooku_uploads/product/original/".$getImage[$i-1]);
						}
                    }
	            }else {
	            	$file_img = $getImage[$i-1];
                }
                array_push($image, $file_img);
	        }
			$data['product_image'] = json_encode($image);
			
			// validasi update pada database product
	        if($this->ProductModel->update($data, array('id' => $post['id']))){
				// pesan 
				$message = array(
					'msg'   => 'Product berhasil diubah.',
					'code'  => 1,
					'alert' => 'success',
					'icon'  => 'disk'
				);
				$this->session->set_flashdata($message);

				// mengalihkan
	        	redirect('adm_kadooku/product');
	        }else{
				// pesan
				$message = array(
					'msg'   => 'Terjadi kesalahan ketika mengubah product, mohon ulangi kembali',
					'code'  => 1,
					'alert' => 'error',
					'icon'  => 'info'
				);
				$this->session->set_flashdata($message);

				// mengalihkan
	        	redirect('adm_kadooku/product/edit/'.$post['id']);
	        }
		}else{
			// pesan
			$message = array(
				'msg'   => 'Product tidak ditemukan',
				'code'  => 1,
				'alert' => 'error',
				'icon'  => 'info'
			);
			$this->session->set_flashdata($message);

			// mengalihkan
			redirect('adm_kadooku/product');
		}
	}

	/**
	 * Description :
	 * Fungsi untuk menghapus data
	 * @created 22 April 2018
	 * @return notif sukses
	 * @author Rangga Djatikusuma Lukman
	 */
	public function delete($id=NULL)
	{
		$getProduct = $this->ProductModel->read(array('id' => $id));
		$setProduct = $getProduct->row();
		$getImage = json_decode($setProduct->product_image);

		if($id && $getProduct->num_rows() > 0){
			$this->ProductModel->delete(array('id' => $id));
			foreach($getImage as $img){
				if($img != "default.jpg"){
					unlink(FCPATH."kadooku_uploads/product/img/".$img);
					unlink(FCPATH."kadooku_uploads/product/original/".$img);
				}
			}
			$message = array(
				'msg'   => 'Product berhasil dihapus', 
				'code'  => 1, 
				'alert' => 'success', 
				'icon'  => 'trash'
	    	);
	        $this->session->set_flashdata($message);
			redirect(base_url('adm_kadooku/product'));
		}else{
			$message = array(
				'msg'   => 'Product tidak ditemukan', 
				'code'  => 1, 
				'alert' => 'warning', 
				'icon'  => 'info'
	    	);
	        $this->session->set_flashdata($message);
			redirect(base_url('adm_kadooku/product'));
		}
	}

	public function get_json()
	{
		header('Content-Type: application/json');
        echo $this->ProductModel->get_json();
	}

	public function category_json()
	{
		$id = $this->input->post('parent_id') ? $this->input->post('parent_id') : 0;
		$this->load->model('ProductModel');
		$query = $this->ProductModel->get_categories(array('parent_id' => $id));
		$result = [
			'parent' => $this->input->post('parent') ? $this->input->post('parent') : false,
			'total_item' => $query->num_rows(),
			'categories' => $query->result()
		];

		header('Content-Type: application/json');
		echo json_encode($result);
	}
	
	/**
	 * Description :
	 * Fungsi untuk menambah watermark pada gambar yang diunggah ke website KadooKu
	 * @created 10 April 2018
	 * @return image
	 * @author Rangga Djatikusuma Lukman
	 */
	private function _watermark($file){
		$config['image_library']   = 'gd2';
		$config['source_image']    = $file['full_path'];
		$config['wm_overlay_path'] = './kadooku_uploads/logo.png';
		$config['wm_type']         = 'overlay';
		$config['new_image']       = './kadooku_uploads/product/img/';
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->watermark(); 
	}
	
	/**
	 * Description :
	 * Fungsi untuk merubah ukuran pada gambar yang diunggah ke website KadooKu
	 * @created 10 April 2018
	 * @return image
	 * @author Rangga Djatikusuma Lukman
	 */
	private function _resize($file){
		$config['image_library']  = 'gd2';
		$config['source_image']   = $file['full_path'];
		$config['create_thumb']   = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width']          = 220;
		$config['height']         = 460;
		$config['new_image']      = './kadooku_uploads/product/thumbnail/';
		$this->load->library('image_lib', $config);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}
}

/* End of file Product.php */
