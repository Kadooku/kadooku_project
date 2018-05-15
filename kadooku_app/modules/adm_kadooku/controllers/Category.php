<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    public $kategori;
    private $color = array('bg-emerald', 'bg-olive', 'bg-orange', 'bg-green', 'bg-lime', 'bg-yellow');

    public function index()
    {
        //set kategori
        $this->parent_category();

        $data['kategori'] = $this->kategori;
        $this->template->load('backend/template', 'category/category_view', $data);
    }

    private function parent_category($parent = 0)
    {
        $this->load->model('ProductModel');
        $query = $this->ProductModel->get_categories(array('parent_id' => $parent));

        //cek apakah memiliki hasil
		if($query->num_rows()>0){
			$this->kategori.="<ul style=\"margin-bottom:5px\">";

				//memulai membentuk kategori satu persatu
				foreach ($query->result_array() as $c) {
					$this->kategori .= "<li style=\"margin-bottom:5px\">";
                    $this->kategori .= "<div class=\"bg-blue label label-default label-lg\">
                                            <a href=\"#\" id=\"add_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-plus\"></i></a>&nbsp;
                                                $c[category_name] &nbsp;
                                            <a href=\"#\" id=\"edit_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-pencil\"></i></a>&nbsp;
                                            <a href=\"#\" id=\"delete_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-trash\"></i></a>
                                        </div>";

					// panggil fungsi secara recursive untuk mencari subkategori
                    $this->child_category($c['id'], 1);
                    
					$this->kategori .= "</li>";
				}

			$this->kategori.="</ul>";
		} else {
			return;
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
			$this->kategori.="<ul style=\"margin-bottom:5px;margin-top:5px\">";

				//memulai membentuk kategori satu persatu
				foreach ($query->result_array() as $c) {
					$this->kategori .= "<li style=\"margin-bottom:5px\">";
					$this->kategori .= "<div class=\"$warna label label-default label-lg\">
                                            <a href=\"#\" id=\"add_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-plus\"></i></a>&nbsp;
                                                $c[category_name] &nbsp;
                                            <a href=\"#\" id=\"edit_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-pencil\"></i></a>&nbsp;
                                            <a href=\"#\" id=\"delete_category\" data-id=\"$c[id]\" data-name=\"$c[category_name]\"><i class=\"fa fa-trash\"></i></a>
                                        </div>";

					// panggil fungsi secara recursive untuk mencari subkategori
                    $this->child_category($c['id'], $deep);
                    
					$this->kategori .= "</li>";
				}

			$this->kategori.="</ul>";
		} else {
			return;
        }
    }

}

/* End of file Category.php */
