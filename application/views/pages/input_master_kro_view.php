<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POK - Master KRO</h1>
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
                    <table id="table_master_pok_kro" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Kegiatan</th>
                          <th>Kode KRO</th>
                          <th>Uraian</th>
                          <th>Volume</th>
                          <th>Satuan volume</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kros as $kro):?>
                          <tr>
                            <td><?=$kro['kegiatan']?></td>
                            <td><?=$kro['kro']?></td>
                            <td><?=$kro['uraian']?></td>
                            <td><?=$kro['volume']?></td>
                            <td><?=$kro['satuan_volume']?></td>
                            <td>
                              <button class="badge badge-pill badge-warning" onclick="edit_data_master_kro(<?=$kro['id']?>)" data-toggle="modal" data-target="#modal_edit_kro">Edit</button>
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
                    <h4>Input Master KRO dalam POK</h4>
                  </div>
                  <div class="card-body">
                      <div class="form-group">
                        <label>Kode Kegiatan</label>
                        <select class="form-control" name="kode_kegiatan" id="kode_kegiatan">
                          <?php foreach($kegiatans as $kegiatan):?>
                            <option value="<?=$kegiatan['kegiatan']?>"><?=$kegiatan['kegiatan']?> - <?=$kegiatan['uraian']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Kode KRO</label>
                        <input type="text" class="form-control" placeholder="mis: BAH" name="kode_kro" id="kode_kro">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Uraian KRO</label>
                        <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="uraian_kro" id="uraian_kro">
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Volume</label>
                            <input type="number" class="form-control"  placeholder="mis: 5400" name="volume_kro" id="volume_kro">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Satuan Volume</label>
                            <input type="text" class="form-control"  placeholder="mis: layanan" name="satuan_volume_kro" id="satuan_volume_kro">
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn btn-primary" onclick="simpanDataKRO()">Simpan</button>
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
  function edit_data_master_kro(id)
  {
    let xhr_edit_master_kro = new XMLHttpRequest();
    xhr_edit_master_kro.onreadystatechange = function()
    {
      if(this.readyState == 4 && this.status == 200)
      {
        console.log(JSON.parse(xhr_edit_master_kro.responseText));
        document.getElementById('edit_id_kro').value = JSON.parse(xhr_edit_master_kro.responseText)['id'];
        document.getElementById('old_kode_kro').value = JSON.parse(xhr_edit_master_kro.responseText)['kro'];
        document.getElementById('old_uraian_kro').value = JSON.parse(xhr_edit_master_kro.responseText)['uraian'];
        document.getElementById('old_volume_kro').value = JSON.parse(xhr_edit_master_kro.responseText)['volume'];
        document.getElementById('old_satuan_volume_kro').value = JSON.parse(xhr_edit_master_kro.responseText)['satuan_volume'];
      }
    };
    xhr_edit_master_kro.open("GET", '<?=base_url('index.php/pok/json_show_kro_item/')?>'+id, true);
    xhr_edit_master_kro.send();
  }
</script>


 <!-- modal edit data ls -->
    <div class="modal fade bd-example-modal-lg" id="modal_edit_kro" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit KRO</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/pok/simpan_edit_kro')?>">
            <input type="hidden" name="edit_id_kro" id="edit_id_kro" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <p class="h5 text-center"><u>Sebelum</u></p>
                <div class="form-group">
                  <label>Kode Kegiatan</label>
                  <select class="form-control" name="old_kode_kegiatan" id="old_kode_kegiatan" readonly>
                    <?php foreach($kegiatans as $kegiatan):?>
                      <option value="<?=$kegiatan['kegiatan']?>"><?=$kegiatan['kegiatan']?> - <?=$kegiatan['uraian']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kode KRO</label>
                  <input type="text" class="form-control" placeholder="mis: BAH" name="old_kode_kro" id="old_kode_kro"  readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Uraian KRO</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="old_uraian_kro" id="old_uraian_kro" readonly>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Volume</label>
                      <input type="number" class="form-control"  placeholder="mis: 5400" name="old_volume_kro" id="old_volume_kro" readonly>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Satuan Volume</label>
                      <input type="text" class="form-control"  placeholder="mis: layanan" name="old_satuan_volume_kro" id="old_satuan_volume_kro" readonly>
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                <p class="h5 text-center underline"><u>Sesudah</u></p>
                <div class="form-group">
                  <label>Kode Kegiatan</label>
                  <select class="form-control" name="edit_kode_kegiatan" id="edit_kode_kegiatan">
                    <?php foreach($kegiatans as $kegiatan):?>
                      <option value="<?=$kegiatan['kegiatan']?>"><?=$kegiatan['kegiatan']?> - <?=$kegiatan['uraian']?></option>
                    <?php endforeach;?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Kode KRO</label>
                  <input type="text" class="form-control" placeholder="mis: BAH" name="edit_kode_kro" id="edit_kode_kro">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Uraian KRO</label>
                  <input type="text" class="form-control"  placeholder="mis: Pelayanan Publik Lainnya" name="edit_uraian_kro" id="edit_uraian_kro">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Volume</label>
                      <input type="number" class="form-control"  placeholder="mis: 5400" name="edit_volume_kro" id="edit_volume_kro">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Satuan Volume</label>
                      <input type="text" class="form-control"  placeholder="mis: layanan" name="edit_satuan_volume_kro" id="edit_satuan_volume_kro">
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