<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('pelanggan_m');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
		// echo json_encode($data);
		$data['active_menu'] ='pelanggan';
		$data['rows'] = $this->pelanggan_m->get()->result();
		
		$data['page_js'] = null;
		$this->template->load('template', 'pelanggan/pelanggan-index', $data);
    }


    public function edit($id){
		$data['active_menu'] = 'pelanggan';
		$data['page_js'] = base_url().'custom-js/pelanggan/pelanggan-edit.js';
		$data['row'] = $this->pelanggan_m->get($id)->row();
		$data['rows'] = $this->pelanggan_m->get()->result();
		$this->template->load('template', 'pelanggan/pelanggan-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);
		// echo json_encode($post);

		$postData = array(
			'nama' => ucwords($post['nama']),
			'noHP' => $post['noHP']
		);
		
		$this->form_validation->set_rules('nama', 'Nama Pelanggan', 'trim|required|max_length[50]');
		
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} telah digunakan, silahkan pilih nomor lain.');
		
		if(!$post['idpelanggan']){ //insert

			// echo json_encode($post);
			$this->form_validation->set_rules('noHP', 'No. HP', 'trim|max_length[15]|is_unique[pelanggan.noHP]');

			if ($this->form_validation->run() == FALSE){
				$data['active_menu'] = 'pelanggan';
				$data['page_js'] = base_url().'custom-js/pelanggan/pelanggan-index.js';
				$data['rows'] = $this->pelanggan_m->get()->result();
				$this->session->set_flashdata('danger', 'gagal menambah data');
				$this->template->load('template', 'pelanggan/pelanggan-index', $data);
			}
			else{
				$this->pelanggan_m->add($postData);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('pelanggan/index');	
			}
		} else { //update

			$this->form_validation->set_rules('nama', 'nama', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('noHP', 'No. HP', 'trim|max_length[15]|callback_pelanggan_check');

			if ($this->form_validation->run() == FALSE){
				// print($this->db->last_query());
				$data['active_menu'] = 'pelanggan';
				$data['page_js'] = base_url().'custom-js/pelanggan/pelanggan-edit.js';
				$data['rows'] = $this->pelanggan_m->get()->result();
				$this->session->set_flashdata('danger', 'gagal mengupdate data');
				$this->template->load('template', 'pelanggan/pelanggan-edit', $data);
			}
			else{
				$this->pelanggan_m->update($postData, $post['idpelanggan']);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('success', 'Data berhasil diupdate');
				}	
				redirect('pelanggan/index');				
			}
		}
    }
    
    public function delete($id){
		$this->pelanggan_m->delete($id);
		$error = $this->db->error();
		
		if($error['code'] == 1451){
			$this->session->set_flashdata('warning', '');
		} else {
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('info', 'Data telah dihapus');			
			}
		}
		redirect('pelanggan/index');
	}

	public function pelanggan_check(){
		$post = $this->input->post(null, true);
		$query = $this->pelanggan_m->pelanggan_check($post['noHP'], $post['idpelanggan']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('pelanggan_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
		
	}

}
