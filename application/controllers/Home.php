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
    public function karyawan_tampil(){
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
            $tombol = "";
            if($this->hakupdate == "1"){
                $tombol .= "<button type='button' class='btn btn-primary' data-id='".$id."' onclick='filter(this)'>Edit</button>";
            }
            if($this->hakhapus == "1"){
                $tombol .= " <button type='button' class='btn btn-danger' data-id='".$id."'onclick='hapus(this)'>Hapus</button>";
            }
            if($tombol == ""){
                $tombol = "Hak Di Batasi";
            }
            $dtisi .= '["'.$tombol.'","'.$id.'","'.$nik.'","'.$nama.'","'.$ttl.'","'.$pendidikan.'","'.$departemen.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }
    public function karyawan_tambah(){
        if($this->haktambah == "1"){
            $id = strtotime(date("Y-m-d H:i:s"));
            $nik = trim(str_replace("'","''",$this->input->post("nik")));
            $nama = trim(str_replace("'","''",$this->input->post("nama")));
            $tempat = trim(str_replace("'","''",$this->input->post("tempat")));
            $tanggal = trim(str_replace("'","''",$this->input->post("tanggal")));
            $pendidikan = trim(str_replace("'","''",$this->input->post("pendidikan")));
            $departemen = trim(str_replace("'","''",$this->input->post("departemen")));
            $level = trim(str_replace("'","''",$this->input->post("level")));
            $status = trim(str_replace("'","''",$this->input->post("status")));
            $username = trim(str_replace("'","''",$this->input->post("username")));
            $password = trim(str_replace("'","''",$this->input->post("password")));
            $hasil = $this->Mkaryawan->tambah($id, $nik, $nama, $tempat, $tanggal, $pendidikan, $departemen, $level, $status, $username, enkripsi($password));
            if($hasil == "1"){    
                echo base64_encode("1|Tambah Akun Berhasil,");
            }else{
                echo base64_encode("0|Tambah Akun Gagal, Silahkan Cek Datannya");
            }
        }else{
            echo base64_encode("0|Anda Tidak Memiliki Hak Untuk Menambah Data");
        }
    }

    public function karyawan_filter(){
        $id = $this->input->post("id");
         $hasil = $this->Mkaryawan->filter($id);
         if(is_array($hasil)){
            if(count($hasil)>0){
                foreach($hasil as $k){
                    $id = $k->id_karyawan;
                    $nik = $k->nik;
                    $nama = $k->nama;
                    $tempat = $k->tempat_lahir;
                    $tanggal = $k->tanggal_lahir;
                    $pendidikan = $k->id_pendidikan;
                    $departemen = $k->id_departemen;
                    $level = $k->id_level_grade;
                    $status = $k->status;
                }
                 echo base64_encode("1|$id|$nik|$nama|$tempat|$tanggal|$pendidikan|$departemen|$level|$status");

            }else{
                echo base64_encode("0|Data Karyawan Tidak Ditemukan");
            }
        }else{
            echo base64_encode("0|Data Karyawan Tidak Ditemukan");
         }
    }
    public function karyawan_update(){
        if($this->hakupdate == "1"){
            $id = trim(str_replace("'","''",$this->input->post("id")));
            $nik = trim(str_replace("'","''",$this->input->post("nik")));
            $nama = trim(str_replace("'","''",$this->input->post("nama")));
            $tempat = trim(str_replace("'","''",$this->input->post("tempat")));
            $tanggal = trim(str_replace("'","''",$this->input->post("tanggal")));
            $pendidikan = trim(str_replace("'","''",$this->input->post("pendidikan")));
            $departemen = trim(str_replace("'","''",$this->input->post("departemen")));
            $level = trim(str_replace("'","''",$this->input->post("level")));
            $status = trim(str_replace("'","''",$this->input->post("status")));
            $hasil = $this->Mkaryawan->update($id, $nik, $nama, $tempat, $tanggal, $pendidikan, $departemen, $level, $status);
            if($hasil== "1"){    
                echo base64_encode("1|Update Data Karyawan Berhasil");
            }else{
                echo base64_encode("0|Update Data Karyawan Gagal, Silahkan Cek Datannya");
            }
        }else{
            echo base64_encode("0|Anda Tidak Memiliki Hak Untuk Update Data");
        }
    }
    public function karyawan_hapus (){
        if($this->hakhapus == "1"){
            $id = $this->input->post("id");
            $hasil = $this->Mkaryawan->hapus($id);
            if($hasil== "1"){    
                echo base64_encode("1|Hapus Data Karyawan Berhasil");
            }else{
                echo base64_encode("0|Hapus Data Karyawan Gagal, Silahkan Cek Datannya");
            }
        }else{
            echo base64_encode("0|Anda Tidak Memiliki Hak Untuk Hapus Data");
        }
    }
}