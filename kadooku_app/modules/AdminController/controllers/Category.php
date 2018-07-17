<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public $kategori;
    private $color = array('bg-emerald', 'bg-olive', 'bg-orange', 'bg-green', 'bg-lime', 'bg-yellow');

    
    public function __construct()
    {
        parent::__construct();
        $sess = $this->session->userdata('adminData');
        // Cek Status Login
        if(!$sess['isAdmin'] && !$sess['isLogin']){ 
            redirect(base_url('adm_kadooku/login'),'refresh');
        }
    }
    

    public function index()
    {
        //set kategori
        $this->parent_category();

        $this->load->model('ProductModel');
        $query = $this->ProductModel->get_categories(array('parent_id' => 0));

        $data['kategori']     = $this->kategori;
        $data['listCategory'] = $query->result();
        $this->template->load('backend/template', 'category/category_view', $data);
    }

    public function edit($slug)
    {
        $this->load->model('ProductModel');
        $post     = $this->input->post(NULL, TRUE);
        $category = $this->ProductModel->get_categories(array('category_url' => $slug))->row();
        if(empty($post)){
            $data = [
                "category"   => $category,
                "categories" => $this->ProductModel->get_categories(array("parent_id" => 0))->result(),
                "parent"     => $this->ProductModel->get_categories(array('id' => $category->parent_id))->row()
            ];
            $this->template->load('backend/template', 'category/category_edit', $data);
        }else{
            $data = [
                "category_name"        => $post['category_name'],
                "category_description" => $post['category_description'],
                "category_url"         => url_title($post['category_name'], '-', true),
                "parent_id"            => $post['parent_id']
            ];
            if($this->ProductModel->updateCategory($data, array('id' => $category->id))){
                $message = array(
                    'msg'   => 'Kategori '.$category->category_name.' telah diperbarui',
                    'code'  => 1,
                    'alert' => 'success',
                    'icon'  => 'check'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/category'));
            }else{
                $message = array(
                    'msg'   => 'Kategori '.$category->category_name.' gagal diperbarui',
                    'code'  => 1,
                    'alert' => 'danger',
                    'icon'  => 'info'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/category'));
            }
        }
    }

    public function add()
    {
        $this->load->model('ProductModel');
        $post     = $this->input->post(NULL, TRUE);
        if(empty($post)){
            $data = [
                "categories" => $this->ProductModel->get_categories(array("parent_id" => 0))->result()
            ];
            $this->template->load('backend/template', 'category/category_add', $data);
        }else{
            $data = [
                "category_name"        => $post['category_name'],
                "category_description" => $post['category_description'],
                "category_url"         => url_title($post['category_name'], '-', true),
                "parent_id"            => $post['parent_id']
            ];
            if($this->ProductModel->insertCategory($data)){
                $message = array(
                    'msg'   => 'Kategori '.$post['category_name'].' telah diperbarui',
                    'code'  => 1,
                    'alert' => 'success',
                    'icon'  => 'check'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/category'));
            }else{
                $message = array(
                    'msg'   => 'Kategori '.$post['category_name'].' gagal diperbarui',
                    'code'  => 1,
                    'alert' => 'danger',
                    'icon'  => 'info'
                );
                $this->session->set_flashdata($message);
                redirect(base_url('adm_kadooku/category'));
            }
        }
    }

    private function parent_category($parent = 0)
    {
        $this->load->model('ProductModel');
        $query = $this->ProductModel->get_categories(array('parent_id' => $parent));

        //cek apakah memiliki hasil
		if($query->num_rows()>0){
				//memulai membentuk kategori satu persatu
				foreach ($query->result_array() as $c) {
			        $this->kategori.="<tr>";
					$this->kategori .= "<td>{$c['category_name']}</td>";
					$this->kategori .= "<td><div class=\"bg-blue label label-default label-lg\">Utama</div></td>";
					$this->kategori .= "<td>{$c['category_description']}</td>";
					$this->kategori .= "<td>{$c['category_url']}</td>";
                    $this->kategori .= '<td><a href="category/edit/'.$c["category_url"].'" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; 
                                            <button data-id="'.$c["id"].'" id="category-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                                        </td>';
                    /* $this->kategori .= "<div class=\"bg-blue label label-default label-lg\">
                                            <a href=\"#\" id=\"add_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-plus\"></i></a>&nbsp;
                                                $c[category_name] &nbsp;
                                            <a href=\"#\" id=\"edit_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-pencil\"></i></a>&nbsp;
                                            <a href=\"#\" id=\"delete_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-trash\"></i></a>
                                        </div>"; */

					// panggil fungsi secara recursive untuk mencari subkategori
                    $this->child_category($c['id'], 1);
                    $this->kategori.="</tr>";
				}
		} else {
			return;
        }
    }

    /**
	 * Description :
	 * Fungsi untuk menghapus data
	 * @created 16 Juli 2018
	 * @return notif sukses
	 * @author Rangga Djatikusuma Lukman
	 */
	public function delete($id=NULL)
	{
        $this->load->model('ProductModel');
		$category = $this->ProductModel->get_categories(array('id' => $id))->row();

		if($id && count($category) > 0){
            $message = array(
				'msg'   => 'Kategori '.$category->category_name.' berhasil dihapus', 
				'code'  => 1, 
				'alert' => 'success', 
				'icon'  => 'trash'
	    	);
	        $this->session->set_flashdata($message);
			$this->ProductModel->deleteCategory(array('id' => $id));
			redirect(base_url('adm_kadooku/category'));
		}else{
			$message = array(
				'msg'   => 'Kategori tidak ditemukan', 
				'code'  => 1, 
				'alert' => 'warning', 
				'icon'  => 'info'
	    	);
	        $this->session->set_flashdata($message);
			redirect(base_url('adm_kadooku/category'));
		}
	}

    private function child_category($parent, $lv)
    {
        $this->load->model('ProductModel');
        $deep=1+$lv;
        $warna = $this->color[$deep];
        $query = $this->ProductModel->get_categories(array('parent_id' => $parent));

        //cek apakah memiliki hasil
		if($query->num_rows()>0){
				//memulai membentuk kategori satu persatu
				foreach ($query->result_array() as $c) {
                    $this->kategori .= "<tr>";
                    $this->kategori .= "<td>&nbsp;</td>";
                    $this->kategori .= "<td>{$c['category_name']}</td>";
					$this->kategori .= "<td>{$c['category_description']}</td>";
                    $this->kategori .= "<td>{$c['category_url']}</td>";
                    $this->kategori .= '<td><center><a href="category/edit/'.$c["category_url"].'" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a> &nbsp; 
                                            <button data-id="'.$c["id"].'" id="category-delete" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button></center>
                                        </td>';
                    
					/* $this->kategori .= "<li style=\"margin-bottom:5px\">";
					$this->kategori .= "<div class=\"$warna label label-default label-lg\">
                                            $c[category_name] &nbsp;
                                            <a href=\"#\" id=\"edit_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-pencil\"></i></a>&nbsp;
                                            <a href=\"#\" id=\"delete_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-trash\"></i></a>
                                        </div>"; */

					// panggil fungsi secara recursive untuk mencari subkategori
                    // $this->child_category($c['id'], $deep);

                    $this->kategori .= "</tr>";
				}
		} else {
			return;
        }
    }

}

/* End of file Category.php */
