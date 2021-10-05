<?php
class Site extends CI_Controller { //mengextends CI_Controller 
    public function __construct(){
        parent::__construct();
    }
    public function index () {
        
        $data['title'] = "Login";
        $data['content'] = "login/index";
		$this->load->view('frontend/index',$data);
    }
    public function doLogin(){
        $d = $_POST;
        if(!$d){
            redirect(base_url(""));
        }
        try {
            if($d){
                $a = $this->db->get_where("pengguna", ['username' => $d['username']])->result_array();
                // print_r($a);
                // echo count($a);
                // $a = $this->akun->Select('*', "WHERE email = '$d[email]'")[1];

                if(count($a) < 1) {
                    $this->session->set_flashdata("message", ['danger', 'Login gagal, silahkan cek username anda kembali', ' Gagal']);
                    return $this->index();
                }

                $a = $a[0];
                if($a['status'] == 0) {
                    $this->session->set_flashdata("message", ['danger', 'Login gagal, Akun anda sedang dinonaktifkan', ' Gagal']);
                    return $this->index();
                }
                if(md5($d['password']) != $a['password']) {
                    $this->session->set_flashdata("message", ['danger', 'Login gagal, Password anda salah', ' Gagal']);
                    return $this->index();
                }

                $_SESSION['userid'] = $a['id'];
                $_SESSION['userlevel'] = $a['level'];
                redirect(base_url("dashboard"));
            }
        }
        catch(Exception $e) {
            // $this->login();
            echo "gagal";
        }
    }
    public function logout(){
        // session_unset("userid");
        // session_unset("userlevel");
        session_destroy();
        redirect(base_url());
    }
    public function cek($id_produk){
        $cek = $this->db->get_where("produk", ['id' => $id_produk])->row_array();
        echo json_encode($cek);
    }
}
?>