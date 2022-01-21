
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Realisasi LS</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <button type="button" class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#modal-xl">
              Input Realisasi
            </button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
            <div class="card-body">
              <table id="table_realisasi_ls" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nomor Kuitansi</th>
                      <th>Tanggal Kuitansi</th>
                      <th>Uraian Realisasi</th>
                      <th>Jumlah</th>
                      <th>Cara Tarik</th>
                      <th>Sumber</th>
                      <th>Kontraktual</th>
                      <th>Nomor SPM</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php foreach($load_all_realisasi_ls as $ls):?>
                        <tr>
                          <td><?=$ls['nomor_kuitansi']?></td>
                          <td><?=date('d M Y', $ls['epoch_kuitansi'])?></td>
                          <td><?=$ls['uraian_realisasi']?></td>
                          <td class="text-right"><?=number_format($ls['jumlah_realisasi_bruto'])?></td>
                          <td class="text-center"><?=strtoupper($ls['cara_tarik'])?></td>
                          <td class="text-center">
                              <?php if($ls['sumber'] == 'rm'):?>
                                <h4><span class="badge badge-pill badge-primary">RM</span></h4>
                              <?php else:?>
                                <h4><span class="badge badge-pill badge-danger">PNP</span></h4>
                              <?php endif;?>
                            </td>
                          <td class="text-center"><?= ($ls['is_kontraktual'] ? '<span class="badge badge-pill badge-info">KONTRAK</span>' : '<span class="badge badge-pill badge-light">BUKAN</span>') ?></td>
                          <td class="">
                            <span class="font-weight-bold"><?=$ls['nomor_spm']?></span><br>
                             <?=date('d M Y', $ls['epoch_spm'])?>
                          </td>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>Nomor Kuitansi</th>
                      <th>Tanggal Kuitansi</th>
                      <th>Uraian Realisasi</th>
                      <th>Jumlah</th>
                      <th>Cara Tarik</th>
                      <th>Sumber</th>
                      <th>Kontraktual</th>
                      <th>Nomor SPM</th>
                    </tr>
                    </tfoot>
                  </table>


            </div>
            </div>
          </div>
        </div>

      <!-- modal -->
      <div class="modal fade" id="modal-xl" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- SELECT2 EXAMPLE -->
                <div class="card card-default shadow">
                  <div class="card-header">
                    <h3 class="card-title">
                      <div class="form-group">
                        <label>Akun</label>
                          <select id="akun_realisasi" class="form-control select2bs4 block" onchange="getSelectedAkunId()">
                            <option>--Pilih Akun--</option>
                            <?php foreach($akuns as $akun):?>
                            <option value="<?=$akun['id']?>"><?=$akun['kro']?>-<?=$akun['ro']?>-<?=$akun['komponen']?>-<?=$akun['subkomponen']?>-<?=$akun['akun']?> - <?=$akun['uraian']?></option>
                            <?php endforeach;?>
                          </select>
                          <small class="form-text text-muted italic">Terlebih dahulu pilih akun yang akan direalisasikan sebelum mengisi form dibawah</small>
                        </div>
                    </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4">
                        <h5>Detail Akun</h5>
                        <table class="table table-sm">
                          <tr>
                            <th style="width: 16.66%">Kegiatan</th>
                            <td style="width: 10%">:</td>
                            <td id="realisasi_kegiatan">-</td>
                          </tr>
                          <tr>
                            <th>KRO</th>
                            <td>:</td>
                            <td id="realisasi_kro">-</td>
                          </tr>
                          <tr>
                            <th>RO</th>
                            <td>:</td>
                            <td id="realisasi_ro">-</td>
                          </tr>
                          <tr>
                            <th>Komponen</th>
                            <td>:</td>
                            <td id="realisasi_komponen">-</td>
                          </tr>
                          <tr>
                            <th>Subkomponen</th>
                            <td>:</td>
                            <td id="realisasi_subkomponen">-</td>
                          </tr>
                          <tr>
                            <th>Akun</th>
                            <td>:</td>
                            <td id="realisasi_akun">-</td>
                          </tr>
                          <tr>
                            <th>Uraian</th>
                            <td>:</td>
                            <td id="realisasi_uraian">-</td>
                          </tr>
                          <tr>
                            <th>Sumber</th>
                            <td>:</td>
                            <td id="realisasi_sumber">-</td>
                          </tr>
                          <tr>
                            <th>Pagu</th>
                            <td>:</td>
                            <td id="realisasi_pagu">-</td>
                          </tr>
                        </table>
                        <!-- /.form-group -->
                      </div>
                      <div class="col-md-8">
                        <h5>Posisi Anggaran Akun</h5>
                        <table class="table table-sm table-bordered">
                          <tr>
                            <th style="width: 14.28%" class="text-center" rowspan="2">Poksi</th>
                            <th class="text-center" colspan="3">TUP</th>
                            <th class="text-center" colspan="2">UP</th>
                            <th class="text-center">LS</th>
                          </tr>
                          <tr>
                            <th style="width: 14.28%" class="text-center" >Aju</th>
                            <th style="width: 14.28%" class="text-center">Realisasi</th>
                            <th style="width: 14.28%" class="text-center">Saldo</th>
                            <th style="width: 14.28%" class="text-center">Realisasi</th>
                            <th style="width: 14.28%" class="text-center">Saldo</th>
                            <th style="width: 14.28%" class="text-center">Realisasi</th>
                          </tr> 
                          <tr>
                            <th>KMGI</th>
                            <td class="text-right" id="aju_tup_kmgi"></td>
                            <td class="text-right" id="realisasi_tup_kmgi"></td>
                            <td class="text-right" id="sisa_tup_kmgi"></td>
                            <td class="text-right" rowspan="5" id="realisasi_up"></td>
                            <td class="text-right" rowspan="5" id="saldo_up"></td>
                            <td class="text-right" rowspan="5" id="realisasi_ls"></td>
                          </tr>
                          <tr>
                            <th>FASDAR</th>
                            <td class="text-right" id="aju_tup_fasdar"></td>
                            <td class="text-right" id="realisasi_tup_fasdar"></td>
                            <td class="text-right" id="sisa_tup_fasdar"></td>
                          </tr>
                          <tr>
                            <th>EXIM</th>
                            <td class="text-right" id="aju_tup_exim"></td>
                            <td class="text-right" id="realisasi_tup_exim"></td>
                            <td class="text-right" id="sisa_tup_exim"></td>
                          </tr>
                          <tr>
                            <th>TOP</th>
                            <td class="text-right" id="aju_tup_top"></td>
                            <td class="text-right" id="realisasi_tup_top"></td>
                            <td class="text-right" id="sisa_tup_top"></td>
                          </tr>
                          <tr>
                            <th>Total</th>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                            <td class="text-right"></td>
                          </tr>
                          <tr>
                            <th>Sisa Pagu</th>
                            <td class="text-right" id="sisa_pagu" colspan="6">
                              0
                            </td>
                          </tr>
                        </table>
                      </div>

                      <script type="text/javascript">
                        let am_realisasi_ls = 0;
                          let am_realisasi_up = 0;
                          let am_realisasi_tup = 0;
                          let am_pagu = 0;
                          let am_sisa_pagu = 0;

                        function getSelectedAkunId()
                        {
                          am_realisasi_ls = am_realisasi_up = am_realisasi_tup = am_pagu = am_sisa_pagu = 0;

                          let selectedAkunId = document.getElementById('akun_realisasi')[document.getElementById('akun_realisasi').selectedIndex].value;
                          console.log(selectedAkunId);
                          let xhttp = new XMLHttpRequest();
                          xhttp.onreadystatechange = function() {
                            if(this.readyState == 4 && this.status == 200)
                            {
                              console.log(JSON.parse(xhttp.responseText));
                              let data = JSON.parse(xhttp.responseText);
                              document.getElementById('realisasi_kegiatan').innerHTML = data[0]['kegiatan'];
                              document.getElementById('realisasi_kro').innerHTML = data[0]['kro'];
                              document.getElementById('realisasi_ro').innerHTML = data[0]['ro'];
                              document.getElementById('realisasi_komponen').innerHTML = data[0]['komponen'];
                              document.getElementById('realisasi_subkomponen').innerHTML = data[0]['subkomponen'];
                              document.getElementById('realisasi_akun').innerHTML = data[0]['akun'];
                              document.getElementById('realisasi_uraian').innerHTML = data[0]['uraian'];
                              document.getElementById('realisasi_sumber').innerHTML = data[0]['sumber'].toUpperCase();
                              document.getElementById('realisasi_pagu').innerHTML = (data[0]['jumlah'] == null ? 0 : 'Rp. '+thousandSeparator(data[0]['jumlah']));

                              am_pagu = parseInt(data[0]['jumlah']);

                              // isikan value ke hidden field
                              document.getElementById('input_kegiatan_realisasi').value = data[0]['kegiatan'];
                              document.getElementById('input_kro_realisasi').value = data[0]['kro'];
                              document.getElementById('input_ro_realisasi').value = data[0]['ro'];
                              document.getElementById('input_komponen_realisasi').value = data[0]['komponen'];
                              document.getElementById('input_subkomponen_realisasi').value = data[0]['subkomponen'];
                              document.getElementById('input_akun_realisasi').value = data[0]['akun'];
                              document.getElementById('input_sumber_realisasi').value = data[0]['sumber'];

                              // load data posisi tup
                              let xhttp2 = new XMLHttpRequest();
                              xhttp2.onreadystatechange = function() {
                                if(this.readyState == 4 && this.status == 200)
                                {

                                  let data_posisi_tup = JSON.parse(xhttp2.responseText);
                                  console.log(data_posisi_tup);
                                  if(data_posisi_tup.length == 0)
                                  {
                                    am_realisasi_tup = 0;
                                    document.getElementById('aju_tup_kmgi').innerHTML = 0;
                                    document.getElementById('realisasi_tup_kmgi').innerHTML = 0;
                                    document.getElementById('sisa_tup_kmgi').innerHTML = 0;

                                    document.getElementById('aju_tup_fasdar').innerHTML = 0;
                                    document.getElementById('realisasi_tup_fasdar').innerHTML = 0;
                                    document.getElementById('sisa_tup_fasdar').innerHTML = 0;

                                    document.getElementById('aju_tup_exim').innerHTML = 0;
                                    document.getElementById('realisasi_tup_exim').innerHTML = 0;
                                    document.getElementById('sisa_tup_exim').innerHTML = 0;

                                    document.getElementById('aju_tup_top').innerHTML = 0;
                                    document.getElementById('realisasi_tup_top').innerHTML = 0;
                                    document.getElementById('sisa_tup_top').innerHTML = 0;
                                  }
                                  else
                                  {
                                    data_posisi_tup.forEach(posisi_tup => {
                                      am_realisasi_tup = am_realisasi_tup + parseInt(posisi_tup['jumlah_realisasi_tup']);
                                      if(posisi_tup['poksi'] == 'kmgi')
                                      {
                                        document.getElementById('aju_tup_kmgi').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup']);
                                        document.getElementById('realisasi_tup_kmgi').innerHTML = thousandSeparator(posisi_tup['jumlah_realisasi_tup']);
                                        document.getElementById('sisa_tup_kmgi').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup'] - posisi_tup['jumlah_realisasi_tup']);

                                      }
                                      
                                      if(posisi_tup['poksi'] == 'fasdar')
                                      {
                                        document.getElementById('aju_tup_fasdar').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup']);;
                                        document.getElementById('realisasi_tup_fasdar').innerHTML = thousandSeparator(posisi_tup['jumlah_realisasi_tup']);
                                        document.getElementById('sisa_tup_fasdar').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup'] - posisi_tup['jumlah_realisasi_tup']);
                                      }
                                      
                                      if(posisi_tup['poksi'] == 'fasdar')
                                      {
                                        document.getElementById('aju_tup_exim').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup']);
                                        document.getElementById('realisasi_tup_exim').innerHTML = thousandSeparator(posisi_tup['jumlah_realisasi_tup']);
                                        document.getElementById('sisa_tup_exim').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup'] - posisi_tup['jumlah_realisasi_tup']);

                                      }

                                      if(posisi_tup['poksi'] == 'top')
                                      {
                                        document.getElementById('aju_tup_top').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup']);
                                        document.getElementById('realisasi_tup_top').innerHTML = thousandSeparator(posisi_tup['jumlah_realisasi_tup']);
                                        document.getElementById('sisa_tup_top').innerHTML = thousandSeparator(posisi_tup['jumlah_aju_tup'] - posisi_tup['jumlah_realisasi_tup']);
                                      }
                                    });
                                  }
                                }
                              };
                              xhttp2.open("GET", "<?=base_url('index.php/dashboard/load_data_posisi_tup/')?>"+data[0]['kro']+'/'+data[0]['ro']+'/'+data[0]['komponen']+'/'+data[0]['subkomponen']+'/'+data[0]['akun']+'/'+data[0]['sumber'], true);
                              xhttp2.send();

                              // load data posisi up
                              let xhttp3 = new XMLHttpRequest();
                              xhttp3.onreadystatechange = function() {
                                if(this.readyState == 4 && this.status == 200)
                                {
                                  let data_posisi_up = JSON.parse(xhttp3.responseText);
                                  console.log(data_posisi_up);
                                  if(data_posisi_up.length == 0)
                                  {
                                    document.getElementById('realisasi_up').innerHTML = 0;
                                    document.getElementById('saldo_up').innerHTML = 0;
                                    am_realisasi_up = 0;
                                  }
                                  else
                                  {
                                    data_posisi_up.forEach(up => {
                                      document.getElementById('realisasi_up').innerHTML = thousandSeparator(up['jumlah_realisasi_up']);
                                      document.getElementById('saldo_up').innerHTML = thousandSeparator(up['sisa_pengajuan_up']);
                                      am_realisasi_up = am_realisasi_up + parseInt(up['jumlah_realisasi_up']);
                                    });
                                  }
                                }
                              };
                              xhttp3.open("GET", "<?=base_url('index.php/dashboard/load_data_posisi_up/')?>"+data[0]['kro']+'/'+data[0]['ro']+'/'+data[0]['komponen']+'/'+data[0]['subkomponen']+'/'+data[0]['akun']+'/'+data[0]['sumber'], true);
                              xhttp3.send();

                              // load data posisi ls
                              let xhttp4 = new XMLHttpRequest();
                              xhttp4.onreadystatechange = function() {
                                if(this.readyState == 4 && this.status == 200)
                                {
                                  let data_posisi_ls = JSON.parse(xhttp4.responseText);
                                  console.log(data_posisi_ls);
                                  if(data_posisi_ls.length == 0)
                                  {
                                    document.getElementById('realisasi_ls').innerHTML = 0;
                                    am_realisasi_ls = 0;
                                    getSisaDana();
                                  }
                                  else
                                  {
                                      data_posisi_ls.forEach(ls => {
                                        document.getElementById('realisasi_ls').innerHTML = thousandSeparator(ls['jumlah_realisasi_ls']);
                                        am_realisasi_ls = am_realisasi_ls + parseInt(ls['jumlah_realisasi_ls']);
                                    });
                                      getSisaDana();
                                  }
                                }
                                else
                                {
                                  document.getElementById('sisa_pagu').innerHTML = '<div class="spinner-border text-success" role="status"><span class="sr-only">Loading...</span></div>';
                                }
                              };
                              xhttp4.open("GET", "<?=base_url('index.php/dashboard/load_data_posisi_ls/')?>"+data[0]['kro']+'/'+data[0]['ro']+'/'+data[0]['komponen']+'/'+data[0]['subkomponen']+'/'+data[0]['akun']+'/'+data[0]['sumber'], true);
                              xhttp4.send();

                              
                            }
                          };
                          xhttp.open("GET", "<?=base_url('index.php/dashboard/load_akun_realisasi/')?>"+selectedAkunId, true);
                          xhttp.send();
                          
                        }

                        function thousandSeparator(x) {
                            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");
                        }

                        function getSisaDana()
                        {
                          am_sisa_pagu = thousandSeparator(am_pagu - am_realisasi_ls - am_realisasi_up - am_realisasi_tup);
                          document.getElementById('sisa_pagu').innerHTML = am_sisa_pagu;
                        }
                      </script>

                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-default shadow ">
                  <div class="card-header">
                    <h4 class="card-title">Input Data Realisasi LS</h4>
                  </div>
                  <form method="POST" action="<?=base_url('index.php/dashboard/simpan_realisasi')?>">
                    <!-- hidden field -->
                    <input type="hidden" id="input_kegiatan_realisasi" name="kegiatan_realisasi" >
                    <input type="hidden" id="input_kro_realisasi" name="kro_realisasi" >
                    <input type="hidden" id="input_ro_realisasi" name="ro_realisasi" >
                    <input type="hidden" id="input_komponen_realisasi" name="komponen_realisasi" >
                    <input type="hidden" id="input_subkomponen_realisasi" name="subkomponen_realisasi" >
                    <input type="hidden" id="input_akun_realisasi" name="akun_realisasi" >
                    <input type="hidden" id="input_sumber_realisasi" name="sumber_realisasi" >
                    <input type="hidden" name="cara_tarik" value="ls">
                    <input type="hidden" name="nilai_ppn" value="0">
                    <input type="hidden" name="nilai_pph" value="0">
                    <input type="hidden" name="select_pph" value="no_pajak">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Nomor Kuitansi</label>
                          <input class="form-control" type="text"  name="nomor_kuitansi">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Tanggal Kuitansi</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tanggal_kuitansi">
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Penerima</label>
                          <textarea class="form-control" rows="3" name="penerima"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label>Poksi</label>
                            <div class="form-check d-flex justify-content-between">
                              <div>
                              <input class="form-check-input" type="radio" name="poksi" value="kmgi">
                              <label class="form-check-label">KMGI</label>
                              </div>
                              <div>
                              <input class="form-check-input" type="radio" name="poksi" checked="" value="fasdar">
                              <label class="form-check-label">FASDAR</label>
                              </div>
                              <div>
                              <input class="form-check-input" type="radio" name="poksi" value="top">
                              <label class="form-check-label">TOP</label>
                              </div>
                              <div>
                              <input class="form-check-input" type="radio" name="poksi" value="exim">
                              <label class="form-check-label">EXIM</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Kontraktual</label>
                            <div class="d-flex">
                            <div class="form-check  mr-5">
                              <input class="form-check-input" type="radio" name="kontraktual" value="t">
                              <label class="form-check-label">Iya</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="kontraktual" checked="" value="f">
                              <label class="form-check-label">Tidak</label>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Uraian Realisasi</label>
                          <textarea class="form-control" rows="3" name="uraian_realisasi"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Jumlah Realisasi</label>
                          <input class="form-control" type="number"  name="jumlah_realisasi_bruto">
                        </div>
                      </div>
                    </div>  
                  </div>
                
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      </div>
      <!-- /.container-fluid -->
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

