<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta'); 
		$this->load->model('order_m');
        $this->load->model('pelanggan_m');
        $this->load->model('meja_m');
		$this->load->model('menu_m');
		$this->load->library('form_validation');
		echo setlocale(LC_ALL,'id_ID');
		isLogout();
    }

	public function index(){
		
        $data = array(
            'active_menu' => 'order',
            'rows' => $this->order_m->get()->result(),
            'page_js' => base_url().'custom-js/order/order-index.js',
            'members' => $this->pelanggan_m->get(null, 'nama', 'asc')->result(),
			'items' => $this->menu_m->get(null, 'namaMenu', 'asc')->result(),
            'tables' => $this->meja_m->get(null, 'nomorMeja', 'asc')->result()
        );
		// print_r($this->db->last_query());
		$this->template->load('template', 'order/order-index', $data);
    }

    public function edit($id){
		$data = array(
            'active_menu' => 'order',
			'row' => $this->order_m->get($id)->row(),
            'rows' => $this->order_m->get()->result(),
			'selected_items' => $this->order_m->getSelectedItems($id)->result(),
            'page_js' => base_url().'custom-js/order/order-index.js',
            'members' => $this->pelanggan_m->get(null, 'nama', 'asc')->result(),
			'items' => $this->menu_m->get(null, 'namaMenu', 'asc')->result(),
            'tables' => $this->meja_m->get(null, 'nomorMeja', 'asc')->result()
        );
		// print_r($data['row']);
		$this->template->load('template', 'order/order-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);
        $countOrder= $this->order_m->countOrders(date('Y-m-d')); # count the latest order
        $noPesanan = date('Ymd'). sprintf("%04d", $countOrder+1);
		// echo json_encode($noPesanan);

		$postData = array(
			'nomorbill' => $noPesanan,
			'orderdate' => date('Y-m-d H:i:s'),
			'idmeja' => $post['idmeja'],
			'idpelanggan' => $post['idpelanggan'],
			'gross_amount' => $post['gross_amount'],
			'tax' => $post['tax_charge'],
			'net_amount' => $post['net_amount'],
			'paidstatus' => 0,
			'totalpayment' => 0,
			'sisakembalian' => 0,
			
		);

		if(!$post['orderid']){ //insert
			$this->order_m->add($postData);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Data berhasil disimpan');
			}
			redirect('order/index');	
			
		} else { //update

			$paidstatus= $post['totalpayment'] >= $post['net_amount'] ? 1 : 0;
			$postData['paidstatus'] = $paidstatus;
			$postData['totalpayment'] = $post['totalpayment'];
			$postData['sisakembalian'] = $post['sisakembalian'];

			$this->order_m->update($postData, $post['orderid']);
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('success', 'Data berhasil disimpan');
			}
			redirect('order/index');
			
		}
    }
    
    public function delete($id){
		$this->order_m->delete($id);
		$error = $this->db->error();
		
		if($error['code'] == 1451){
			$this->session->set_flashdata('warning', '');
		} else {
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('info', 'Data telah dihapus');			
			}
		}
		redirect('order/index');
	}

	public function cetakReceipt($id){
		$data = array(
            'active_menu' => 'order',
			'row' => $this->order_m->get($id)->row(),
			'selected_items' => $this->order_m->getSelectedItems($id)->result()
        );
		$this->load->view('receipt/receipt', $data);

	}
	


}
