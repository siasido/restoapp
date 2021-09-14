<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_M extends CI_Model {

    protected $table1 = 'menu';
    protected $table2 = 'kategori';

    public function get($id = null, $column = 'idmenu', $sort ='desc'){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->table1.'.idkategori = '.$this->table2.'.idkategori');
        if($id){
            $this->db->where($this->table1.'.idmenu', $id);
        }
        $this->db->order_by($this->table1.'.'.$column, $sort);
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        $this->db->insert($this->table1, $data);
    }

    public function update($data, $id){
        
        $this->db->where('idmenu', $id);
        $this->db->update($this->table1, $data);
    }

    public function delete($id){
        $this->db->where('idmenu', $id);
        $this->db->delete($this->table1);
    }

    public function menu_check($namaMenu, $id){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->where('namaMenu', $namaMenu);
        $this->db->where('idmenu !=', $id);
        $query = $this->db->get();
        return $query;
    }

}
