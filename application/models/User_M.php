<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_M extends CI_Model {

    protected $table = 'user';
    
    public function login($data){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('username', $data['username']);
        $this->db->where('password', sha1($data['password']));
        $query = $this->db->get();
        return $query;
    }
    
}
