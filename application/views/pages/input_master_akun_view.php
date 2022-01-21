<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POK - Master Akun</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Advanced Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-7">
                <div class="card card-default">
                  <div class="card-body">
                    <table id="table_master_pok_akun" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Akun</th>
                          <th>Uraian</th>
                          <th>Jumlah</th>
                          <th>Sumber</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
              <div class="col-md-5">
                <div class="card card-default">
                  <div class="card-header">
                    <h4>Input Master Akun dalam POK</h4>
                  </div>
                  <div class="card-body">
                    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan">
                    <input type="hidden" name="kode_kro" id="kode_kro">
                    <input type="hidden" name="kode_ro" id="kode_ro">
                    <input type="hidden" name="kode_komponen" id="kode_komponen">
                    <input type="hidden" name="kode_subkomponen" id="kode_subkomponen">
                      <div class="form-group">
                        <label>Kode SubKomponen</label>
                        <select class="form-control" name="id_subkomponen" id="id_subkomponen" onchange="getSubkomponen()">
                          <?php foreach($subkomponens as $subkomponen):?>
                            <option value="<?=$subkomponen['id']?>"><?=$subkomponen['kegiatan']?>-<?=$subkomponen['kro']?>-<?=$subkomponen['ro']?>-<?=$subkomponen['komponen']?>-<?=$subkomponen['subkomponen']?> - <?=$subkomponen['uraian']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Akun</label>
                              <select class="form-control" name="kode_akun"  id="kode_akun" onchange="updateUraianAkun()">
                                <?php foreach($bagan_akun_standar as $bas):?>
                                  <option value="<?=$bas['kode']?>"><?=$bas['kode']?></option>
                                <?php endforeach;?>
                              </select>
                            </div>
                        </div>
                        <div class="col-md-8">
                          <div class="form-group">
                            <label>Uraian</label>
                            <input type="text" class="form-control"   name="uraian_akun" id="uraian_akun" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control"   name="pagu_akun" id="pagu_akun">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Sumber</label>
                            <select class="form-control" name="sumber" id="sumber">
                              <option value="rm">RM</option>
                              <option value="pnp">PNP</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      
                      <button type="button" class="btn btn-primary" onclick="simpanDataAkun()">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
            

          </div>
        </div>
      </div>
    </section>
  </div>
  
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<script type="text/javascript">
  function edit_data_master_akun(id)
  {
    let xhr_edit_master_akun = new XMLHttpRequest();
    xhr_edit_master_akun.onreadystatechange = function()
    {
      if(this.readyState == 4 && this.status == 200)
      {
        console.log(JSON.parse(xhr_edit_master_akun.responseText));
        document.getElementById('edit_id_akun').value = JSON.parse(xhr_edit_master_akun.responseText)['id'];
        document.getElementById('old_kode_akun').value = JSON.parse(xhr_edit_master_akun.responseText)['akun'];
        document.getElementById('old_pagu_akun').value = JSON.parse(xhr_edit_master_akun.responseText)['jumlah'];
        document.getElementById('old_sumber').value = JSON.parse(xhr_edit_master_akun.responseText)['sumber'].toUpperCase();
      }
    };
    xhr_edit_master_akun.open("GET", '<?=base_url('index.php/pok/json_show_akun_item/')?>'+id, true);
    xhr_edit_master_akun.send();
  }
</script>


<!-- modal edit data akun -->
<div class="modal fade bd-example-modal-lg" id="modal_edit_akun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/pok/simpan_edit_akun')?>">
            <input type="hidden" name="edit_id_akun" id="edit_id_akun" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <p class="h5 text-center"><u>Sebelum</u></p>
                <div class="form-group">
                  <label>Akun</label>
                  <input type="text" class="form-control" placeholder="mis: 001" name="old_kode_akun" id="old_kode_akun" readonly>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" class="form-control"  name="old_pagu_akun" id="old_pagu_akun" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Sumber</label>
                      <input type="text" class="form-control" name="old_sumber" id="old_sumber" readonly>
                  </div>
                </div>
                
              </div>

              <div class="col-md-6">
                <p class="h5 text-center underline"><u>Sesudah</u></p>
                <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Akun</label>
                        <select class="form-control" name="edit_kode_akun"  id="edit_kode_akun" onchange="updateEditUraianAkun()">
                          <?php foreach($bagan_akun_standar as $bas):?>
                            <option value="<?=$bas['kode']?>"><?=$bas['kode']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-8">
                    <div class="form-group">
                        <label>Uraian Akun</label>
                        <input class="form-control" type="text" name="edit_uraian_akun" id="edit_uraian_akun" readonly>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jumlah</label>
                      <input type="number" class="form-control"   name="edit_pagu_akun" id="edit_pagu_akun">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Sumber</label>
                      <select class="form-control" name="edit_sumber" id="edit_sumber">
                        <option value="rm">RM</option>
                        <option value="pnp">PNP</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan perubahan data</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>
      </div>
    </div>