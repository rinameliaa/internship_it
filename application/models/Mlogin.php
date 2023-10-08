<?php
defined('BASEPATH') OR exit ('No direct script access allowed');
class Mlogin extends CI_Model {
        public function ceklogin($userx, $passe){
                $sql = "SELECT a.*, b.akses_tambah, b.akses_update, b.akses_hapus FROM karyawan AS a JOIN level_grade as b ON a.id_level_grade = b.id_level_grade WHERE a.username = '$userx' AND a.password = '$passe' AND a.status = '1'";
                $data = $this->db->query($sql);
                if($data){
                        return $data->result();
                }else{
                        return 0;
                }
        }
}
 