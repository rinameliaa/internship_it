<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        if($this->session->userdata(nama_sesi)){
            $token = $this->session->userdata(nama_sesi);
            $decrypttoken = $this->encryption->decrypt(base64_decode($token));
            $x = explode("|", $decrypttoken);
            $u = $x[0];
            $p = $x[1];
            $hasil = $this->Mlogin->ceklogin($u, $p);
            if(is_array($hasil)){
                if(count($hasil)>0){
					redirect(base_url("Home"));
                }
            }
        }
    }
	public function index(){
		$this->load->view("masuk");
	}
	public function ceklogin(){
		$username = $this->input->post("userx");
		$pass = $this->input->post("passx");
		$passe = enkripsi($pass); //dienkripsi atau dicocokkan dgn enkripsi database
		$hasil = $this->Mlogin->ceklogin($username, $passe); //variabel yang menampung hasil dari ceklogin
		if(is_array($hasil)){
			if(count($hasil)>0){
                foreach($hasil as $y){
                    $nama = $y->nama;
                }
                $token = base64_encode($this->encryption->encrypt($username."|".$passe));
                $this->session->set_userdata(nama_sesi, $token);
                echo base64_encode("1|$nama");
			}else{
				echo base64_encode("0|Akun Tidak ditemukan");
			}
		}else{
			echo base64_encode("0|Akun Tidak ditemukan");
		}
	}

}
