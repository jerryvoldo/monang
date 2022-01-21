<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"  onload="getAkunDetail()">
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
            <div class="card card-default">
              <div class="card-header"><div class="card-title">Pilih Akun</div></div>
              <div class="card-body">
                <div class="form-group">
                  <select class="form-control" name="id_akun" id="id_akun" onchange="getAkunDetail()">
                    <option>--Pilih akun--</option>
                    <?php foreach($load_akun_pok as $akun_pok):?>
                      <option value="<?=$akun_pok['id']?>"><?=$akun_pok['kegiatan']?>-<?=$akun_pok['kro']?>-<?=$akun_pok['ro']?>-<?=$akun_pok['komponen']?>-<?=$akun_pok['subkomponen']?>-<?=$akun_pok['akun']?> - <?=$akun_pok['uraian']?></option>
                    <?php endforeach;?>
                  </select>
                  <small>Pilih akun terlebih dahulu sebelum melakukan Input Pengajuan TUP</small>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card card-default">
                  <div class="card-header"><div class="card-title">Detail Akun yang dipilih</div></div>
                  <div class="card-body">
                    <!-- tampil pagu, realisasi, sisa anggaran -->
                    <table class="table table-sm table-bordered mb-2">
                      <thead class="bg-secondary text-white">
                        <tr>
                          <th>Pagu</th>
                          <th>Realisasi</th>
                          <th>Sisa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td align="right" id="pagu_pok">0</td>
                          <td align="right" id="realisasi_pagu">0</td>
                          <td align="right" id="sisa_pagu">0</td>
                        </tr>
                      </tbody>
                    </table>

                    <table class="table table-sm table-bordered">
                      <thead class="bg-secondary text-white">
                      <tr>
                        <th>Total Aju TUP</th>
                        <th>Sisa Aju TUP</th>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                        <td align="right" id="total_aju_tup">0</td>
                        <td align="right" id="sisa_aju_tup">0</td>
                      </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card card-default">
                  <div class="card-header"><div class="card-title">Input Pengajuan TUP</div></div>
                  <div class="card-body">
                    <!-- detail akun yang dipilih -->
                    <label>Detail akun yang dipilih</label>
                    <div class="btn-toolbar  mb-3" role="toolbar" aria-label="Toolbar with button groups">
                      <div class="btn-group mr-2" role="group" aria-label="First group">
                        <button type="button" id="kode_kegiatan" class="btn btn-info">Kegiatan</button>
                        <button type="button" id="kode_kro" class="btn btn-info">KRO</button>
                        <button type="button" id="kode_ro" class="btn btn-info">RO</button>
                        <button type="button" id="kode_komponen" class="btn btn-info">Komponen</button>
                        <button type="button" id="kode_subkomponen" class="btn btn-info">Subkomponen</button>
                        <button type="button" id="kode_akun" class="btn btn-info">Akun</button>
                        <button type="button" id="sumber" class="btn btn-warning">Sumber</button>
                      </div>
                    </div>



                    <!-- hidden input form -->
                    <input type="hidden" name="tup_kode_kegiatan" id="tup_kode_kegiatan">
                    <input type="hidden" name="tup_kode_kro" id="tup_kode_kro">
                    <input type="hidden" name="tup_kode_ro" id="tup_kode_ro">
                    <input type="hidden" name="tup_kode_komponen" id="tup_kode_komponen">
                    <input type="hidden" name="tup_kode_subkomponen" id="tup_kode_subkomponen">
                    <input type="hidden" name="tup_kode_akun" id="tup_kode_akun">
                    <input type="hidden" name="tup_uraian" id="tup_uraian">
                    <input type="hidden" name="tup_sumber" id="tup_sumber">
                    <div class="form-group">
                      <label>Jumlah TUP diajukan</label>
                      <input class="form-control" type="number" name="jumlah_pengajuan_tup" id="jumlah_pengajuan_tup">
                    </div>
                    <div class="form-group">
                      <label>Urutan TUP</label>
                      <select class="form-control" name="urutan_tup" id="urutan_tup">
                        <option value="7777">NIHIL</option>
                        <?php for($i=1; $i<50; $i++):?>
                          <option value="<?=$i?>"><?=$i?></option>
                        <?php endfor;?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="mr-4">POKSI</label>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="poksi" id="poksi" value="kmgi">
                        <label class="form-check-label">KMGI</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="poksi" id="poksi" value="fasdar">
                        <label class="form-check-label">FASDAR</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="poksi" id="poksi" value="exim">
                        <label class="form-check-label">EXIM</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="poksi" id="poksi" value="top">
                        <label class="form-check-label">TOP</label>
                      </div>
                    </div>
                    <button class="btn btn-primary float-right" type="button" onclick="simpanPengajuanTup()">Simpan</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
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

<script type="text/javascript">
  function getAkunDetail()
  {
    let xhr = new XMLHttpRequest();
    let id_akun = document.getElementById('id_akun')[document.getElementById('id_akun').selectedIndex].value;
    xhr.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        // console.log(JSON.parse(this.responseText));
        document.getElementById('kode_kegiatan').innerHTML = document.getElementById('tup_kode_kegiatan').value = JSON.parse(this.responseText)['kegiatan'];
        document.getElementById('kode_kro').innerHTML = document.getElementById('tup_kode_kro').value = JSON.parse(this.responseText)['kro'];
        document.getElementById('kode_ro').innerHTML = document.getElementById('tup_kode_ro').value = JSON.parse(this.responseText)['ro'];
        document.getElementById('kode_komponen').innerHTML = document.getElementById('tup_kode_komponen').value = JSON.parse(this.responseText)['komponen'];
        document.getElementById('kode_subkomponen').innerHTML = document.getElementById('tup_kode_subkomponen').value = JSON.parse(this.responseText)['subkomponen'];
        document.getElementById('kode_akun').innerHTML =  JSON.parse(this.responseText)['akun'] + ' - ' + JSON.parse(this.responseText)['uraian'];
        document.getElementById('sumber').innerHTML = JSON.parse(this.responseText)['sumber'].toUpperCase();
        document.getElementById('tup_kode_akun').value = JSON.parse(this.responseText)['akun'];
        document.getElementById('tup_uraian').value = JSON.parse(this.responseText)['uraian'];
        document.getElementById('tup_sumber').value = JSON.parse(this.responseText)['sumber'];

        let xhr_tup = new XMLHttpRequest();
        xhr_tup.onreadystatechange = function() {
          if(this.readyState == 4 && this.status == 200) {
            console.log(JSON.parse(this.responseText));
          document.getElementById('pagu_pok').innerHTML = new Intl.NumberFormat(['ban', 'id']).format (null === JSON.parse(this.responseText)['pagu'] ? 0 : JSON.parse(this.responseText)['pagu']);
          document.getElementById('total_aju_tup').innerHTML = new Intl.NumberFormat(['ban', 'id']).format (null === JSON.parse(this.responseText)['total_pengajuan_tup'] ? 0 : JSON.parse(this.responseText)['total_pengajuan_tup']);
          document.getElementById('realisasi_pagu').innerHTML = new Intl.NumberFormat(['ban', 'id']).format(JSON.parse(this.responseText)['total_realisasi']);
          document.getElementById('sisa_aju_tup').innerHTML = new Intl.NumberFormat(['ban', 'id']).format (
                                                                null === JSON.parse(this.responseText)['total_pengajuan_tup'] ? 
                                                                0 
                                                                : (null === JSON.parse(this.responseText)['total_realisasi'] ? 
                                                                  JSON.parse(this.responseText)['total_pengajuan_tup'] : parseInt(JSON.parse(this.responseText)['total_pengajuan_tup']) - parseInt(JSON.parse(this.responseText)['total_realisasi'])) 
                                                                );
          document.getElementById('sisa_pagu').innerHTML = new Intl.NumberFormat(['ban', 'id']).format (null === JSON.parse(this.responseText)['pagu'] ? 0 : JSON.parse(this.responseText)['sisa_pagu']);
        }
        };
        xhr_tup.open("GET", '<?=base_url('index.php/posisi/json_show_pengajuan_tup/')?>'+id_akun, true);
        xhr_tup.send();
      }
    };
    xhr.open("GET", '<?=base_url('index.php/posisi/json_show_akun_pok_item/')?>'+id_akun, true);
    xhr.send();
  }

  function simpanPengajuanTup()
  {
    let tup_kode_kegiatan = document.getElementById('tup_kode_kegiatan').value;
    let tup_kode_kro = document.getElementById('tup_kode_kro').value;
    let tup_kode_ro = document.getElementById('tup_kode_ro').value;
    let tup_kode_komponen = document.getElementById('tup_kode_komponen').value;
    let tup_kode_subkomponen = document.getElementById('tup_kode_subkomponen').value;
    let tup_kode_akun = document.getElementById('tup_kode_akun').value;
    let tup_uraian = document.getElementById('tup_uraian').value;
    let tup_sumber = document.getElementById('tup_sumber').value;
    let jumlah_pengajuan_tup = document.getElementById('jumlah_pengajuan_tup').value;
    let urutan_tup = document.getElementById('urutan_tup')[document.getElementById('urutan_tup').selectedIndex].value;
    let poksi =  document.querySelector('input[name="poksi"]:checked').value;

    let xhr_simpan_tup = new XMLHttpRequest();
    xhr_simpan_tup.open("POST", '<?=base_url('index.php/posisi/simpan_pengajuan_tup')?>', true);
    xhr_simpan_tup.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr_simpan_tup.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
          getAkunDetail();
          clearInputField();
      }
    };
    xhr_simpan_tup.send(JSON.stringify({tup_kode_kegiatan:tup_kode_kegiatan, tup_kode_kro:tup_kode_kro, tup_kode_ro:tup_kode_ro, tup_kode_komponen:tup_kode_komponen, tup_kode_subkomponen:tup_kode_subkomponen, tup_kode_akun:tup_kode_akun, tup_uraian:tup_uraian, tup_sumber:tup_sumber,jumlah_pengajuan_tup:jumlah_pengajuan_tup, urutan_tup:urutan_tup, poksi:poksi }));
  }

  function clearInputField()
  {
    document.getElementById('tup_kode_kegiatan').value = '';
    document.getElementById('tup_kode_kro').value = '';
    document.getElementById('tup_kode_ro').value = '';
    document.getElementById('tup_kode_komponen').value = '';
    document.getElementById('tup_kode_subkomponen').value = '';
    document.getElementById('tup_uraian').value = '';
    document.getElementById('tup_sumber').value = '';
    document.getElementById('jumlah_pengajuan_tup').value = '';
    document.getElementById('urutan_tup')[0].value;
  }
</script>