<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_m extends CI_Model {

    protected $table = 'meja';

    public function get($id = null, $column = 'idmeja', $sort = 'desc'){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id){
            $this->db->where('idmeja', $id);
        }
        $this->db->order_by($column, $sort);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idmeja', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('idmeja', $id);
        $this->db->delete($this->table);
    }

    public function meja_check($meja, $id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('nomorMeja', $meja);
        $this->db->where('idmeja !=', $id);
        $query = $this->db->get();
        return $query;
    }

}
