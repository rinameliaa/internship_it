<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    public $namauser;
    public $haktambah;
    public $hakupdate;
    public $hakhapus;
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
                    foreach($hasil as $x){
                        $this->namauser = $x->nama;
                        $this->haktambah = $x->akses_tambah;
                        $this->hakupdate = $x->akses_update;
                        $this->hakhapus = $x->akses_hapus;
					}
                }else{
                    redirect(base_url('Login'));
                }
            }else{
                redirect(base_url('Login'));
            }
        }else{
            redirect(base_url('Login'));
        }
    }
	public function index(){
        $xyz["konten"] = "beranda";
        $z["nama"] = $this->namauser;
        $z["hakakses"] = [$this->haktambah, $this->hakupdate, $this->hakhapus];
        $this->load->view("beranda", $z, true);
        $this->load->view("home", $xyz);
	}

    public function karyawan(){
        $xyz["konten"] = "karyawan";
        $xyz["dtpendidikan"] = $this->Mkaryawan->pendidikan();
        $xyz["dtdepartemen"] = $this->Mkaryawan->departemen();
        $xyz["dtlevel"] = $this->Mkaryawan->level();
        $xyz["hakakses"] = [$this->haktambah, $this->hakupdate, $this->hakhapus];
        $this->load->view("home", $xyz);
    }
    public function  karyawan_tampil(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->Mkaryawan->data();
        foreach ($dt as $k){
            $id = $k->id_karyawan;
            $nik = $k->nik;
            $nama = $k->nama;
            $tempat = $k->tempat_lahir;
            $tanggal = $k->tanggal_lahir;
            $pendidikan = $k->nama_pendidikan;
            $departemen = $k->nama_departemen;
            $ttl = $tempat.", ".$tanggal;
            $tombol = "Hak Di Batasi";
            if($this->hakupdate == "1"){
                $tombol = "<button type='button' class='btn btn-primary' data-id='".$id."' onclick='update(this)'>Edit</button>";
            }
            if($this->hakhapus == "1"){
                $tombol .= " <button type='button' class='btn btn-danger' data-id='".$id."'onclick='hapus(this)'>Hapus</button>";
            }
            $dtisi .= '["'.$tombol.'","'.$id.'","'.$nik.'","'.$nama.'","'.$ttl.'","'.$pendidikan.'","'.$departemen.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    public function karyawan_tambah(){
        $id = strtotime(date("Y-m-d H:i:s"));
        $nik = $this->input->post("nik");
        $nama = $this->input->post("nama");
        $tempat = $this->input->post("tempat_lahir");
        $tanggal = $this->input->post("tanggal_lahir");
        $pendidikan = $this->input->post("id_pendidikan");
        $departemen = $this->input->post("id_departemen");
        $level = $this->input->post("id_level_grade");
        $status = $this->input->post("status");
        $username = $this->input->post("username");
        $password = enkripsi("123456");
        $hasil = $this->Mkaryawan->tambah($id, $nik, $nama, $tempat, $tanggal, $pendidikan, $departemen, $level, $status, $username, $password);
        if($hasil== "1"){    
            echo base64_encode("1|Tambah Akun Berhasil, Default Password:123456");
        }else{
            echo base64_encode("0|Tambah Akun Gagal, Silahkan Cek Datannya");
        }
    }
    public function update(){
        $nik = $this->input->post("nik");
        $nama = $this->input->post("nama");
        $tempat = $this->input->post("tempat_lahir");
        $tanggal = $this->input->post("tanggal_lahir");
        $pendidikan = $this->input->post("id_pendidikan");
        $departemen = $this->input->post("id_departemen");
        $level = $this->input->post("id_level_grade");
        $status = $this->input->post("status");
        $username = $this->input->post("username");
        $password = enkripsi("123456");
        $hasil = $this->Mkaryawan->update($id, $nik, $nama, $tempat, $tanggal, $pendidikan, $departemen, $level, $status, $username, $password);
        if($hasil== "1"){    
            echo base64_encode("1|Update Akun Berhasil");
        }else{
            echo base64_encode("0|Update Akun Gagal, Silahkan Cek Datannya");
        }
    }
    public function hapus (){
        $id = $this->input->post("id");
        $hasil = $this->Mkaryawan->hapus($id);
        if($hasil== "1"){    
            echo base64_encode("1|Hapus Akun Berhasil");
        }else{
            echo base64_encode("0|Hapus Akun Gagal, Silahkan Cek Datannya");
        }
    }
}