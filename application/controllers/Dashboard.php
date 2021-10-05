<?php
class Dashboard extends CI_Controller
{ //mengextends CI_Controller
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {

        $data['title'] = "Dashboard";
        $now = date("Y-m-d");
        $data['barang_masuk'] = $this->db->get("barang_masuk")->result_array();
        $data['barang_keluar'] = $this->db->get("barang_keluar")->result_array();
        $data['pengguna'] = $this->db->get("pengguna")->result_array();
        $data['produk'] = $this->db->get("produk")->result_array();
        $data['content'] = "dashboard/index";
        $this->load->view('backend/index', $data);

    }
    public function test()
    {
        if ($var == '') {
            $var == 'testing';
        }
        return $var;
    }
}
