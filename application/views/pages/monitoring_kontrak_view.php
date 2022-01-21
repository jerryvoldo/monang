
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Monitoring Kontrak</h1>
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
            <div class="card card-default">
            <div class="card-body">
              <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ls" role="tab" aria-controls="home" aria-selected="true">Kontrak LS</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#up" role="tab" aria-controls="profile" aria-selected="false">Kontrak UP</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tup" role="tab" aria-controls="contact" aria-selected="false">Kontrak TUP</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="ls" role="tabpanel" aria-labelledby="home-tab">
                  <!-- tabel berkas LS -->
                    <table id="table_kontrak_ls" class="table table-bordered table-sm">
                      <thead>
                      <tr>
                        <th>Nomor Kuitansi</th>
                        <th>Tanggal Kuitansi</th>
                        <th>Uraian Realisasi</th>
                        <th>Jumlah</th>
                        <th>Cara Tarik</th>
                        <th>Kontraktual</th>
                        <th>Nomor/Tgl SPM</th>
                        <th>Nomor/Tgl SP2D</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kontrak_ls as $ls):?>
                          <tr>
                            <td><?=$ls['nomor_kuitansi']?></td>
                            <td><?=date('d M Y', $ls['epoch_kuitansi'])?></td>
                            <td><?=$ls['uraian_realisasi']?></td>
                            <td class="text-right"><?=number_format($ls['jumlah_realisasi_bruto'])?></td>
                            <td class="text-center"><?=strtoupper($ls['cara_tarik'])?></td>
                            <td class="text-center">
                              <?= ($ls['is_kontraktual'] ? '<span class="badge badge-pill badge-info">KONTRAK</span>' : '<span class="badge badge-pill badge-light">BUKAN</span>') ?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($ls['nomor_spm'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                                <span class="font-weight-bold"><?=$ls['nomor_spm']?></span> <br> <?=date('d M Y', $ls['epoch_spm'])?>
                              <?php endif;?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($ls['nomor_sp2d'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                              <span class="font-weight-bold"><?=$ls['nomor_sp2d']?></span> <br> <?=date('d M Y', $ls['epoch_sp2d'])?>
                              <?php endif;?>
                            </td>
                            <td>
                              <!-- aksi -->
                              <button class="badge badge-primary" id="edit_button" onclick="edit_data(<?=$ls['id']?>)">Edit</button>
                              <button class="badge badge-danger" id="delete_button">Delete</button>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <script type="text/javascript">
                       function edit_data(id)
                        {
                          let xhrdata = new XMLHttpRequest();
                          xhrdata.onreadystatechange = function()
                          {
                            if(this.readyState == 4 && this.status == 200) 
                            {
                              console.log(JSON.parse(xhrdata.responseText));
                              let data_berkas = JSON.parse(xhrdata.responseText);
                              document.getElementById('edit_id_berkas').value = data_berkas['id'];
                              document.getElementById('edit_nomor_kuitansi').value = data_berkas['nomor_kuitansi'];
                              document.getElementById('edit_tanggal_kuitansi').value = new Date(data_berkas['epoch_kuitansi']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_uraian_realisasi').value = data_berkas['uraian_realisasi'];
                              document.getElementById('edit_penerima').value = data_berkas['penerima'];
                              document.getElementById('edit_kegiatan').value = data_berkas['kegiatan'];
                              document.getElementById('edit_kro').value = data_berkas['kro'];
                              document.getElementById('edit_ro').value = data_berkas['ro'];
                              document.getElementById('edit_komponen').value = data_berkas['komponen'];
                              document.getElementById('edit_subkomponen').value = data_berkas['subkomponen'];
                              document.getElementById('edit_akun').value = data_berkas['akun'];
                              document.getElementById('edit_sumber').value = data_berkas['sumber'];
                              document.getElementById('edit_jumlah_realisasi').value = data_berkas['jumlah_realisasi_bruto'];
                              document.getElementById('edit_nomor_spm').value = data_berkas['nomor_spm'];
                              document.getElementById('edit_nomor_sp2d').value = data_berkas['nomor_sp2d'];
                              document.getElementById('edit_tanggal_spm').value = new Date(data_berkas['epoch_spm']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_tanggal_sp2d').value = new Date(data_berkas['epoch_sp2d']*1000).toISOString().substring(0,10);

                           

                              if(data_berkas['is_kontraktual'])
                              {
                                document.getElementById('is_kontraktual_true').checked = true;
                                document.getElementById('is_kontraktual_false').checked = false;
                              }
                              else
                              {
                                document.getElementById('is_kontraktual_true').checked = false;
                                document.getElementById('is_kontraktual_false').checked = true;
                              }
                            }
                          }
                          xhrdata.open("GET", "<?=base_url('index.php/monitoring/load_berkas_ls/')?>"+id, true);
                          xhrdata.send();
                          
                        }
                    </script>

                </div>
                <div class="tab-pane fade" id="up" role="tabpanel" aria-labelledby="profile-tab">
                   <!-- tabel berkas UP -->
                    <table id="table_kontrak_up" class="table table-bordered table-sm">
                      <thead>
                      <tr>
                        <th>Nomor Kuitansi</th>
                        <th>Tanggal Kuitansi</th>
                        <th>Uraian Realisasi</th>
                        <th>Jumlah bruto</th>
                        <th>PPn</th>
                        <th>PPh</th>
                        <th>Cara Tarik</th>
                        <th>Kontraktual</th>
                        <th>Nomor/Tgl SPM</th>
                        <th>Nomor/Tgl SP2D</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kontrak_up as $up):?>
                          <tr>
                            <td><?=$up['nomor_kuitansi']?></td>
                            <td><?=date('d M Y', $up['epoch_kuitansi'])?></td>
                            <td><?=$up['uraian_realisasi']?></td>
                            <td class="text-right"><?=number_format($up['jumlah_realisasi_bruto'])?></td>
                            <td class="text-right"><?=number_format($up['jumlah_ppn'])?></td>
                            <td class="text-right"><?=number_format($up['jumlah_pph'])?></td>
                            <td class="text-center"><?=strtoupper($up['cara_tarik'])?></td>
                            <td class="text-center">
                              <?= ($up['is_kontraktual'] ? '<span class="badge badge-pill badge-info">KONTRAK</span>' : '<span class="badge badge-pill badge-light">BUKAN</span>') ?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($up['nomor_spm'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                                <span class="font-weight-bold"><?=$up['nomor_spm']?></span> <br> <?=date('d M Y', $up['epoch_spm'])?>
                              <?php endif;?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($up['nomor_sp2d'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                              <span class="font-weight-bold"><?=$up['nomor_sp2d']?></span> <br> <?=date('d M Y', $up['epoch_sp2d'])?>
                              <?php endif;?>
                            </td>
                            <td>
                              <!-- aksi -->
                              <button class="badge badge-primary" id="edit_button" onclick="edit_data_up(<?=$up['id']?>)">Edit</button>
                              <button class="badge badge-danger" id="delete_button">Delete</button>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <script type="text/javascript">
                       function edit_data_up(id)
                        {
                          let xhrdataup = new XMLHttpRequest();
                          xhrdataup.onreadystatechange = function()
                          {
                            if(this.readyState == 4 && this.status == 200) 
                            {
                              console.log(JSON.parse(xhrdataup.responseText));
                              let data_berkas = JSON.parse(xhrdataup.responseText);
                              document.getElementById('edit_id_berkas_up').value = data_berkas['id'];
                              document.getElementById('edit_nomor_kuitansi_up').value = data_berkas['nomor_kuitansi'];
                              document.getElementById('edit_tanggal_kuitansi_up').value = new Date(data_berkas['epoch_kuitansi']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_uraian_realisasi_up').value = data_berkas['uraian_realisasi'];
                              document.getElementById('edit_penerima_up').value = data_berkas['penerima'];
                              document.getElementById('edit_kegiatan_up').value = data_berkas['kegiatan'];
                              document.getElementById('edit_kro_up').value = data_berkas['kro'];
                              document.getElementById('edit_ro_up').value = data_berkas['ro'];
                              document.getElementById('edit_komponen_up').value = data_berkas['komponen'];
                              document.getElementById('edit_subkomponen_up').value = data_berkas['subkomponen'];
                              document.getElementById('edit_akun_up').value = data_berkas['akun'];
                              document.getElementById('edit_sumber_up').value = data_berkas['sumber'];
                              document.getElementById('edit_jumlah_realisasi_up').value = data_berkas['jumlah_realisasi_bruto'];
                              document.getElementById('edit_jumlah_ppn_up').value = data_berkas['jumlah_ppn'];
                              document.getElementById('edit_jumlah_pph_up').value = data_berkas['jumlah_pph'];
                              document.getElementById('edit_nomor_spm_up').value = data_berkas['nomor_spm'];
                              document.getElementById('edit_nomor_sp2d_up').value = data_berkas['nomor_sp2d'];
                              document.getElementById('edit_tanggal_spm_up').value = new Date(data_berkas['epoch_spm']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_tanggal_sp2d_up').value = new Date(data_berkas['epoch_sp2d']*1000).toISOString().substring(0,10);

                           

                              if(data_berkas['is_kontraktual'])
                              {
                                document.getElementById('is_kontraktual_true_up').checked = true;
                                document.getElementById('is_kontraktual_false_up').checked = false;
                              }
                              else
                              {
                                document.getElementById('is_kontraktual_true_up').checked = false;
                                document.getElementById('is_kontraktual_false_up').checked = true;
                              }
                            }
                          }
                          xhrdataup.open("GET", "<?=base_url('index.php/monitoring/load_berkas_up/')?>"+id, true);
                          xhrdataup.send();
                          
                        }
                    </script>
                </div>
                <div class="tab-pane fade" id="tup" role="tabpanel" aria-labelledby="contact-tab">
                  <!-- tabel berkas TUP -->
                    <table id="table_kontrak_tup" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>Nomor Kuitansi</th>
                        <th>Tanggal Kuitansi</th>
                        <th>Uraian Realisasi</th>
                        <th>Jumlah bruto</th>
                        <th>PPn</th>
                        <th>PPh</th>
                        <th>Cara Tarik</th>
                        <th>Kontraktual</th>
                        <th>Nomor/Tgl SPM</th>
                        <th>Nomor/Tgl SP2D</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kontrak_tup as $tup):?>
                          <tr>
                            <td><?=$tup['nomor_kuitansi']?></td>
                            <td><?=date('d M Y', $tup['epoch_kuitansi'])?></td>
                            <td><?=$tup['uraian_realisasi']?></td>
                            <td class="text-right"><?=number_format($tup['jumlah_realisasi_bruto'])?></td>
                            <td class="text-right"><?=number_format($tup['jumlah_ppn'])?></td>
                            <td class="text-right"><?=number_format($tup['jumlah_pph'])?></td>
                            <td class="text-center"><?=strtoupper($tup['cara_tarik'])?></td>
                            <td class="text-center">
                              <?= ($tup['is_kontraktual'] ? '<span class="badge badge-pill badge-info">KONTRAK</span>' : '<span class="badge badge-pill badge-light">BUKAN</span>') ?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($tup['nomor_spm'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                                <span class="font-weight-bold"><?=$tup['nomor_spm']?></span> <br> <?=date('d M Y', $tup['epoch_spm'])?>
                              <?php endif;?>
                            </td>
                            <td class="text-right">
                              <?php if(empty($tup['nomor_sp2d'])):?>
                                <span class="badge badge-pill badge-warning">BELUM ADA</span>
                              <?php else:?>
                              <span class="font-weight-bold"><?=$tup['nomor_sp2d']?></span> <br> <?=date('d M Y', $tup['epoch_sp2d'])?>
                              <?php endif;?>
                            </td>
                            <td>
                              <!-- aksi -->
                              <button class="badge badge-primary" id="edit_button" onclick="edit_data_tup(<?=$tup['id']?>)">Edit</button>
                              <button class="badge badge-danger" id="delete_button">Delete</button>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                    <script type="text/javascript">
                       function edit_data_tup(id)
                        {
                          let xhrdatatup = new XMLHttpRequest();
                          xhrdatatup.onreadystatechange = function()
                          {
                            if(this.readyState == 4 && this.status == 200) 
                            {
                              console.log(JSON.parse(xhrdatatup.responseText));
                              let data_berkas = JSON.parse(xhrdatatup.responseText);
                              document.getElementById('edit_id_berkas_tup').value = data_berkas['id'];
                              document.getElementById('edit_nomor_kuitansi_tup').value = data_berkas['nomor_kuitansi'];
                              document.getElementById('edit_tanggal_kuitansi_tup').value = new Date(data_berkas['epoch_kuitansi']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_uraian_realisasi_tup').value = data_berkas['uraian_realisasi'];
                              document.getElementById('edit_penerima_tup').value = data_berkas['penerima'];
                              document.getElementById('edit_kegiatan_tup').value = data_berkas['kegiatan'];
                              document.getElementById('edit_kro_tup').value = data_berkas['kro'];
                              document.getElementById('edit_ro_tup').value = data_berkas['ro'];
                              document.getElementById('edit_komponen_tup').value = data_berkas['komponen'];
                              document.getElementById('edit_subkomponen_tup').value = data_berkas['subkomponen'];
                              document.getElementById('edit_akun_tup').value = data_berkas['akun'];
                              document.getElementById('edit_sumber_tup').value = data_berkas['sumber'];
                              document.getElementById('edit_jumlah_realisasi_tup').value = data_berkas['jumlah_realisasi_bruto'];
                              document.getElementById('edit_jumlah_ppn_tup').value = data_berkas['jumlah_ppn'];
                              document.getElementById('edit_jumlah_pph_tup').value = data_berkas['jumlah_pph'];
                              document.getElementById('edit_nomor_spm_tup').value = data_berkas['nomor_spm'];
                              document.getElementById('edit_nomor_sp2d_tup').value = data_berkas['nomor_sp2d'];
                              document.getElementById('edit_tanggal_spm_tup').value = new Date(data_berkas['epoch_spm']*1000).toISOString().substring(0,10);
                              document.getElementById('edit_tanggal_sp2d_tup').value = new Date(data_berkas['epoch_sp2d']*1000).toISOString().substring(0,10);

                           

                              if(data_berkas['is_kontraktual'])
                              {
                                document.getElementById('is_kontraktual_true_tup').checked = true;
                                document.getElementById('is_kontraktual_false_tup').checked = false;
                              }
                              else
                              {
                                document.getElementById('is_kontraktual_true_tup').checked = false;
                                document.getElementById('is_kontraktual_false_tup').checked = true;
                              }
                            }
                          }
                          xhrdatatup.open("GET", "<?=base_url('index.php/monitoring/load_berkas_tup/')?>"+id, true);
                          xhrdatatup.send();
                          
                        }
                    </script>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- modal edit data ls -->
    <div class="modal fade bd-example-modal-lg" id="modal_edit_data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Berkas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/monitoring/simpan_perubahan_ls')?>">
            <input type="hidden" name="edit_id_berkas" id="edit_id_berkas" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Kuitansi</label>
                      <input type="text" class="form-control" id="edit_nomor_kuitansi" name="edit_nomor_kuitansi">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Kuitansi</label>
                      <input type="date" class="form-control" id="edit_tanggal_kuitansi" name="edit_tanggal_kuitansi"> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Uraian realisasi</label>
                      <textarea class="form-control" id="edit_uraian_realisasi" name="edit_uraian_realisasi"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Penerima</label>
                      <textarea class="form-control" id="edit_penerima" name="edit_penerima"></textarea>
                    </div> 
                  </div>
                </div>
                <div class="form-group">
                  <label>Jumlah realisasi</label>
                  <input type="number" class="form-control" id="edit_jumlah_realisasi" name="edit_jumlah_realisasi">
                </div>

                <div class="form-group">
                  <label>Cara Tarik</label>
                  <select class="form-control" name="edit_cara_tarik" id="edit_cara_tarik" name="edit_cara_tarik">
                    <option value="ls">LS</option>
                    <option value="up">UP</option>
                    <option value="tup">TUP</option>
                  </select>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_kontraktual" id="is_kontraktual_true" value="t" checked>
                  <label class="form-check-label" for="exampleRadios1">Kontraktual</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="is_kontraktual" id="is_kontraktual_false" value="f" checked>
                  <label class="form-check-label" for="exampleRadios1">Non Kontraktual  </label>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor SPM</label>
                      <input type="text" class="form-control" id="edit_nomor_spm" name="edit_nomor_spm">
                    </div>
                    <div class="form-group">
                      <label>Nomor SP2D</label>
                      <input type="text" class="form-control" id="edit_nomor_sp2d" name="edit_nomor_sp2d">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal SPM</label>
                      <input type="date" class="form-control" id="edit_tanggal_spm" name="edit_tanggal_spm">
                    </div>
                    <div class="form-group">
                      <label>Tanggal SP2D</label>
                      <input type="date" class="form-control" id="edit_tanggal_sp2d" name="edit_tanggal_sp2d">
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                 <div class="form-group">
                    <label>Kegiatan</label>
                    <input type="text" class="form-control" id="edit_kegiatan" name="edit_kegiatan" readonly>
                  </div>
                  <div class="form-group">
                    <label>KRO</label>
                    <input type="text" class="form-control" id="edit_kro" name="edit_kro" readonly>
                  </div>
                  <div class="form-group">
                    <label>RO</label>
                    <input type="text" class="form-control" id="edit_ro" name="edit_ro" readonly>
                  </div>
                  <div class="form-group">
                    <label>Komponen</label>
                    <input type="text" class="form-control" id="edit_komponen" name="edit_komponen" readonly>
                  </div>
                  <div class="form-group">
                    <label>Subkomponen</label>
                    <input type="text" class="form-control" id="edit_subkomponen" name="edit_subkomponen" readonly>
                  </div>
                  <div class="form-group">
                    <label>Akun</label>
                    <input type="text" class="form-control" id="edit_akun" name="edit_akun" readonly>
                  </div>
                  <div class="form-group">
                    <label>Sumber</label>
                    <select class="form-control" name="edit_sumber" id="edit_sumber" name="edit_sumber" readonly>
                    <option value="rm">RM</option>
                    <option value="pnp">PNP</option>
                  </select>
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

    <!-- modal edit data up -->
    <div class="modal fade bd-example-modal-lg" id="modal_edit_data_up" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Berkas UP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/monitoring/simpan_perubahan_up')?>">
            <input type="hidden" name="edit_id_berkas_up" id="edit_id_berkas_up" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Kuitansi</label>
                      <input type="text" class="form-control" id="edit_nomor_kuitansi_up" name="edit_nomor_kuitansi_up">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Kuitansi</label>
                      <input type="date" class="form-control" id="edit_tanggal_kuitansi_up" name="edit_tanggal_kuitansi_up"> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Uraian realisasi</label>
                      <textarea class="form-control" id="edit_uraian_realisasi_up" name="edit_uraian_realisasi_up"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Penerima</label>
                      <textarea class="form-control" id="edit_penerima_up" name="edit_penerima_up"></textarea>
                    </div> 
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jumlah realisasi bruto</label>
                      <input type="number" class="form-control" id="edit_jumlah_realisasi_up" name="edit_jumlah_realisasi_up">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Jumlah PPn</label>
                      <input type="number" class="form-control" id="edit_jumlah_ppn_up" name="edit_jumlah_ppn_up">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Jumlah PPh</label>
                      <input type="number" class="form-control" id="edit_jumlah_pph_up" name="edit_jumlah_pph_up">
                    </div>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Cara Tarik</label>
                      <select class="form-control" name="edit_cara_tarik_up" id="edit_cara_tarik_up">
                        <option value="ls">LS</option>
                        <option value="up">UP</option>
                        <option value="tup">TUP</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Jenis Pengadaan</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="is_kontraktual_up" id="is_kontraktual_true_up" value="t" checked>
                      <label class="form-check-label" for="exampleRadios1">Kontraktual</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="is_kontraktual_up" id="is_kontraktual_false_up" value="f" checked>
                      <label class="form-check-label" for="exampleRadios1">Non Kontraktual  </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor SPM</label>
                      <input type="text" class="form-control" id="edit_nomor_spm_up" name="edit_nomor_spm_up">
                    </div>
                    <div class="form-group">
                      <label>Nomor SP2D</label>
                      <input type="text" class="form-control" id="edit_nomor_sp2d_up" name="edit_nomor_sp2d_up">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal SPM</label>
                      <input type="date" class="form-control" id="edit_tanggal_spm_up" name="edit_tanggal_spm_up">
                    </div>
                    <div class="form-group">
                      <label>Tanggal SP2D</label>
                      <input type="date" class="form-control" id="edit_tanggal_sp2d_up" name="edit_tanggal_sp2d_up">
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                 <div class="form-group">
                    <label>Kegiatan</label>
                    <input type="text" class="form-control" id="edit_kegiatan_up" name="edit_kegiatan_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>KRO</label>
                    <input type="text" class="form-control" id="edit_kro_up" name="edit_kro_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>RO</label>
                    <input type="text" class="form-control" id="edit_ro_up" name="edit_ro_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>Komponen</label>
                    <input type="text" class="form-control" id="edit_komponen_up" name="edit_komponen_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>Subkomponen</label>
                    <input type="text" class="form-control" id="edit_subkomponen_up" name="edit_subkomponen_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>Akun</label>
                    <input type="text" class="form-control" id="edit_akun_up" name="edit_akun_up" readonly>
                  </div>
                  <div class="form-group">
                    <label>Sumber</label>
                    <select class="form-control" name="edit_sumber_up" id="edit_sumber_up" name="edit_sumber_up" readonly>
                    <option value="rm">RM</option>
                    <option value="pnp">PNP</option>
                  </select>
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

    <!-- modal edit data tup -->
    <div class="modal fade bd-example-modal-lg" id="modal_edit_data_tup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Berkas TUP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="<?=base_url('index.php/monitoring/simpan_perubahan_tup')?>">
            <input type="hidden" name="edit_id_berkas_tup" id="edit_id_berkas_tup" readonly>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Kuitansi</label>
                      <input type="text" class="form-control" id="edit_nomor_kuitansi_tup" name="edit_nomor_kuitansi_tup">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Kuitansi</label>
                      <input type="date" class="form-control" id="edit_tanggal_kuitansi_tup" name="edit_tanggal_kuitansi_tup"> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Uraian realisasi</label>
                      <textarea class="form-control" id="edit_uraian_realisasi_tup" name="edit_uraian_realisasi_tup"></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Penerima</label>
                      <textarea class="form-control" id="edit_penerima_tup" name="edit_penerima_tup"></textarea>
                    </div> 
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jumlah realisasi bruto</label>
                      <input type="number" class="form-control" id="edit_jumlah_realisasi_tup" name="edit_jumlah_realisasi_tup">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Jumlah PPn</label>
                      <input type="number" class="form-control" id="edit_jumlah_ppn_tup" name="edit_jumlah_ppn_tup">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Jumlah PPh</label>
                      <input type="number" class="form-control" id="edit_jumlah_pph_tup" name="edit_jumlah_pph_tup">
                    </div>
                  </div>
                </div>

                
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Cara Tarik</label>
                      <select class="form-control" name="edit_cara_tarik_tup" id="edit_cara_tarik_tup">
                        <option value="ls">LS</option>
                        <option value="up">UP</option>
                        <option value="tup">TUP</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>Jenis Pengadaan</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="is_kontraktual_tup" id="is_kontraktual_true_tup" value="t" checked>
                      <label class="form-check-label" for="exampleRadios1">Kontraktual</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="is_kontraktual_tup" id="is_kontraktual_false_tup" value="f" checked>
                      <label class="form-check-label" for="exampleRadios1">Non Kontraktual  </label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor SPM</label>
                      <input type="text" class="form-control" id="edit_nomor_spm_tup" name="edit_nomor_spm_tup">
                    </div>
                    <div class="form-group">
                      <label>Nomor SP2D</label>
                      <input type="text" class="form-control" id="edit_nomor_sp2d_tup" name="edit_nomor_sp2d_tup">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal SPM</label>
                      <input type="date" class="form-control" id="edit_tanggal_spm_tup" name="edit_tanggal_spm_tup">
                    </div>
                    <div class="form-group">
                      <label>Tanggal SP2D</label>
                      <input type="date" class="form-control" id="edit_tanggal_sp2d_tup" name="edit_tanggal_sp2d_tup">
                    </div>
                  </div>
                </div>

              </div>
              <div class="col-md-6">
                 <div class="form-group">
                    <label>Kegiatan</label>
                    <input type="text" class="form-control" id="edit_kegiatan_tup" name="edit_kegiatan_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>KRO</label>
                    <input type="text" class="form-control" id="edit_kro_tup" name="edit_kro_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>RO</label>
                    <input type="text" class="form-control" id="edit_ro_tup" name="edit_ro_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>Komponen</label>
                    <input type="text" class="form-control" id="edit_komponen_tup" name="edit_komponen_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>Subkomponen</label>
                    <input type="text" class="form-control" id="edit_subkomponen_tup" name="edit_subkomponen_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>Akun</label>
                    <input type="text" class="form-control" id="edit_akun_tup" name="edit_akun_tup" readonly>
                  </div>
                  <div class="form-group">
                    <label>Sumber</label>
                    <select class="form-control" name="edit_sumber_tup" id="edit_sumber_tup" readonly>
                    <option value="rm">RM</option>
                    <option value="pnp">PNP</option>
                  </select>
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

