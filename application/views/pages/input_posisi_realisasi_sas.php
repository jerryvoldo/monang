<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posisi</h1>
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
                    <table id="table_realisasi_sas" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Tanggal SAS</th>
                          <th>Jumlah Realisasi RM</th>
                          <th>Jumlah Realisasi PNP</th>
                          <th>Tanggal Input</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($realisasi_sas as $sas):?>
                          <tr>
                            <td><?=date('d M Y',$sas['epoch_realisasi_sas'])?></td>
                            <td align="right"><?=number_format($sas['jumlah_rm_realisasi_sas'])?></td>
                            <td align="right"><?=number_format($sas['jumlah_pnp_realisasi_sas'])?></td>
                            <td><?=date('d M Y',$sas['epoch_input_realisasi_sas'])?></td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-body">
                    <p class="h5">Input Realisasi SAS</p>
                    <form method="POST" action="<?=base_url('index.php/posisi/simpan_realisasi_sas')?>">
                    <div class="form-group">
                      <label>Jumlah Realisasi SAS RM</label>
                      <input type="number" class="form-control"  name="jumlah_realisasi_sas_rm" id="jumlah_realisasi_sas_rm">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Realisasi SAS PNP</label>
                      <input type="number" class="form-control"  name="jumlah_realisasi_sas_pnp" id="jumlah_realisasi_sas_pnp">
                    </div>
                    <div class="form-group">
                      <label>Per Tanggal</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_data_sas">
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
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