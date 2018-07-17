<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Kelas untuk melakukan komunikasi antara database users
 * @date    22 April 2018
 * @project KadooKu
 * @author  Rangga Djatikusuma Lukman
 */
class User_model extends CI_Model {
    protected $table = 'users';
    protected $pk = 'id';
    
    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('social_login'=>$data['social_login'],'oauth_uid'=>$data['oauth_uid']));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();

        if($prevCheck > 0){
            $get = $prevQuery->row();
            $data['full_name'] = $get->full_name;
            $data['gender']    = $get->gender;
            $prevResult = $prevQuery->row_array();
            $update     = $this->db->update($this->table, $data, array('id'=>$prevResult['id']));
            $userID     = $prevResult['id'];
        }else{  
            $data['username'] = $this->checkUsername($data['username']);
            $insert = $this->db->insert($this->table, $data);
            $userID = $this->db->insert_id();
        }

        return $userID ? $userID : FALSE;
    }

    public function checkUsername($data=NULL)
    {
        $this->db->from($this->table);
        $this->db->where(array('username' => $data));
        $prevQuery = $this->db->get();
        $prevCheck = $prevQuery->num_rows();

        if($prevCheck > 0){
            return $data.$prevCheck++;
        }else{
            return $data;
        }
    }

    public function update($data, $where=NULL){
		if($where)
            $this->db->where($where);

        $this->db->set($data);
		if($this->db->update($this->table, $data)){
            return true;
        }else{
            return false;
        }
    }

}

/* End of file User_model.php */
