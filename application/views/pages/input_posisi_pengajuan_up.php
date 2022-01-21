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
                  <div class="card-header"><div class="card-title"><h5>Pengajuan UP</h5></div></div>
                  <div class="card-body">
                    <table id="table_posisi_up" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Tanggal deposit</th>
                          <th>Jumlah UP RM</th>
                          <th>Jumlah UP PNP</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-header"><div class="card-title"><h5>Input Pengajuan UP</h5></div></div>
                  <div class="card-body">
                    <div class="form-group">
                      <label>Jumlah Pengajuan RM</label>
                      <input type="number" class="form-control"  name="jumlah_pengajuan_up_rm" id="jumlah_pengajuan_up_rm" value="0">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Pengajuan PNP</label>
                      <input type="number" class="form-control"  name="jumlah_pengajuan_up_pnp" id="jumlah_pengajuan_up_pnp" value="0">
                    </div>
                    <div class="form-group">
                      <label>Tanggal deposit</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_deposit" id="tanggal_deposit">
                          <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="simpanPengajuanUp()">Simpan</button>
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


