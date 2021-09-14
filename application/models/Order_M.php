<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_M extends CI_Model {

    protected $table1 = 'orders';
    protected $table2 = 'order_items';
    protected $table3 = 'meja';
    protected $table4 = 'pelanggan';
    protected $table5 = 'menu';

    public function get($id = null){
        $this->db->select('*');
        $this->db->from($this->table1);
        // $this->db->join($this->table2, $this->table1.'.orderid = '.$this->table2.'.orderid');
        $this->db->join($this->table3, $this->table1.'.idmeja = '.$this->table3.'.idmeja');
        $this->db->join($this->table4, $this->table1.'.idpelanggan = '.$this->table4.'.idpelanggan');
        if($id){
            $this->db->where($this->table1.'.orderid', $id);
        }
        $this->db->order_by($this->table1.'.orderid', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function getSelectedItems($id = null){
        $this->db->select('*');
        $this->db->from($this->table1);
        $this->db->join($this->table2, $this->table1.'.orderid = '.$this->table2.'.orderid');
        $this->db->join($this->table5, $this->table2.'.idmenu = '.$this->table5.'.idmenu');
        if($id){
            $this->db->where($this->table1.'.orderid', $id);
        }
        $this->db->order_by($this->table1.'.orderid', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    public function add($data){
        
        $insert = $this->db->insert($this->table1, $data);
		$order_id = $this->db->insert_id();

        $count_product = count($this->input->post('items'));
    	for($i = 0; $i < $count_product; $i++) {
    		$items = array(
    			'orderid' => $order_id,
    			'idmenu' => $this->input->post('items')[$i],
    			'qty' => $this->input->post('qty')[$i],
    			'harga' => $this->input->post('harga_value')[$i],
    			'amount' => $this->input->post('amount_value')[$i],
    		);

    		$this->db->insert('order_items', $items);
    	}

        $this->load->model('meja_m');
    	$this->meja_m->update(array('available' => 0),$this->input->post('idmeja'));

        return ($order_id) ? $order_id : false;

    }

    public function update($data, $id){

        $this->db->where($this->table1.'.orderid', $id);
        $this->db->update($this->table1, $data);

        $this->db->where($this->table2.'.orderid', $id);
        $this->db->delete($this->table2);

        // $insert = $this->db->insert($this->table1, $data);
		// $order_id = $this->db->insert_id();

        $count_product = count($this->input->post('items'));
    	for($i = 0; $i < $count_product; $i++) {
    		$items = array(
    			'orderid' => $id,
    			'idmenu' => $this->input->post('items')[$i],
    			'qty' => $this->input->post('qty')[$i],
    			'harga' => $this->input->post('harga_value')[$i],
    			'amount' => $this->input->post('amount_value')[$i],
    		);

    		$this->db->insert('order_items', $items);
    	}

        $this->load->model('meja_m');
    	$this->meja_m->update(array('available' => 1),$this->input->post('idmeja'));
        
        
    }

    public function delete($id){
        $this->db->where('orderid', $id);
        $this->db->delete($this->table1);
    }

    public function countOrders($param){
        $this->db->like('orderdate', $param);
        $this->db->from($this->table1);
        return $this->db->count_all_results(); // Produces an integer, like 17
    }

    public function getMonthlyIncome(){
        $query = 'SELECT MONTHNAME(orderdate) as month_name, 
                        SUM(net_amount) as total_income 
                        FROM orders 
                        where paidstatus = 1 
                        GROUP BY YEAR(orderdate), MONTH(orderdate) 
                        ORDER BY MONTH(orderdate)';
        return $this->db->query($query);
    }

    public function getThisMonthIncome($param){
        $query = 'SELECT MONTHNAME(orderdate) as month_name, 
                        SUM(net_amount) as total_income 
                        FROM orders 
                        where MONTH(orderdate) = MONTH(\''.$param.'\')
                        GROUP BY YEAR(orderdate), MONTH(orderdate) 
                        ORDER BY MONTH(orderdate)';
        return $this->db->query($query);
    }

    public function getSalesByKategori(){
        $query = 'SELECT kategori.kategori, count(orders.orderid) as sales
                    FROM orders join order_items 
                        on orders.orderid = order_items.orderid 
                        join menu 
                        on menu.idmenu = order_items.idmenu 
                        join kategori 
                        on kategori.idkategori = menu.idkategori 
                        where orders.paidstatus = 1
                        GROUP BY kategori.kategori';
        return $this->db->query($query);
    }

}
