<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>POK - Master Kegiatan</h1>
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
                    <table id="table_master_pok_kegiatan" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Kode Kegiatan</th>
                          <th>Deskripsi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kegiatans as $kegiatan):?>
                          <tr>
                            <td><?=$kegiatan['kegiatan']?></td>
                            <td><?=$kegiatan['uraian']?></td>
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
                    <h4>Input Master Kegiatan dalam POK</h4>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="<?=base_url('index.php/pok/simpan_master_kegiatan')?>">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kode Kegiatan</label>
                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="mis: 4124" name="kode_kegiatan">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Deskripsi Kegiatan</label>
                        <input type="text" class="form-control"  placeholder="mis: Pengawasan Peredaran Pangan Olahan" name="uraian_kegiatan">
                      </div>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
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