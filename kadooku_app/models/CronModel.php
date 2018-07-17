<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CronModel extends CI_Model {

    protected $table = "transactions";

    /**
     * Description :
     * Fungsi model untuk mengambil data dari database
     * @param {array} $where
     * @param {string} $order, $type [ASC, DESC]
     * @param {int} $limit, $offset
     * @author Rangga Djatikusuma Lukman
     */
    public function read($where=NULL, $order=NULL, $type=NULL, $limit=NULL, $offset=NULL)
    {
		$query = $this->db->query("SELECT * FROM transactions
                            WHERE NOW() > transactions.`time_late` AND transactions.`status` = 'pending'");
        
		return $query;
    }

    /**
     * Description :
     * Fungsi model untuk mengubah data
     * @created 21 April 2018
     * @param {array} data inputan
     * @author Rangga Djatikusuma Lukman
     */
    public function update($data, $where=NULL){
		if($where!=null)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->table,$data)){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file CronModel.php */