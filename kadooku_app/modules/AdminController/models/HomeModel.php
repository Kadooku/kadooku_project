<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * @author: Rangga Djatikusuma Lukman 
 * @created: 2018-07-21 17:25:56 
 * @updated: 2018-07-21 17:25:56 
 */

class HomeModel extends CI_Model {

    public function countData($table = "users"){
		$this->db->from($table);
		$query = $this->db->get();
		return $query->num_rows();
    }

}

/* End of file HomeModel.php */
