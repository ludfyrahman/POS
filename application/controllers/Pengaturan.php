<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengaturan extends CI_Controller {
	function __construct()
  	{
		parent::__construct();
		$this->low = "pengaturan";
		$this->cap = "Pengaturan";
		$this->load->helper("Response_helper");
		$this->load->helper("Input_helper");
		date_default_timezone_set('Asia/Jakarta');
		if($this->uri->segment(1) == "pengaturan" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->store($this->uri->segment(4));
		}else if($this->uri->segment(2) == "edit" && $_SERVER['REQUEST_METHOD'] == "POST"){
		  $this->update($this->uri->segment(3));
		}
    }
    public function index(){
		// $data['title'] = "Data $this->cap";
		// $data['content'] = "$this->low/index";
		// $data['data'] = $this->db->get("pengaturan")->result_array();
        // $this->load->view('backend/index',$data);
        $this->add();
    }
	
	public function add()
	{
		$data['title'] = " $this->cap";
		$data['content'] = "$this->low/_form";
		$data['data'] = null;
		$data['type'] = 'Update';
		$data['data'] = $this->db->get("$this->low")->row_array();
		$this->load->view('backend/index',$data);
		// Response_Helper::render('backend/index', $data);
	}

	public function store(){
		$d = $_POST;
		try{
			$arr =
			[
				'nama' => $this->input->post('nama'), 
				'deskripsi' => $this->input->post('deskripsi'), 
				'kurs' => $this->input->post('kurs'), 
			];
            $cek = $this->db->get("pengaturan")->num_rows();
            $config['upload_path']          = './assets/upload/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $new_name = random_string('alnum', 5);
            $config['file_name'] = $new_name;

            $this->upload->initialize($config);
            $upload_data = "";
            if($_FILES['logo']['name']!=''){
                if ( ! $this->upload->do_upload('logo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->session->set_flashdata("message", ['danger', $error['error'], ' Berhasil']);
                        // ketika simpan berhasil diarahkan ke halaman sesuai dengan nama controllernya
                        redirect(base_url("$this->low/"));
                }
                else
                {
                    $upload_data = $this->upload->data();
                    $arr['logo'] = $upload_data['file_name'];
                    
                }
            }
            if($cek > 0){
                // query simpan data ke database
                $this->db->update("$this->low",$arr);
                // pesan ketika simpan data
                $this->session->set_flashdata("message", ['success', "Berhasil Update $this->cap", ' Berhasil']);
                // ketika simpan berhasil diarahkan ke halaman sesuai dengan nama controllernya
                redirect(base_url("$this->low/"));                
            }else{
                // query simpan data ke database
                $this->db->insert("$this->low",$arr);
                // pesan ketika simpan data
                $this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
                // ketika simpan berhasil diarahkan ke halaman sesuai dengan nama controllernya
                redirect(base_url("$this->low/"));
            }
			// if($d['password'] != $d['password_konfirmasi']){
			// 	$this->session->set_flashdata("message", ['success', 'Password konfirmasi dengan password tidak sama', ' Berhasil']);
			// 	return $this->add();
			// }else{
			// 	$arr['password'] = md5($d['password']);
			// 	$this->db->insert("$this->low",$arr);
			// 	$this->session->set_flashdata("message", ['success', "Berhasil Tambah $this->cap", ' Berhasil']);
			// 	redirect(base_url("$this->low/"));
			// }
			
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
		$data['toko'] = $this->db->get("toko")->result_array();
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	public function detail($id){
		$data['title'] = "Detail $this->cap";
		$data['content'] = "$this->low/_detail";
		$data['type'] = 'Detail';
		$data['data'] = $this->db->get_where("$this->low", ['id' => $id])->row_array();		
		$this->load->view('backend/index',$data);
	}
	
	public function update($id){
		$d = $_POST;
		try{
			$arr =
			[
				'nama' => $this->input->post('nama'), 
				'username' => $this->input->post('username'), 
				'level' => $this->input->post('level'), 	
				'status' => $this->input->post('status'),
				'id_toko' => $this->input->post('id_toko')
			];
			if($d['password'] !=''){
				if($d['password'] != $d['password_konfirmasi']){
					$this->session->set_flashdata("message", ['danger', 'Password konfirmasi dengan password tidak sama', ' Berhasil']);
					redirect(base_url("$this->low/edit/".$id));
				}else{
					$arr['password'] = md5($d['password']);
				}
			}
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
