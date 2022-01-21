<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POK - Master SubKomponen</h1>
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
                    <table id="table_master_pok_subkomponen" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Kegiatan</th>
                          <th>Kode KRO</th>
                          <th>Kode RO</th>
                          <th>Kode Komponen</th>
                          <th>Kode SubKomponen</th>
                          <th>Uraian</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($subkomponens as $subkomponen):?>
                          <tr>
                            <td><?=$subkomponen['kegiatan']?></td>
                            <td><?=$subkomponen['kro']?></td>
                            <td><?=$subkomponen['ro']?></td>
                            <td><?=$subkomponen['komponen']?></td>
                            <td><?=$subkomponen['subkomponen']?></td>
                            <td><?=$subkomponen['uraian']?></td>
                            <td>
                              <button class="badge badge-pill badge-warning" onclick="edit_data_master_subkomponen(<?=$subkomponen['id']?>)" data-toggle="modal" data-target="#modal_edit_subkomponen">Edit</button>
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
                    <h4>Input Master SubKomponen dalam POK</h4>
                  </div>
                  <div class="card-body">
                    <input type="hidden" name="kode_kegiatan" id="kode_kegiatan">
                    <input type="hidden" name="kode_kro" id="kode_kro">
                    <input type="hidden" name="kode_ro" id="kode_ro">
                    <input type="hidden" name="kode_komponen" id="kode_komponen">
                      <div class="form-group">
                        <label>Kode Komponen</label>
                        <select class="form-control" name="id_komponen" id="id_komponen" onchange="getKodeKomponen()">
                          <?php foreach($komponens as $komponen):?>
                            <option value="<?=$komponen['id']?>"><?=$komponen['kegiatan']?>-<?=$komponen['kro']?>-<?=$komponen['ro']?>-<?=$komponen['komponen']?> - <?=$komponen['uraian']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kode Subkomponen</label>
                        <input type="text" class="form-control" placeholder="mis: A" name="kode_subkomponen" id="kode_subkomponen">
                      </div>
                      <div class="form-group">
                        <label>Uraian Subkomponen</label>
                        <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="uraian_subkomponen" id="uraian_subkomponen">
                      </div>
                      <button type="button" class="btn btn-primary" onclick="simpanDataSubKomponen()">Simpan</button>
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
  function getKodeKomponen()
  {
    let id_komponen = document.getElementById('id_komponen').value;
    let xhr_load_komponen = new XMLHttpRequest();
    xhr_load_komponen.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        document.getElementById('kode_kegiatan').value = JSON.parse(this.responseText)['kegiatan'];
        document.getElementById('kode_kro').value = JSON.parse(this.responseText)['kro'];
        document.getElementById('kode_ro').value = JSON.parse(this.responseText)['ro'];
        document.getElementById('kode_komponen').value = JSON.parse(this.responseText)['komponen'];
        console.log(JSON.parse(this.responseText));
      }
    };
    xhr_load_komponen.open("GET", '<?=base_url('index.php/pok/json_show_komponen_item/')?>'+id_komponen, true);
    xhr_load_komponen.send();
  }
</script>

<script type="text/javascript">
  function edit_data_master_subkomponen(id)
  {
    let xhr_edit_master_subkomponen = new XMLHttpRequest();
    xhr_edit_master_subkomponen.onreadystatechange = function()
    {
      if(this.readyState == 4 && this.status == 200)
      {
        console.log(JSON.parse(xhr_edit_master_subkomponen.responseText));
        document.getElementById('edit_id_subkomponen').value = JSON.parse(xhr_edit_master_subkomponen.responseText)['id'];
        document.getElementById('old_kode_subkomponen').value = JSON.parse(xhr_edit_master_subkomponen.responseText)['subkomponen'];
        document.getElementById('old_uraian_subkomponen').value = JSON.parse(xhr_edit_master_subkomponen.responseText)['uraian'];
      }
    };
    xhr_edit_master_subkomponen.open("GET", '<?=base_url('index.php/pok/json_show_subkomponen_item/')?>'+id, true);
    xhr_edit_master_subkomponen.send();
  }
</script>

<!-- modal edit data subkomponen -->
<div class="modal fade bd-example-modal-lg" id="modal_edit_subkomponen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Subkomponen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/pok/simpan_edit_subkomponen')?>">
            <input type="hidden" name="edit_id_subkomponen" id="edit_id_subkomponen" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <p class="h5 text-center"><u>Sebelum</u></p>
                <div class="form-group">
                  <label>Kode SubKomponen</label>
                  <input type="text" class="form-control" placeholder="mis: 001" name="old_kode_subkomponen" id="old_kode_subkomponen"  readonly>
                </div>
                <div class="form-group">
                  <label>Uraian SubKomponen</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="old_uraian_subkomponen" id="old_uraian_subkomponen" readonly>
                </div>
              </div>

              <div class="col-md-6">
                <p class="h5 text-center underline"><u>Sesudah</u></p>
                <div class="form-group">
                  <label>Kode SubKomponen</label>
                  <input type="text" class="form-control" placeholder="mis: 001" name="edit_kode_subkomponen" id="edit_kode_subkomponen">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Uraian Komponen</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="edit_uraian_subkomponen" id="edit_uraian_subkomponen">
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