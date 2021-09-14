<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('tanggal');
		isLogout();
		$this->load->model('order_m');
	}

	public function index()
	{


		$rows = $this->order_m->getMonthlyIncome()->result();
		// print_r($this->db->last_query());
		// exit();
		$monthNames = [];
		$monthIncomes = [];
		foreach ($rows as $index => $value) {
			$monthNames[$index] = $value->month_name;
			$monthIncomes[$index] = $value->total_income;
		}

		$categoryRows = $this->order_m->getSalesByKategori()->result();
		$categories = [];
		$categorySales = [];
		foreach ($categoryRows as $index => $value) {
			$categories[$index] = $value->kategori;
			$categorySales[$index] = $value->sales;
		}

		// echo json_encode($monthNames);

		$earningsMonthly = $this->order_m->getThisMonthIncome(date('Y-m-d'))->row()?? null;

		$data = array(
			'active_menu' => 'dashboard',
			'page_js' => 'custom-js/dashboard.js',
			'earningsMonthly' => $earningsMonthly,
			'rows' => $this->order_m->getMonthlyIncome()->result(),	
			'categoryRows' => $this->order_m->getSalesByKategori()->result(),	
			'categories' => json_encode($categories),
			'categorySales' => json_encode($categorySales),
			'monthNames' => json_encode($monthNames),	
			'totalIncome' => json_encode($monthIncomes),
			// 'totalKendaraan' => $this->db->count_all('kendaraan'),
			// 'totalOutlet' => $this->db->count_all('outlet'),
			// 'totalRute' => $this->db->count_all('rute'),
		);

		// echo json_encode($data['categorySales']);
		// exit();

		// print_r($this->db->last_query());
		// echo json_encode($data);
		$this->template->load('template', 'dashboard',$data);
	}

	

}
