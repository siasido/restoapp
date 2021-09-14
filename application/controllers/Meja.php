<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('meja_m');
		$this->load->library('form_validation');
		isLogout();
    }

	public function index(){
		$data['active_menu'] ='meja';
		$data['rows'] = $this->meja_m->get()->result();
		$data['page_js'] = base_url().'custom-js/meja/meja-index.js';
		$this->template->load('template', 'meja/meja-index', $data);
    }


    public function edit($id){
		$data['active_menu'] = 'meja';
		$data['page_js'] = base_url().'custom-js/meja/meja-edit.js';
		$data['row'] = $this->meja_m->get($id)->row();
		$data['rows'] = $this->meja_m->get()->result();
		$this->template->load('template', 'meja/meja-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);

		$postData = array(
			'nomorMeja' => $post['nomorMeja'],
			'kapasitas' => $post['kapasitas']
		);
		
		$this->form_validation->set_rules('nomorMeja', 'Nomor Meja', 'trim|required|max_length[20]|is_unique[meja.nomorMeja]');
		$this->form_validation->set_rules('kapasitas', 'Kapasitas', 'trim|numeric|required');
		
        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('numeric', '{field} harus berupa numerik.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		
		if(!$post['idmeja']){ //insert

			if ($this->form_validation->run() == FALSE){
				$data['active_menu'] = 'meja';
				$data['page_js'] = base_url().'custom-js/meja/meja-index.js';
				$data['rows'] = $this->meja_m->get()->result();
				$this->session->set_flashdata('danger', 'gagal menambah data');
				$this->template->load('template', 'meja/meja-index', $data);
			}
			else{
				

				$this->meja_m->add($postData);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
				}
				redirect('meja/index');	
				// echo "masuk sini";
			}
		} else { //update

			$this->form_validation->set_rules('nomorMeja', 'Nomor Meja', 'trim|required|max_length[20]|callback_meja_check');

			if ($this->form_validation->run() == FALSE){
				// print($this->db->last_query());
				$data['active_menu'] = 'meja';
				$data['page_js'] = base_url().'custom-js/meja/meja-edit.js';
				$data['rows'] = $this->meja_m->get()->result();
				$this->session->set_flashdata('danger', 'gagal mengupdate data');
				$this->template->load('template', 'meja/meja-edit', $data);
			}
			else{
				$this->meja_m->update($postData, $post['idmeja']);
				if($this->db->affected_rows() > 0){
					$this->session->set_flashdata('success', 'Data berhasil diupdate');
				}	
				redirect('meja/index');				
			}
		}
    }
    
    public function delete($id){
		$this->meja_m->delete($id);
		$error = $this->db->error();
		
		if($error['code'] == 1451){
			$this->session->set_flashdata('warning', 'rekening yang telah digunakan untuk Trip tidak dapat dihapus!');
		} else {
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('info', 'Data telah dihapus');			
			}
		}
		redirect('meja/index');
	}

	public function meja_check(){
		$post = $this->input->post(null, true);
		$query = $this->meja_m->meja_check($post['nomorMeja'], $post['idmeja']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('meja_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
		
	}

}
