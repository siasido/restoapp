<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_m extends CI_Model {

    protected $table = 'kategori';

    public function get($id = null, $column = 'idkategori', $sort ='desc'){
        $this->db->select('*');
        $this->db->from($this->table);
        if($id){
            $this->db->where('idkategori', $id);
        }
        $this->db->order_by($column, $sort);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idkategori', $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id){
        $this->db->where('idkategori', $id);
        $this->db->delete($this->table);
    }

    public function kategori_check($kategori, $id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kategori', $kategori);
        $this->db->where('idkategori !=', $id);
        $query = $this->db->get();
        return $query;
    }

}
