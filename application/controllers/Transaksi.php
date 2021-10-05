<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		$this->low = "transaksi";
		$this->cap = "Transaksi";
		$this->load->helper("Response_helper");
		$this->load->helper("Input_helper");
		date_default_timezone_set('Asia/Jakarta');
		// if(!isset($_SESSION['kode_user'])){
		// 	redirect(base_url());
		// }
    }
    public function index(){
		$data['title'] = "Data $this->cap";
		$data['content'] = "$this->low/index";
		$where = "";
		if($_SESSION['userlevel'] == 2){
			$where = "WHERE  pg.id = ".Account_Helper::get('id');
		}
		$data['data'] = $this->db->query("SELECT t.tanggal_transaksi as waktu_transaksi, t.pembayaran, nama, total_transaksi, t.id FROM `transaksi` t JOIN pengguna pg ON t.id_pengguna=pg.id $where ORDER BY t.id desc")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['type'] = 'Tambah';
		$id_toko = Account_Helper::get('id_toko');
		$data['order'] = $this->db->query("SELECT p.nama as nama_produk,dt.id, dt.jumlah, p.harga,dt.subtotal FROM detail_transaksi dt JOIN produk p ON dt.id_produk=p.id where id_transaksi=".Account_Helper::get('id'))->result_array();
		$data['produk'] = $this->db->query("SELECT p.* FROM produk p JOIN stok_toko st ON p.id=st.id_produk where st.id_toko='$id_toko'")->result_array();
		$data['suplier'] = $this->db->get('suplier')->result_array();
		$data['pelanggan'] = $this->db->get("pelanggan")->result_array();
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}
	public function total(){
		$id = Account_Helper::get('id');
		$data = $this->db->query("SELECT SUM(subtotal) total from detail_transaksi where id_transaksi = '$id'")->row_array();
		echo json_encode($data);
	}
	public function store(){
		$d = $_POST;
		try{
			$arr =
			[
				'total_transaksi' => $this->input->post('total_transaksi'), 
				'id_pengguna' => Account_Helper::get('id'),
				'id_pelanggan' =>  $this->input->post('id_pelanggan'), 
				'id_toko' => Account_Helper::get('id_toko'),
				'pembayaran' =>$this->input->post('pembayaran'),
				'bayar' =>$this->input->post('bayar'),
				'kembalian' =>$this->input->post('kembalian'),
			];
			// $cek = $this->db->get_where("produk", ['id' => $arr['id_produk']])->row_array();
			$this->db->insert("$this->low",$arr);
			$id= $this->db->insert_id();
			$cek = $this->db->get_where("detail_transaksi",  ['id_transaksi' => Account_Helper::get('id')])->num_rows();
			if($cek < 1){
				$this->session->set_flashdata("message", ['warning', "Harap form di isi terlebih dahulu", ' Berhasil']);
				redirect(base_url("$this->low/add"));
			}else{
				$this->db->update("detail_transaksi", ['id_transaksi' => $id], ['id_transaksi' => Account_Helper::get('id')]);
				// $jumlah = $cek['stok'] + $arr['jumlah'];
				// $this->db->update("produk", ['stok' => $jumlah], ['id' => $arr['id_produk']]);
				$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
				redirect(base_url("$this->low/"));
			}
			
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("$this->low/add"));
			// $this->add();
		}
	}
	public function tambah_detail()
	{
		$d = $_POST;
		try{
			$id = $_POST['id_produk'];
			$produk = $this->db->get_where("produk", ['id'=> $id])->row_array();
			$harga = $produk['harga'];
			$jenis = (isset($d['jenis']) ? $d['jenis'] :2);
			$jumlah = $this->input->post('jumlah');
			$subtotal = 0;
			if($jenis == 1){
				$tipe = $d['tipe'];
				if($tipe == '100gr'){
					$jumlah = '100';
					$harga = $produk['100gr'];
					$subtotal = $harga* Account_Helper::kurs('kurs');
				}else if($tipe == '500gr'){
					$jumlah = '500';
					$harga = $produk['500gr'];
					$subtotal = $harga* Account_Helper::kurs('kurs');
				}else if($tipe == 'kg'){
					$jumlah = '1000';
					$harga = $produk['kg'];
					$subtotal = $harga* Account_Helper::kurs('kurs');
				}
			}else{
				$subtotal = ($produk['harga'] * Account_Helper::kurs('kurs')) * $jumlah;
			}
			$arr =
			[
				'id_transaksi' => Account_Helper::get('id'), 
				'id_produk' => $this->input->post('id_produk'), 
				'jumlah' => $jumlah,
				'harga' => $harga * Account_Helper::kurs('kurs'),
				'tipe' => $jenis,
				'subtotal' => $subtotal
			];
			// $arr['subtotal'] = ($produk['harga'] * Account_Helper::kurs('kurs')) * $arr['jumlah'];
			// $arr_keluar =
			// [
			// 	'created_by' => Account_Helper::get('id'), 
			// 	'id_produk' => $this->input->post('id_produk'), 
			// 	'jumlah' => $this->input->post('jumlah'),
			// ];
			$cek = $this->db->get_where("detail_transaksi", ['id_produk' => $id, 'id_transaksi' => Account_Helper::get('id')]);
			$cek_lagi = $this->db->get_where("stok_toko", ['id_produk' => $arr['id_produk'], 'id_toko' => Account_Helper::get('id_toko')])->row_array();
			if($cek_lagi['jumlah'] < $arr['jumlah']){
				$this->session->set_flashdata("message", ['danger', "Pembelian Melebihi Stok", ' Berhasil']);
				redirect(base_url("$this->low/add"));
			}
			// if($cek_lagi['jumlah'] < 5){
			// 	$this->session->set_flashdata("message", ['danger', "Stok Sedikit, menunggu pemasokan", ' Berhasil']);
			// 	redirect(base_url("$this->low/add"));
			// }
			if($cek->num_rows() > 0){
				$res = $cek->row_array();
				$jumlah = $res['jumlah'] + $arr['jumlah'];
				$this->db->update("detail_transaksi", ['jumlah' => $jumlah], ['id_produk' => $id, 'id_transaksi' => Account_Helper::get('id')]);
			}else{
				// $produk = $this->db->get_where("produk", ['id' =>$id])->row_array();
				$this->db->insert("detail_transaksi",$arr);
				// $this->db->insert("barang_keluar",$arr_keluar);
				
			}
			
			$jumlah = $cek_lagi['jumlah'] - $arr['jumlah'];
			$this->db->update("stok_toko", ['jumlah' => $jumlah], ['id_produk' => $arr['id_produk']]);
			$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			redirect(base_url("$this->low/add"));
			
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
		$data['transaksi'] = $id;
		$data['detail'] = $this->db->query("SELECT p.nama as kasir, t.*, pl.nama as pelanggan, tk.nama as toko, tk.alamat FROM transaksi t LEFT JOIN pengguna p ON t.id_pengguna=p.id LEFT JOIN toko tk ON t.id_toko=tk.id LEFT JOIN pelanggan pl ON t.id_pelanggan=pl.id WHERE t.id='$id'")->row_array();
		$data['data'] = $this->db->query("SELECT p.nama as nama_produk,dt.id, dt.jumlah, p.harga, dt.subtotal FROM detail_transaksi dt JOIN produk p ON dt.id_produk=p.id where id_transaksi=".$id)->result_array();		
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
			$data =$this->db->get_where("detail_transaksi", ['id' => $id])->row_array();
			$this->db->update("stok_toko", ['jumlah' => $data['jumlah']], ['id_toko' => $data['id_toko'], 'id_produk'=>$data['id_produk']]);
			$this->db->delete("detail_transaksi", ['id' => $id]);

			$this->session->set_flashdata("message", ['success', "Berhasil Hapus Data $this->cap", 'Berhasil']);
			redirect(base_url("$this->low/add"));
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Hapus Data $this->cap", 'Gagal']);
			redirect(base_url("$this->low/add"));
		}
	}
}
