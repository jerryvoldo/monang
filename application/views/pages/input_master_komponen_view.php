<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POK - Master Komponen</h1>
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
              <div class="col-md-8">
                <div class="card card-default">
                  <div class="card-body">
                    <table id="table_master_pok_komponen" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Kegiatan</th>
                          <th>Kode KRO</th>
                          <th>Kode RO</th>
                          <th>Kode Komponen</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($komponens as $komponen):?>
                          <tr>
                            <td><?=$komponen['kegiatan']?></td>
                            <td><?=$komponen['kro']?></td>
                            <td><?=$komponen['ro']?></td>
                            <td><?=$komponen['komponen']?></td>
                            <td><?=$komponen['uraian']?></td>
                            <td>
                              <button class="badge badge-pill badge-warning" onclick="edit_data_master_komponen(<?=$komponen['id']?>)" data-toggle="modal" data-target="#modal_edit_komponen">Edit</button>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-header">
                    <h4>Input Master Komponen dalam POK</h4>
                  </div>
                  <div class="card-body">

                    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan">
                    <input type="hidden" name="kode_kro" id="kode_kro">
                    <input type="hidden" name="kode_ro" id="kode_ro">
                      <div class="form-group">
                        <label>Kode RO</label>
                        <select class="form-control" name="id_ro" id="id_ro" onchange="getKodeKegKro()">
                          <?php foreach($ros as $ro):?>
                            <option value="<?=$ro['id']?>"><?=$ro['kegiatan']?>-<?=$ro['kro']?>-<?=$ro['ro']?> - <?=$ro['uraian']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kode Komponen</label>
                        <input type="text" class="form-control" placeholder="mis: 051" name="kode_komponen" id="kode_komponen">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Uraian Komponen</label>
                        <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="uraian_komponen" id="uraian_komponen">
                      </div>
                      <button type="button" class="btn btn-primary" onclick="simpanDataKomponen()">Simpan</button>
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
  function getKodeKegKro()
  {
    let id_kro = document.getElementById('id_ro').value;
    let xhr_load_kro = new XMLHttpRequest();
    xhr_load_kro.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        document.getElementById('kode_kegiatan').value = JSON.parse(this.responseText)['kegiatan'];
        document.getElementById('kode_kro').value = JSON.parse(this.responseText)['kro'];
        document.getElementById('kode_ro').value = JSON.parse(this.responseText)['ro'];
        console.log(JSON.parse(this.responseText));
      }
    };
    xhr_load_kro.open("GET", '<?=base_url('index.php/pok/json_show_ro_item/')?>'+id_kro, true);
    xhr_load_kro.send();
  }
</script>

<script type="text/javascript">
  function edit_data_master_komponen(id)
  {
    let xhr_edit_master_komponen = new XMLHttpRequest();
    xhr_edit_master_komponen.onreadystatechange = function()
    {
      if(this.readyState == 4 && this.status == 200)
      {
        console.log(JSON.parse(xhr_edit_master_komponen.responseText));
        document.getElementById('edit_id_komponen').value = JSON.parse(xhr_edit_master_komponen.responseText)['id'];
        document.getElementById('old_kode_komponen').value = JSON.parse(xhr_edit_master_komponen.responseText)['komponen'];
        document.getElementById('old_uraian_komponen').value = JSON.parse(xhr_edit_master_komponen.responseText)['uraian'];
      }
    };
    xhr_edit_master_komponen.open("GET", '<?=base_url('index.php/pok/json_show_komponen_item/')?>'+id, true);
    xhr_edit_master_komponen.send();
  }
</script>




<!-- modal edit data komponen -->
<div class="modal fade bd-example-modal-lg" id="modal_edit_komponen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Komponen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/pok/simpan_edit_komponen')?>">
            <input type="hidden" name="edit_id_komponen" id="edit_id_komponen" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <p class="h5 text-center"><u>Sebelum</u></p>
                <div class="form-group">
                  <label>Kode Komponen</label>
                  <input type="text" class="form-control" placeholder="mis: 001" name="old_kode_komponen" id="old_kode_komponen"  readonly>
                </div>
                <div class="form-group">
                  <label>Uraian Komponen</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="old_uraian_komponen" id="old_uraian_komponen" readonly>
                </div>
              </div>

              <div class="col-md-6">
                <p class="h5 text-center underline"><u>Sesudah</u></p>
                <div class="form-group">
                  <label>Kode Komponen</label>
                  <input type="text" class="form-control" placeholder="mis: 001" name="edit_kode_komponen" id="edit_kode_komponen">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Uraian Komponen</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="edit_uraian_komponen" id="edit_uraian_komponen">
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



