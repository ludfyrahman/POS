<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Toko extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		$this->low = "toko";
		$this->cap = "Toko";
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
		$data['data'] = $this->db->get("$this->low")->result_array();
        $this->load->view('backend/index',$data);
    }
	
	public function add()
	{
		$data['title'] = "Tambah $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['type'] = 'Tambah';
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}

	public function store(){
		$d = $_POST;
		try{
			$arr =
			[
				'nama' => $this->input->post('nama'), 
				'alamat' => $this->input->post('alamat'), 
				'no_telp' => $this->input->post('no_telp'),
				'tipe' => $this->input->post('tipe'),
			];
            $this->db->insert("$this->low",$arr);
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
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Detail';
		$data['produk'] = $this->db->query("SELECT p.nama, st.* FROM produk p JOIN stok_toko st ON st.id_produk=p.id WHERE st.id_toko='$id'")->result_array();
		// $data['penjualan'] = $this->db->query("SELECT p.nama, t.total_transaksi, dt.*, t.tanggal_transaksi FROM transaksi t JOIN detail_transaksi dt ON t.id=dt.id_transaksi LEFT JOIN produk p ON dt.id_produk=p.id WHERE t.id_toko='$id'")->result_array();
		$data['penjualan'] = $this->db->query("SELECT t.*, p.nama as pelanggan FROM transaksi t LEFT JOIN pelanggan p ON t.id_pelanggan=p.id where id_toko=$id")->result_array();
		$data['karyawan'] = $this->db->query("SELECT *, SUM(total_transaksi) total FROM pengguna p JOIN transaksi t ON p.id=t.id_pengguna where t.id_toko=$id GROUP BY t.id_pengguna")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$data['produkAll'] = $this->db->get("produk")->result_array();
		$this->load->view('backend/index',$data);
	}
	public function storeStok($id){
		$d = $_POST;
		try{
			$id_produk = $this->input->post('id_produk');
			$jumlah = $this->input->post('jumlah');
			$produk = $this->db->get_where("produk", ['id' => $id_produk])->row_array();
			$toko = $this->db->get_where("stok_toko", ['id_produk' => $id_produk, 'id_toko' => $id])->num_rows();
			if($toko > 0){
				if($produk['stok'] < $jumlah){
					$this->session->set_flashdata("message", ['warning', "Jumlah yang anda inputkan melebihi stok", ' Berhasil']);
					redirect(base_url("$this->low/detail/".$id));
				}else{
					$arr =
					[
						'id_produk' => $id_produk, 
						'jumlah' => $jumlah,
					];
					$cek = $this->db->get_where("produk", ['id' => $arr['id_produk']])->row_array();
					$cekToko = $this->db->get_where("stok_toko", ['id_produk' => $arr['id_produk'], 'id_toko' => $id])->row_array();
					$this->db->update('stok_toko', ['jumlah' => $jumlah + $cekToko['jumlah']], ['id_produk' => $id_produk]);
					$jumlah = $cek['stok'] - $arr['jumlah'];
					$this->db->update("produk", ['stok' => $jumlah], ['id' => $arr['id_produk']]);
					$this->session->set_flashdata("message", ['success', "Berhasil Tambah Stok", ' Berhasil']);
					redirect(base_url("$this->low/detail/".$id));
				}
			}else{
				$this->db->insert("stok_toko", ['id_produk' => $id_produk, 'id_toko' =>$id, 'jumlah' => $jumlah, 'created_by' => Account_Helper::get('id')]);
				$this->session->set_flashdata("message", ['success', "Berhasil Tambah Produk Toko", ' Berhasil']);
					redirect(base_url("$this->low/detail/".$id));
			}
			
			
			
		}catch(Exception $e){
			$this->session->set_flashdata("message", ['danger', "Gagal Tambah Data $this->cap", ' Gagal']);
			redirect(base_url("$this->low/add"));
			// $this->add();
		}
	}
	public function update($id){
		$d = $_POST;
		try{
			$arr =
			[
				'nama' => $this->input->post('nama'), 
				'alamat' => $this->input->post('alamat'), 
				'no_telp' => $this->input->post('no_telp'),
				'tipe' => $this->input->post('tipe'),
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
