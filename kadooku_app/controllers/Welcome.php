<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data = [
			'product' => "",
			'nama'    => "RANGGA DL"
		];
		$this->load->view('email/product_layout', $data);
	}

	public function cancel_transaction()
	{
		$this->load->model("CronModel");
		$getTransaction = $this->CronModel->read()->result();
		$data = array(
			"status" => "canceled"
		);
		foreach($getTransaction as $transaction){
			if($this->CronModel->update($data, array('id' => $transaction->id))){
				print "Berhasil updated \n";
			}
		}
	}
}
