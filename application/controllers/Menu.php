<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('menu_m');
		$this->load->model('kategori_m');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->library('image_lib');
		isLogout();
    }

	public function index(){
		$data = array(
			'active_menu' => 'menu',
			'rows' => $this->menu_m->get()->result(),
			'categories' => $this->kategori_m->get()->result(),
			'page_js' => base_url().'custom-js/menu/menu-index.js'
		);
		
		$this->template->load('template', 'menu/menu-index', $data);
    }

    public function edit($id){
		$data = array(
			'active_menu' => 'menu',
			'row' => $this->menu_m->get($id)->row(),
			'rows' => $this->menu_m->get()->result(),
			'categories' => $this->kategori_m->get()->result(),
			'page_js' => base_url().'custom-js/menu/menu-edit.js'
		);
		// echo json_encode($data['row']);
		$this->template->load('template', 'menu/menu-edit', $data);
	}

    public function simpan(){
		$post = $this->input->post(null, true);
		
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|max_length[200]');
		$this->form_validation->set_rules('idkategori', 'Kategori', 'trim|required|numeric');

        $this->form_validation->set_message('required', '{field} masih kosong, silahkan isi.');
		$this->form_validation->set_message('max_length', '{field} maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', '{field} sudah digunakan, silahkan ganti.');
		$this->form_validation->set_message('numeric', '{field} harus berupa numerik.');

		$postData = array(
			'namaMenu' => ucwords($post['namaMenu']),
			'idkategori' => $post['idkategori'],
			'harga' => $post['harga'],
			'deskripsi' => $post['deskripsi'],
		);
		
		if(!$post['idmenu']){ //insert

			$this->form_validation->set_rules('namaMenu', 'Nama Menu', 'trim|required|max_length[100]|is_unique[menu.namaMenu]');

			if ($this->form_validation->run() == FALSE){
				// echo "masuk insert gagal validasi";
				$data = array(
					'active_menu' => 'menu',
					 'rows' => $this->menu_m->get()->result(),
					 'categories' => $this->kategori_m->get()->result(),
					 'page_js' => base_url().'custom-js/menu/menu-index.js'
				);
				$this->session->set_flashdata('danger', 'gagal menambah data');
				$this->template->load('template', 'menu/menu-index', $data);
			}
			else{
				
				var_dump($_FILES);

				if($_FILES['foto']['name'] != null){ // check wheiter image is exist					
					// configurasi upload
					$configurasi['upload_path']          = './uploads/menu/';
					$configurasi['allowed_types']        = 'gif|jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'menu-'.date('Ymd').'-'.substr(md5(rand()),0,10);
				
					// do the upload
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('foto')){ //if upload failed
						$data = array('error' => $this->upload->display_errors());
						$this->template->load('template', 'menu/menu_index', $data);
					}
					else{ //if upload image success

						$postData['foto'] = $this->upload->data('file_name'); //get image name
				
						// insert data to db
						$this->menu_m->add($postData);
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Data berhasil disimpan');
						}
						redirect('menu/index');
					} 
					
				} else {
				
					$this->menu_m->add($postData);
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
					}
					redirect('menu/index');
					
				}
					
				// echo "masuk sini";
			}
		} else { //update

			$this->form_validation->set_rules('namaMenu', 'Nama Menu', 'trim|required|max_length[100]|callback_menu_check');

			if ($this->form_validation->run() == FALSE){
				$data = array(
					'active_menu' => 'menu',
					 'rows' => $this->menu_m->get()->result(),
					 'categories' => $this->kategori_m->get()->result(),
					 'page_js' => base_url().'custom-js/menu/menu-edit.js'
				);
				$this->session->set_flashdata('danger', 'gagal mengupdate data');
				$this->template->load('template', 'menu/menu-edit', $data);
			}
			else{

				if($_FILES['foto']['name'] != null){
					$targetFile = $this->menu_m->get($post['idmenu'])->row()->foto;
					unlink('./uploads/menu/'.$targetFile);

					$configurasi['upload_path']          = './uploads/menu/';
					$configurasi['allowed_types']        = 'gif|jpg|png|jpeg';
					$configurasi['max_size']             = 2048;
					$configurasi['file_name'] = 'menu-'.date('Ymd').'-'.substr(md5(rand()),0,10);
					$this->upload->initialize($configurasi, TRUE);
				
					if (!$this->upload->do_upload('foto')){ //if upload failed
						$data = array('error' => $this->upload->display_errors());
						$this->template->load('template', 'menu/menu_edit', $data);
					}
					else{ //if upload image success

						$postData['foto'] = $this->upload->data('file_name'); //get image name
				
						// insert data to db
						$this->menu_m->update($postData, $post['idmenu']);
						if($this->db->affected_rows() > 0){
							$this->session->set_flashdata('success', 'Data berhasil diupdate');
						}
						redirect('menu/index');
					} 

				} else {
					$this->menu_m->update($postData, $post['idmenu']);
					if($this->db->affected_rows() > 0){
						$this->session->set_flashdata('success', 'Data berhasil diupdate');
					}
					redirect('menu/index');
				}			
			}
		}
    }
    
    public function delete($id){
		$targetFile = $this->menu_m->get($id)->row()->foto;
		unlink('./uploads/menu/'.$targetFile);
		$this->menu_m->delete($id);
		$error = $this->db->error();
		
		if($error['code'] == 1451){
			$this->session->set_flashdata('warning', 'menu tidak dapat dihapus');
		} else {
			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('info', 'Data telah dihapus');			
			}
		}
		redirect('menu/index');
	}

	public function menu_check(){
		$post = $this->input->post(null, true);
		$query = $this->menu_m->menu_check($post['namaMenu'], $post['idmenu']);

		if ($query->num_rows() > 0 ){
			$this->form_validation->set_message('menu_check', '{field} ini sudah digunakan, silahkan ganti.');
			return FALSE;
		} else {
			return TRUE;
		}
		
	}

	public function getItems()
	{
		$items = $this->menu_m->get(null, 'namaMenu', 'asc')->result_array();
		echo json_encode($items);
	}

	public function getDetailItemById()
	{
		$idmenu = $this->input->post('idmenu');
		if($idmenu) {
			$detail_item = $this->menu_m->get($idmenu)->row_array();
			echo json_encode($detail_item);
		}
	}

}
