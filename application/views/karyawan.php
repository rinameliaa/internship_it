<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <div class="card-title">Data Karyawan</div>
            <br/>
            <div class="card-tools">
                <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#modaltambah">Tambah Data</button>&nbsp
                <button type="button" class="btn btn-danger" style="margin-bottom: 20px;">Refresh Data</button>
            </div>
        <div class="col-md-12">
        <div class="card">
        <div class="card-body">
            <div class="table-responsive">
            <table id="tblx" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%">Kelola</th>
                        <th style="width: 10%">ID</th>
                        <th style="width: 20%">Nik</th>
                        <th style="width: 25%">Nama</th>
                        <th style="width: 10%">TTL</th>
                        <th style="width: 10%">Pendidikan</th>
                        <th style="width: 20%">Departemen</th>
                    </tr>
                </thead>
            </table>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modaltambah">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Karyawan</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>ID Karyawan</label>
                            <input type="numeric" class="form-control ftambah" id="txtid" readonly placeholder="Otomatis By Sistem">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nik</label>
                            <input type="text" maxlength="16" class="form-control ftambah" id="txtnik">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text" class="form-control ftambah" id="txtnama">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control ftambah" id="txttempat">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control ftambah" id="txtlahir">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pendidikan</label>
                            <select class="form-control ftambah" id="cbopend">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtpendidikan)){
                                        if(count($dtpendidikan)>0){
                                            foreach($dtpendidikan as $k){
                                                $id = $k->id_pendidikan;
                                                $nama = $k->nama_pendidikan;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Departemen</label>
                            <select class="form-control ftambah" id="cbodepar">
                            <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtdepartemen)){
                                        if(count($dtdepartemen)>0){
                                            foreach($dtdepartemen as $k){
                                                $id = $k->id_departemen;
                                                $nama = $k->nama_departemen;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Level</label>
                            <select class="form-control ftambah" id="cbolevel">
                            <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtlevel)){
                                        if(count($dtlevel)>0){
                                            foreach($dtlevel as $k){
                                                $id = $k->id_level_grade;
                                                $nama = $k->nama_level;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select class="form-control ftambah" id="cbostatus">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>      
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control ftambah" id="txtusername">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control ftambah" id="txtpassword1">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control ftambah" id="txtpassword2">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="simpan()">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="hapus()">Reset</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="modalupdate">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Data Karyawan</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>ID Karyawan</label>
                            <input type="numeric" class="form-control ftambah" id="txtide" readonly placeholder="Otomatis By Sistem">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nik</label>
                            <input type="text" maxlength="16" class="form-control ftambah" id="txtnike">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text" class="form-control ftambah" id="txtnamae">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control ftambah" id="txttempate">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control ftambah" id="txtlahire">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pendidikan</label>
                            <select class="form-control ftambah" id="cbopende">
                                <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtpendidikan)){
                                        if(count($dtpendidikan)>0){
                                            foreach($dtpendidikan as $k){
                                                $id = $k->id_pendidikan;
                                                $nama = $k->nama_pendidikan;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Departemen</label>
                            <select class="form-control ftambah" id="cbodepare">
                            <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtdepartemen)){
                                        if(count($dtdepartemen)>0){
                                            foreach($dtdepartemen as $k){
                                                $id = $k->id_departemen;
                                                $nama = $k->nama_departemen;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Level</label>
                            <select class="form-control ftambah" id="cbolevele">
                            <option value="">Pilih Salah Satu</option>
                                <?php
                                    if(is_array($dtlevel)){
                                        if(count($dtlevel)>0){
                                            foreach($dtlevel as $k){
                                                $id = $k->id_level_grade;
                                                $nama = $k->nama_level;
                                                echo "<option value='$id'>$nama</option>";
                                            }
                                        }
                                    }
                                ?>
                            </select>    
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select class="form-control ftambah" id="cbojenise">
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>      
                        </div>
                        <div class="form-group col-md-6">
                            <label>Username</label>
                            <input type="text" class="form-control ftambah" id="txtusernamee">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" class="form-control ftambah" id="txtpassword1e">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Konfirmasi Password</label>
                            <input type="password" class="form-control ftambah" id="txtpassword2e">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="update()">Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="batal()">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>  
    let tblx = $('#tblx').DataTable(
        {
            "ajax": "<?=base_url('Home/karyawan_tampil');?>"
        }
    );

    function simpan(){
        let nik = $("#txtnik").val();
        let nama = $("#txtnama").val();
        let tempat = $("#txttempat").val();
        let tanggal = $("#txtlahir").val();
        let pendidikan = $("#cbopend").val();
        let departemen = $("#cbodepar").val();
        let level = $("#cbolevel").val();
        let status = $("#cbostatus").val();
        let username = $("#txtusername").val();
        let password = $("#txtpassword2").val();
        if(nik == "" || nama == "" || tempat == "" || tanggal == "" || pendidikan == "" || departemen == "" || level == "" || status == "" || username == ""|| password == ""){
            swal({title:"Gagal", text:"Ada Isian Yang Kosong", icon: "error"});
            return;
        }
        $.ajax({
            url: "<?= base_url(); ?>" + "Home/karyawan_tambah",
            method: "POST",
            data: {nik:nik, nama:nama, tempat:tempat, tanggal:tanggal, pendidikan:pendidikan, departemen:departemen, level:level, status:status, username:username, password:password},
            cache: "false",
            success: function(x){
                let hasil = atob(x); //sama fungsinya kayak decode pada php
                let param = hasil.split("|");
                if(param[0] == "1"){
                    swal({title:"Berhasil", text: param[1], icon: "success"});
                    $(".ftambah").val("");
                    $("#cbojenis").val("Home");
                    $("#cbostatus").val("1")
                    tblx.ajax.reload();
                }else{
                    swal({title:"Gagal", text: param[1], icon: "error"});
                }
            },
            error: function(){
                swal({title:"Gagal", text:"Tidak Terhubung dengan Server", icon: "error"});
            }
        })
    }
    function update(el){
        let id = $("#txtide").val();
        let nik = $("#txtnike").val();
        let nama = $("#txtnamae").val();
        let tempat = $("#txttempate").val();
        let tanggal = $("#txtlahire").val();
        let pendidikan = $("#cbopende").val();
        let departemen = $("#cbodepare").val();
        let level = $("#cbolevele").val();
        let status = $("#cbostatuse").val();
        let username = $("#txtusernamee").val();
        let password = $("#txtpassword2e").val();
        if(nik == "" || nama == "" || tempat == "" || tanggal == "" || pendidikan == "" || departemen == "" || level == "" || status == "" || username == ""|| password == ""){
            swal({title:"Gagal", text:"Ada Isian Yang Kosong", icon: "error"});
            return;
        }
        $.ajax({
            url: "<?= base_url(); ?>" + "Home/karyawan_update",
            method: "POST",
            data: {nik:nik, nama:nama, tempat:tempat, tanggal:tanggal, pendidikan:pendidikan, departemen:departemen, level:level, status:status, username:username, password:password},
            cache: "false",
            success: function(x){
                let hasil = atob(x); //sama fungsinya kayak decode pada php
                let param = hasil.split("|");
                if(param[0] == "1"){
                    swal({title:"Berhasil", text: param[1], icon: "success"});
                    $(".ftambah").val("");
                    $("#cbojenis").val("Home");
                    $("#cbostatus").val("1");
                    $("#modalupdate").modal(hide);
                    tblx.ajax.reload();
                }else{
                    swal({title:"Gagal", text: param[1], icon: "error"});
                }
            },
            error: function(){
                swal({title:"Gagal", text:"Tidak Terhubung dengan Server", icon: "error"});
            }
        })
    }
            function hapus(){
                let id = $("#txtide").val();
                if(id == ""){
                    swal({title:"Gagal",text:"Akun Tidak Terhubung dengan Server", icon: "error"});
                }
            swal({
                title: 'Konfirmasi',
                text: "Anda Yakin Ingin Menghapus?",
                icon: 'warning',
                buttons: {
                    confirm: {text: 'Yakin', className: 'btn btn-primary'},
                    cancel: {visible: true, text: 'Tidak', className: 'btn btn-danger'}
                }
            }).then((hapus) => {
                if(hapus){
                    $.ajax({
                    url: "<?= base_url(); ?>" + "Administrator/akun_hapus",
                    method: "POST",
                    data: {id:id},
                    cache: "false",
                    success: function(x){
                        var hasil = atob(x);
                        var param= hasil.split("|");
                        if(param[0] == "1"){
                            swal({title: "Berhasil", text: param[1], icon: "success"});
                            $("#modalupdate").modal("hide");
                            tblakn.ajax.reload();
                        }else{
                            swal({title: "Gagal", text: param[1], icon: "error"});
                        }
                    },
                    error: function(){
                        swal({title: "Gagal", text: "Koneksi API Gagal", icon: "error"});
                    }
                })
            }
        })
    }
</script>
