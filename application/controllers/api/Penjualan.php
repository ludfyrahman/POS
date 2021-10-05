<?php
class Penjualan extends CI_Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function getByCode($kode){
        $toko = $this->db->get("pengaturan")->row_array();
        $transaksi = $this->db->query("SELECT t.*, tk.nama as toko, tk.alamat, tk.no_telp, p.nama as kasir FROM transaksi t LEFT JOIN pengguna p ON t.id_pengguna=p.id JOIN toko tk ON t.id_toko=tk.id where t.id='$kode'")->row_array();
        $detail_transaksi = $this->db->query("SELECT dt.*, p.nama as produk FROM detail_transaksi dt JOIN produk p ON dt.id_produk=p.id where dt.id_transaksi='$kode'")->result_array();
        echo json_encode(['transaksi' => $transaksi, 'detail_transaksi' => $detail_transaksi, 'toko' => $toko]);
    }
}
