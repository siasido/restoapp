<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_M extends CI_Model {

    protected $table = 'pelanggan';

    public function get($id = null, $column = 'idpelanggan', $sort = 'desc'){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id){
            $this->db->where('idpelanggan', $id);
        }
        $this->db->order_by($column, $sort);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idpelanggan', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('idpelanggan', $id);
        $this->db->delete($this->table);
    }

    public function pelanggan_check($pelanggan, $id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('noHP', $pelanggan);
        $this->db->where('idpelanggan !=', $id);
        $query = $this->db->get();
        return $query;
    }

}
