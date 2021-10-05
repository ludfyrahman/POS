<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Barang_Masuk extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		$this->low = "barang_masuk";
		$this->cap = "Barang Masuk";
		$this->load->helper("Response_helper");
		$this->load->helper("Input_helper");
		date_default_timezone_set('Asia/Jakarta');
		// if(!isset($_SESSION['kode_user'])){
		// 	redirect(base_url());
		// }
		if($this->uri->segment(2) == "add" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->store($this->uri->segment(4));
		}else if($this->uri->segment(2) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->update($this->uri->segment(3));
		}
    }
    public function index(){
		$data['title'] = "Data $this->cap";
		$data['content'] = "$this->low/index";
		$data['data'] = $this->db->query("SELECT p.nama as nama_produk,bm.total,bm.pembayaran, bm.id_produk,s.nama as nama_suplier, bm.created_at, SUM(bm.jumlah)jumlah, bm.id FROM $this->low bm JOIN produk p ON bm.id_produk=p.id JOIN suplier s ON bm.id_suplier=s.id GROUP BY bm.id_produk")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['type'] = 'Tambah';
		$data['produk'] = $this->db->get('produk')->result_array();
		$data['suplier'] = $this->db->get('suplier')->result_array();
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}

	public function store(){
		$d = $_POST;
		try{
			$arr =
			[
				'id_suplier' => $this->input->post('id_suplier'), 
				'id_produk' => $this->input->post('id_produk'), 
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
				'total' => $this->input->post('total'),
				'pembayaran' => $this->input->post('pembayaran'),
				'created_by' => Account_Helper::get('id')
			];
			$cek = $this->db->get_where("produk", ['id' => $arr['id_produk']])->row_array();
            $this->db->insert("$this->low",$arr);
			$jumlah = $cek['stok'] + $arr['jumlah'];
			$this->db->update("produk", ['stok' => $jumlah], ['id' => $arr['id_produk']]);
            $this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
            redirect(base_url("$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("$this->low/add"));
			// $this->add();
		}
	}
		
	public function edit($id){
		$data['title'] = "Ubah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['type'] = 'Ubah';
		$data['produk'] = $this->db->get('produk')->result_array();
		$data['suplier'] = $this->db->get('suplier')->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Detail';
		$data['data'] = $this->db->query("SELECT p.nama as nama_produk,bm.total, bm.id_produk,s.nama as nama_suplier, bm.created_at, bm.jumlah, bm.id FROM $this->low bm JOIN produk p ON bm.id_produk=p.id JOIN suplier s ON bm.id_suplier=s.id WHERE bm.id_produk=$id")->result_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			$arr =
			[
				'id_suplier' => $this->input->post('id_suplier'), 
				'id_produk' => $this->input->post('id_produk'), 
				'jumlah' => $this->input->post('jumlah'),
				'keterangan' => $this->input->post('keterangan'),
			];
			$this->session->set_flashdata("message", ['success', "Ubah $this->cap Berhasil", ' Berhasil']);
			$this->db->update("$this->low",$arr, ['id' => $id]);
			redirect(base_url("$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Edit Data $this->cap", ' Gagal']);
			redirect(base_url("$this->low/edit/".$id));
			// $this->add();
		}
	}
		
	public function delete($id){
		try{
			$this->db->delete("$this->low", ['id' => $id]);
			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("$this->low/"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("$this->low/"));
		}
	}
}
