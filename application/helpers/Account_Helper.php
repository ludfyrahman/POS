<?php
class Account_Helper {
    public static function Get($index) {
        $ci = get_instance();
		$d = $ci->db->get_where("pengguna", ['id' => $_SESSION['userid']])->row_array();
		// $d = $ci->db->get_where("pengguna", ['id' => $_SESSION['userid']])->row_array();

        return $d[$index];
    }
    public static function kurs($index){
        $ci = get_instance();
		$d = $ci->db->get_where("pengaturan")->row_array();
		// $d = $ci->db->get_where("pengguna", ['id' => $_SESSION['userid']])->row_array();

        return $d[$index];
    }
    public static function getTipe(){
        $ci = get_instance();
		$d = $ci->db->get_where("pengguna", ['id' => $_SESSION['userid']])->row_array();
        $toko = $ci->db->get_where("toko", ['id' => $d['id_toko']])->row_array();
        return isset($toko['tipe']) ? $toko['tipe'] : 0;
    }
}