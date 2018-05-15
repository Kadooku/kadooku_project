<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Json_model');
    }
    

    public function get_provinces()
    {
        $getProvinces = $this->Json_model->getJsonItem();

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'provinces',
            'data'  => $getProvinces->result()
        ]);
    }

    public function get_regencies()
    {
        $province_id  = $this->input->post('province_id');
        $table        = $this->input->post('type');

        $getRegencies = $this->Json_model->getJsonItem($table, array('province_id' => $province_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'regencies',
            'data'  => $getRegencies->result()
        ]);
    }

    public function get_districts()
    {
        $regency_id = $this->input->post('regency_id');
        $table      = $this->input->post('type');

        $getDistricts = $this->Json_model->getJsonItem($table, array('regency_id' => $regency_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'districts',
            'data'  => $getDistricts->result()
        ]);
    }

    public function get_villages()
    {
        $district_id = $this->input->post('district_id');
        $table      = $this->input->post('type');

        $getVillages = $this->Json_model->getJsonItem($table, array('district_id' => $district_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'villages',
            'data'  => $getVillages->result()
        ]);
    }

    public function logistics()
    {
        $district = $this->input->post('district');
        $regency  = $this->input->post('regency');
        $table    = 'list_logistics';

        $getLogistics = $this->Json_model->getJsonItem($table, array('kota_kabupaten LIKE' => "%".$regency."%", 'kecamatan LIKE' => "%".$district."%"));
        
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'logistics',
            'data'  => $getLogistics->result()
        ]);

    }

}

/* End of file Json.php */
