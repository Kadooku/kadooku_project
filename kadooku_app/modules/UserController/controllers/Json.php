<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('JsonModel');
    }
    

    public function getProvinces()
    {
        $getProvinces = $this->JsonModel->getJsonItem();

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'provinces',
            'data'  => $getProvinces->result()
        ]);
    }

    public function getRegencies()
    {
        $province_id  = $this->input->post('province_id');
        $table        = $this->input->post('type');

        $getRegencies = $this->JsonModel->getJsonItem($table, array('province_id' => $province_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'regencies',
            'data'  => $getRegencies->result()
        ]);
    }

    public function getDistricts()
    {
        $regency_id = $this->input->post('regency_id');
        $table      = $this->input->post('type');

        $getDistricts = $this->JsonModel->getJsonItem($table, array('regency_id' => $regency_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'districts',
            'data'  => $getDistricts->result()
        ]);
    }

    public function getVillages()
    {
        $district_id = $this->input->post('district_id');
        $table      = $this->input->post('type');

        $getVillages = $this->JsonModel->getJsonItem($table, array('district_id' => $district_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'villages',
            'data'  => $getVillages->result()
        ]);
    }

    public function getLogistics()
    {
        $district = $this->input->post('district');
        $regency  = $this->input->post('regency');
        $table    = 'list_logistics';

        $getLogistics = $this->JsonModel->getJsonItem($table, array('kota_kabupaten LIKE' => "%".$regency."%", 'kecamatan LIKE' => "%".$district."%"));
        
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'logistics',
            'data'  => $getLogistics->result()
        ]);

    }

    public function getAddressById()
    {
        $address_id = $this->input->post('address_id');
        $user_id    = $this->input->post('user_id');

        $table      = "users_address"; 
        $getAddress = $this->JsonModel->getJsonItem($table, array('id' => $address_id, 'user_id' => $user_id));

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        echo json_encode([
            'items' => 'User Address',
            'data'  => $getAddress->result()
        ]);
    }

}

/* End of file Json.php */
