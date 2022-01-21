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
                    <p class="h5">Daftar Pagu Pulih</p>
                    <table id="table_realisasi_sas" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Akun</th>
                          <th>Uraian</th>
                          <th>Jumlah Pagu Pulih</th>
                          <th>Sumber </th>
                          <th>Tanggal SAS</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($pagu_pulih as $pulih):?>
                          <tr>
                            <td><?=$pulih['kegiatan']?>-<?=$pulih['kro']?>-<?=$pulih['ro']?>-<?=$pulih['komponen']?>-<?=$pulih['subkomponen']?>-<?=$pulih['akun']?></td>
                            <td><?=$pulih['uraian']?></td>
                            <td align="right"><?=number_format($pulih['jumlah_pagu_pulih'])?></td>
                            <td align="center"><?=strtoupper($pulih['sumber'])?></td>
                            <td><?=date('d M Y',$pulih['epoch_sas_pagu_pulih'])?></td>
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
                    <p class="h5">Input Pagu Pulih</p>
                    <form method="POST" action="<?=base_url('index.php/posisi/simpan_pagu_pulih')?>">
                    <div class="form-group">
                        <label>Akun</label>
                        <select class="form-control" name="id_akun" id="id_akun">
                          <?php foreach($load_akun_pok as $akun_pok):?>
                            <option value="<?=$akun_pok['id']?>"><?=$akun_pok['kegiatan']?>-<?=$akun_pok['kro']?>-<?=$akun_pok['ro']?>-<?=$akun_pok['komponen']?>-<?=$akun_pok['subkomponen']?>-<?=$akun_pok['akun']?> - <?=$akun_pok['uraian']?></option>
                          <?php endforeach;?>
                        </select>
                      </div>

                    <div class="form-group">
                      <label>Jumlah Dana yang dipulihkan</label>
                      <input type="number" class="form-control"  name="jumlah_pagu_pulih" id="jumlah_pagu_pulih">
                    </div>
                    <div class="form-group">
                      <label>Tanggal Pulih (berdasarkan SAS)</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_pagu_pulih">
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