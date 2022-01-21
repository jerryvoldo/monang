
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tahun Anggaran <?=date('Y', time())?> </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- tabel monitor posisi anggaran -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Monitor Posisi Anggaran</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-head-fixed text-nowrap table-bordered table-sm" id="table_posisi">
                  <thead>
                    <tr>
                      <th>Sumber Dana</th>
                      <th>Pagu <br> (a)</th>
                      <th>Realisasi <br> SAS (b)</th>
                      <th>Sisa Dana <br> (c = a - b)</th>
                      <th>Pagu Pulih <br> (d)</th>
                      <th>Sisa Dana + Pagu Pulih <br> (e = c + d)</th>
                      <th>Outstanding <br> (f)</th>
                      <th>TUP <br> (g)</th>
                      <th>UP <br> (h)</th>
                      <th>Selisih Sebelum Realisasi LS <br> (i = e - f - g - h)</th>
                      <th>Realisasi <br> LS & UP (j)</th>
                      <th>Sisa Dana <br> (k = i - j)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>RM</td>
                      <td align="right"><?=number_format($dana_rm['total_pagu_rm'])?></td>
                      <td align="right"><?=number_format($load_realisasi_sas[0]['jumlah_rm_realisasi_sas'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_sas['rm'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_pagu_pulih['total_pagu_pulih_rm'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_pagu_pulih['rm'])?></td>
                      <td align="right"><?=number_format($load_kontrak['rm'])?></td>
                      <td align="right"><?=number_format($load_pengajuan_tup['rm'])?></td>
                      <td align="right"><?=number_format($load_pengajuan_up['rm'])?></td>
                      <td align="right"><?=number_format($load_sisa_dana_before_ls_up['rm'])?></td>
                      <td align="right"><?=number_format($load_realisasi['rm'])?></td>
                      <td align="right"><?=number_format($load_sisa_dana_akhir['rm'])?></td>
                    </tr>
                    <tr>
                      <td>PNP</td>
                      <td align="right"><?=number_format($dana_pnp['total_pagu_pnp'])?></td>
                      <td align="right"><?=number_format($load_realisasi_sas[0]['jumlah_pnp_realisasi_sas'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_sas['pnp'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_pagu_pulih['total_pagu_pulih_pnp'])?></td>
                      <td align="right"><?=number_format($sisa_dana_after_pagu_pulih['pnp'])?></td>
                      <td align="right"><?=number_format($load_kontrak['pnp'])?></td>
                      <td align="right"><?=number_format($load_pengajuan_tup['pnp'])?></td>
                      <td align="right"><?=number_format($load_pengajuan_up['pnp'])?></td>
                      <td align="right"><?=number_format($load_sisa_dana_before_ls_up['pnp'])?></td>
                      <td align="right"><?=number_format($load_realisasi['pnp'])?></td>
                      <td align="right"><?=number_format($load_sisa_dana_akhir['pnp'])?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- end -->

            <!-- tabel pok -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">POK DitwasdarPO 2022</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-head-fixed text-nowrap  table-sm" id="table_pok">
                  <thead>
                    <tr>
                      <th>Kegiatan</th>
                      <th>KRO</th>
                      <th>RO</th>
                      <th>Komp</th>
                      <th>Subkomp</th>
                      <th>Akun</th>
                      <th>Uraian</th>
                      <th>Pagu</th>
                      <th>Realisasi</th>
                      <th>Sisa</th>
                      <th>Sumber</th>
                      <th>R. UP</th>
                      <th>R. TUP</th>
                      <th>R. LS</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($pok as $item):?>
                    <tr>
                      <td><?=$item['kegiatan']?></td>
                      <td><?=$item['kro']?></td>
                      <td><?=$item['ro']?></td>
                      <td><?=$item['komponen']?></td>
                      <td><?=$item['subkomponen']?></td>
                      <td><?=$item['akun']?></td>
                      <td><?=$item['uraian']?></td>
                      <td align="right"><?=number_format($item['pagu'])?></td>
                      <td align="right"><?=number_format($item['total_realisasi'])?></td>
                      <td align="right"><?=number_format($item['sisa_pagu'])?></td>
                      <td align="center"><?=strtoupper($item['sumber'])?></td>
                      <td align="right"><?=number_format($item['jumlah_up'])?></td>
                      <td align="right"><?=number_format($item['jumlah_tup'])?></td>
                      <td align="right"><?=number_format($item['jumlah_ls'])?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- end -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 DITWASDARPO</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


