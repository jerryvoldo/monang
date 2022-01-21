<!-- jQuery -->
<script src="<?=base_url('assets')?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets')?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url('assets')?>/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?=base_url('assets')?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?=base_url('assets')?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?=base_url('assets')?>/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=base_url('assets')?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?=base_url('assets')?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?=base_url('assets')?>/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets')?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url('assets')?>/dist/js/demo.js"></script>
<!-- Dropzone JS -->
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

<script src="<?=base_url('assets')?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets')?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
  let table_master_pok_kro = '';
  let table_master_pok_ro = '';
  let table_master_pok_komponen = '';
  let table_master_pok_subkomponen = '';
  let table_master_pok_akun = '';
  let table_posisi_up = '';

  $(function () {

    $("#table_posisi").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", 
                    {
                      extend: 'pdfHtml5',
                      orientation: 'landscape',
                      pageSize: 'LEGAL'
                    }, 
                    "print", "colvis"],
    }).buttons().container().appendTo('#table_posisi_wrapper .col-md-6:eq(0)');

    $("#table_pok").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", 
                    {
                      extend: 'pdfHtml5',
                      orientation: 'landscape',
                      pageSize: 'LEGAL'
                    }, 
                    "print", "colvis"],
    }).buttons().container().appendTo('#table_pok_wrapper .col-md-6:eq(0)');

    $("#table_ls").DataTable({
                                "responsive": true, 
                                "lengthChange": false, 
                                "autoWidth": false,
                                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                                "columnDefs": [
                                                {"width": "20%", "targets": 2},
                                                {"width": "7%", "targets": 9}
                                              ]
                            })
                  .buttons()
                  .container()
                  .appendTo('#table_ls_wrapper .col-md-6:eq(0)');

      $('#table_ls tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data').modal();
      });

    $("#table_up").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columnDefs": [
                      {"width": "20%", "targets": 2},
                      {"width": "3%", "targets": 6},
                      {"width": "7%", "targets": 11},
                    ]
    }).buttons().container().appendTo('#table_up_wrapper .col-md-6:eq(0)');

    $('#table_up tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data_up').modal();
      });

    
    $("#table_tup").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columnDefs": [
                      {"width": "20%", "targets": 2},
                      {"width": "3%", "targets": 6},
                      {"width": "7%", "targets": 11}
                    ]
    }).buttons().container().appendTo('#table_tup_wrapper .col-md-6:eq(0)');

    $('#table_tup tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data_tup').modal();
      });






    // table monitoring kontrak
    $("#table_kontrak_ls").DataTable({
                                "responsive": true, 
                                "lengthChange": false, 
                                "autoWidth": false,
                                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                            })
                  .buttons()
                  .container()
                  .appendTo('#table_kontrak_ls_wrapper .col-md-6:eq(0)');

      $('#table_kontrak_ls tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data').modal();
      });

    $("#table_kontrak_up").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columnDefs": [
                      {"width": "20%", "targets": 2},
                      {"width": "3%", "targets": 6},
                      {"width": "7%", "targets": 11},
                    ]
    }).buttons().container().appendTo('#table_kontrak_up_wrapper .col-md-6:eq(0)');

    $('#table_kontrak_up tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data_up').modal();
      });

    
    $("#table_kontrak_tup").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columnDefs": [
                      {"width": "20%", "targets": 2},
                      {"width": "3%", "targets": 6},
                      {"width": "7%", "targets": 11}
                    ]
    }).buttons().container().appendTo('#table_kontrak_tup_wrapper .col-md-6:eq(0)');

    $('#table_kontrak_tup tbody').on('click', '#edit_button', function() {
        $('#modal_edit_data_tup').modal();
      });





    $("#table_realisasi_ls").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_realisasi_ls_wrapper .col-md-6:eq(0)');

    $("#table_realisasi_tup").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_realisasi_tup_wrapper .col-md-6:eq(0)');

    $("#table_realisasi_up").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_realisasi_up_wrapper .col-md-6:eq(0)');

    $("#table_master_pok_kegiatan").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_master_pok_kegiatan_wrapper .col-md-6:eq(0)');

    table_master_pok_kro = $("#table_master_pok_kro").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "columns" : [
                        {data : 'kegiatan'},
                        {data : 'kro'},
                        {data : 'uraian'},
                        {
                          data : 'volume',
                          render : $.fn.dataTable.render.number('.', ',')
                        },
                        {data : 'satuan_volume'},
                        {data : 'aksi'}
                      ]
        });

    table_master_pok_ro = $("#table_master_pok_ro").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "columns" : [
                        {data : 'kegiatan'},
                        {data : 'kro'},
                        {data : 'ro'},
                        {data : 'uraian'},
                        {
                          data : 'volume',
                        },
                        {data : 'satuan_volume'},
                        {data : 'aksi'}
                      ]
        });

    table_master_pok_komponen = $("#table_master_pok_komponen").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "columns" : [
                        {data : 'kegiatan'},
                        {data : 'kro'},
                        {data : 'ro'},
                        {data : 'komponen'},
                        {data : 'uraian'},
                        {data : 'aksi'}
                      ]
        });

    table_master_pok_subkomponen = $("#table_master_pok_subkomponen").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
          "columns" : [
                        {data : 'kegiatan'},
                        {data : 'kro'},
                        {data : 'ro'},
                        {data : 'komponen'},
                        {data : 'subkomponen'},
                        {data : 'uraian'},
                        {data : 'sumber'}
                      ]
        });

    table_master_pok_akun = $("#table_master_pok_akun").DataTable({
                "responsive": true, 
                "lengthChange": false, 
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "columns" : [
                              {data : 'akun'},
                              {data : 'uraian'},
                              {
                                data : 'jumlah',
                                render : function(data) {
                                  if(null === data) {
                                    return 0
                                  }
                                  else
                                  {
                                    return new Intl.NumberFormat(['ban', 'id']).format(data)
                                  }
                                } 
                              },
                              { 
                                data : 'sumber',
                                render : function(data) {
                                  return data.toUpperCase();
                                }
                              },
                              {
                                data : 'id',
                                render : function(data) {
                                  return '<button class="badge badge-pill badge-warning" onclick="edit_data_master_akun('+data+')" data-toggle="modal" data-target="#modal_edit_akun">Edit</button>'
                                }
                              },
                            ]
          });

    $("#table_realisasi_sas").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_realisasi_sas_wrapper .col-md-6:eq(0)');

    table_posisi_up = $("#table_posisi_up").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "columns" : [
                        {
                          data : 'epoch_deposit',
                          render : function(data) {
                            var a = new Date(data * 1000);
                            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                            var year = a.getFullYear();
                            var month = months[a.getMonth()];
                            var date = a.getDate();
                            return date+' '+month+' '+year; 
                          }
                        },
                        {
                          data : 'deposit_rm',
                          render : function(data) {
                                  if(null === data) {
                                    return 0
                                  }
                                  else
                                  {
                                    return new Intl.NumberFormat(['ban', 'id']).format(data)
                                  }
                                }
                        },
                        {
                          data : 'deposit_pnp',
                          render : function(data) {
                                  if(null === data) {
                                    return 0
                                  }
                                  else
                                  {
                                    return new Intl.NumberFormat(['ban', 'id']).format(data)
                                  }
                                }
                        },
                        {
                          data : 'jumlah_deposit',
                          render : function(data) {
                                  if(null === data) {
                                    return 0
                                  }
                                  else
                                  {
                                    return new Intl.NumberFormat(['ban', 'id']).format(data)
                                  }
                                }
                        }
                      ]
    });

    reload_pengajuan_up();

  });


  
</script>


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>

<!-- ajax KRO -->
<script type="text/javascript">
  function simpanDataKRO()
    {
      let kode_kegiatan = document.getElementById('kode_kegiatan')[document.getElementById('kode_kegiatan').selectedIndex].value;
      let kode_kro = document.getElementById('kode_kro').value;
      let uraian_kro = document.getElementById('uraian_kro').value;
      let volume_kro = document.getElementById('volume_kro').value;
      let satuan_volume_kro = document.getElementById('satuan_volume_kro').value;
      let xhr_kro = new XMLHttpRequest();
      xhr_kro.open("POST", '<?=base_url('index.php/pok/simpan_master_kro')?>');
      xhr_kro.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr_kro.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          clear_input_data_kro();
          load_master_kro();
        }
      };
      xhr_kro.send(JSON.stringify({kode_kegiatan: kode_kegiatan, kode_kro: kode_kro, uraian_kro: uraian_kro, volume_kro: volume_kro, satuan_volume_kro: satuan_volume_kro}));
    }

    function clear_input_data_kro()
    {
      document.getElementById('kode_kegiatan')[0].value;
      document.getElementById('kode_kro').value = '';
      document.getElementById('uraian_kro').value = '';
      document.getElementById('volume_kro').value = '';
      document.getElementById('satuan_volume_kro').value = '';
    }

    function load_master_kro()
    {
      let xhr_load_kro = new XMLHttpRequest();
      xhr_load_kro.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_kro.responseText));
            table_master_pok_kro.clear().rows.add(JSON.parse(xhr_load_kro.responseText)).draw();
          }
      };
      xhr_load_kro.open("GET", "<?=base_url('index.php/pok/json_show_kro')?>", true);
      xhr_load_kro.send();
    }
</script>

<!-- ajax RO -->
<script type="text/javascript">
  function simpanDataRO()
    {
      let kode_kegiatan = document.getElementById('kode_kegiatan').value;
      let kode_kro = document.getElementById('kode_kro')[document.getElementById('kode_kro').selectedIndex].value;
      let kode_ro = document.getElementById('kode_ro').value;
      let uraian_ro = document.getElementById('uraian_ro').value;
      let volume_ro = document.getElementById('volume_ro').value;
      let satuan_volume_ro = document.getElementById('satuan_volume_ro').value;
      let xhr_ro = new XMLHttpRequest();
      xhr_ro.open("POST", '<?=base_url('index.php/pok/simpan_master_ro')?>');
      xhr_ro.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr_ro.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          clear_input_data_ro();
          load_master_ro();
        }
      };
      xhr_ro.send(JSON.stringify({kode_kegiatan: kode_kegiatan, kode_kro: kode_kro, kode_ro: kode_ro,  uraian_ro: uraian_ro, volume_ro: volume_ro, satuan_volume_ro: satuan_volume_ro}));
    }

    function clear_input_data_ro()
    {
      document.getElementById('kode_kro')[0].value;
      document.getElementById('kode_ro').value = '';
      document.getElementById('uraian_ro').value = '';
      document.getElementById('volume_ro').value = '';
      document.getElementById('satuan_volume_ro').value = '';
    }

    function load_master_ro()
    {
      let xhr_load_ro = new XMLHttpRequest();
      xhr_load_ro.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_ro.responseText));
            table_master_pok_ro.clear().rows.add(JSON.parse(xhr_load_ro.responseText)).draw();
          }
      };
      xhr_load_ro.open("GET", "<?=base_url('index.php/pok/json_show_ro')?>", true);
      xhr_load_ro.send();
    }
</script>

<!-- ajax Komponen -->
<script type="text/javascript">
  function simpanDataKomponen()
    {
      let kode_kegiatan = document.getElementById('kode_kegiatan').value;
      let kode_kro = document.getElementById('kode_kro').value;
      let kode_ro = document.getElementById('kode_ro').value;
      let kode_komponen = document.getElementById('kode_komponen').value;
      let uraian_komponen = document.getElementById('uraian_komponen').value;
      let xhr_komponen = new XMLHttpRequest();
      xhr_komponen.open("POST", '<?=base_url('index.php/pok/simpan_master_komponen')?>');
      xhr_komponen.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr_komponen.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          clear_input_data_komponen();
          load_master_komponen();
        }
      };
      xhr_komponen.send(JSON.stringify({kode_kegiatan: kode_kegiatan, kode_kro: kode_kro, kode_ro: kode_ro, kode_komponen: kode_komponen, uraian_komponen: uraian_komponen}));
    }

    function clear_input_data_komponen()
    {
      document.getElementById('kode_kro').value = '';
      document.getElementById('kode_ro').value = '';
      document.getElementById('kode_komponen').value = '';
      document.getElementById('uraian_komponen').value = '';
    }

    function load_master_komponen()
    {
      let xhr_load_komponen = new XMLHttpRequest();
      xhr_load_komponen.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_komponen.responseText));
            table_master_pok_komponen.clear().rows.add(JSON.parse(xhr_load_komponen.responseText)).draw();
          }
      };
      xhr_load_komponen.open("GET", "<?=base_url('index.php/pok/json_show_komponen')?>", true);
      xhr_load_komponen.send();
    }
</script>

<!-- ajax SubKomponen -->
<script type="text/javascript">
  function simpanDataSubKomponen()
    {
      let kode_kegiatan = document.getElementById('kode_kegiatan').value;
      let kode_kro = document.getElementById('kode_kro').value;
      let kode_ro = document.getElementById('kode_ro').value;
      let kode_komponen = document.getElementById('kode_komponen').value;
      let kode_subkomponen = document.getElementById('kode_subkomponen').value;
      let uraian_subkomponen = document.getElementById('uraian_subkomponen').value;
      let xhr_subkomponen = new XMLHttpRequest();
      xhr_subkomponen.open("POST", '<?=base_url('index.php/pok/simpan_master_subkomponen')?>');
      xhr_subkomponen.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr_subkomponen.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          clear_input_data_subkomponen();
          load_master_subkomponen();
        }
      };
      xhr_subkomponen.send(JSON.stringify({kode_kegiatan: kode_kegiatan, kode_kro: kode_kro, kode_ro: kode_ro, kode_komponen: kode_komponen, kode_subkomponen: kode_subkomponen, uraian_subkomponen: uraian_subkomponen}));
    }

    function clear_input_data_subkomponen()
    {
      
      document.getElementById('kode_subkomponen').value = '';
      document.getElementById('uraian_subkomponen').value = '';
    }

    function load_master_subkomponen()
    {
      let xhr_load_subkomponen = new XMLHttpRequest();
      xhr_load_subkomponen.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_subkomponen.responseText));
            table_master_pok_subkomponen.clear().rows.add(JSON.parse(xhr_load_subkomponen.responseText)).draw();
          }
      };
      xhr_load_subkomponen.open("GET", "<?=base_url('index.php/pok/json_show_subkomponen')?>", true);
      xhr_load_subkomponen.send();
    }
</script>

<!-- ajax Akun -->
<script type="text/javascript">
  function simpanDataAkun()
    {
      let kode_kegiatan = document.getElementById('kode_kegiatan').value;
      let kode_kro = document.getElementById('kode_kro').value;
      let kode_ro = document.getElementById('kode_ro').value;
      let kode_komponen = document.getElementById('kode_komponen').value;
      let kode_subkomponen = document.getElementById('kode_subkomponen').value;
      let kode_akun = document.getElementById('kode_akun').value;
      let uraian_akun = document.getElementById('uraian_akun').value;
      let pagu_akun = document.getElementById('pagu_akun').value;
      let sumber = document.getElementById('sumber')[document.getElementById('sumber').selectedIndex].value;
      let xhr_akun = new XMLHttpRequest();
      xhr_akun.open("POST", '<?=base_url('index.php/pok/simpan_master_akun')?>');
      xhr_akun.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr_akun.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          clear_input_data_akun();
          getSubkomponen();
        }
      };
      xhr_akun.send(JSON.stringify({kode_kegiatan: kode_kegiatan, kode_kro: kode_kro, kode_ro: kode_ro, kode_komponen: kode_komponen, kode_subkomponen: kode_subkomponen, kode_akun: kode_akun, uraian_akun: uraian_akun, pagu_akun: pagu_akun, sumber: sumber }));
    }

    function clear_input_data_akun()
    {
      document.getElementById('uraian_akun').value = '';
      document.getElementById('pagu_akun').value = '';
    }

    function load_master_akun()
    {
      let xhr_load_akun = new XMLHttpRequest();
      xhr_load_akun.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_akun.responseText));
            table_master_pok_akun.clear().rows.add(JSON.parse(xhr_load_akun.responseText)).draw();
          }
      };
      xhr_load_akun.open("GET", "<?=base_url('index.php/pok/json_show_akun')?>", true);
      xhr_load_akun.send();
    }

    function getSubkomponen()
    {
      let id_subkomponen = document.getElementById('id_subkomponen')[document.getElementById('id_subkomponen').selectedIndex].value;
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
         if(this.readyState == 4 && this.status == 200)
         {
            let data_subkomponen = JSON.parse(xhr.responseText);
            console.log(data_subkomponen);

             // set value of hidden input
                document.getElementById('kode_kegiatan').value = JSON.parse(xhr.responseText)['kegiatan'];
                document.getElementById('kode_kro').value = JSON.parse(xhr.responseText)['kro'];
                document.getElementById('kode_ro').value = JSON.parse(xhr.responseText)['ro'];
                document.getElementById('kode_komponen').value = JSON.parse(xhr.responseText)['komponen'];
                document.getElementById('kode_subkomponen').value = JSON.parse(xhr.responseText)['subkomponen'];

            let xhr2 = new XMLHttpRequest();
            xhr2.onreadystatechange = function() {
              if(this.readyState == 4 && this.status == 200)
              {
                console.log(JSON.parse(xhr2.responseText));
                table_master_pok_akun.clear().rows.add(JSON.parse(xhr2.responseText)).draw();
               
              }
            };
            xhr2.open("GET", "<?=base_url('index.php/pok/show_akun_2/')?>"+data_subkomponen['kegiatan']+'/'+data_subkomponen['kro']+'/'+data_subkomponen['ro']+'/'+data_subkomponen['komponen']+'/'+data_subkomponen['subkomponen']);
            xhr2.send();
         }
      };
      xhr.open("GET", "<?=base_url('index.php/pok/load_subkomponen_item/')?>"+id_subkomponen);
      xhr.send();
    }

    function updateUraianAkun()
    {
      let xhr_bas = new XMLHttpRequest();
      xhr_bas.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
        {
          console.log(JSON.parse(xhr_bas.responseText));
          document.getElementById('uraian_akun').value = JSON.parse(xhr_bas.responseText)['uraian'];
        }
      };
      xhr_bas.open("GET", '<?=base_url('index.php/pok/json_show_bas_item/')?>'+document.getElementById('kode_akun')[document.getElementById('kode_akun').selectedIndex].value, true);
      xhr_bas.send();
    }


    function updateEditUraianAkun()
    {
      let xhr_bas = new XMLHttpRequest();
      xhr_bas.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
        {
          console.log(JSON.parse(xhr_bas.responseText));
          document.getElementById('edit_uraian_akun').value = JSON.parse(xhr_bas.responseText)['uraian'];
        }
      };
      xhr_bas.open("GET", '<?=base_url('index.php/pok/json_show_bas_item/')?>'+document.getElementById('edit_kode_akun')[document.getElementById('edit_kode_akun').selectedIndex].value, true);
      xhr_bas.send();
    }
</script>

<!-- ajax posisi pengajuan UP-->
<script type="text/javascript">
  

  function simpanPengajuanUp()
  {
    let jumlah_pengajuan_up_rm = document.getElementById('jumlah_pengajuan_up_rm').value;
    let jumlah_pengajuan_up_pnp = document.getElementById('jumlah_pengajuan_up_pnp').value;
    let tanggal_deposit = parseInt((new Date(document.getElementById('tanggal_deposit').value).getTime()/1000).toFixed(0));

    let xhr_simpan_up = new XMLHttpRequest();
    xhr_simpan_up.open("POST", '<?=base_url('index.php/posisi/simpan_pengajuan_up')?>', true);
    xhr_simpan_up.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr_simpan_up.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
          reload_pengajuan_up();
          clearInputField();
          
      }
    };
    xhr_simpan_up.send(JSON.stringify({jumlah_pengajuan_up_rm:jumlah_pengajuan_up_rm, jumlah_pengajuan_up_pnp:jumlah_pengajuan_up_pnp, tanggal_deposit:tanggal_deposit}));
  }

  function clearInputField()
  {
    document.getElementById('jumlah_pengajuan_up_rm').value = '0';
    document.getElementById('jumlah_pengajuan_up_rm').value = '0';
    document.getElementById('tanggal_deposit').value = '';
  }

  function reload_pengajuan_up()
    {
      let xhr_load_up = new XMLHttpRequest();
      xhr_load_up.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200)
          {
            console.log(JSON.parse(xhr_load_up.responseText));
            table_posisi_up.clear().rows.add(JSON.parse(xhr_load_up.responseText)).draw();
          }
      };
      xhr_load_up.open("GET", "<?=base_url('index.php/posisi/json_show_pengajuan_up')?>", true);
      xhr_load_up.send();
    }

  function getDateString(unix_epoch)
  {
    var a = new Date(unix_epoch * 1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    return date+' '+month+' '+year;
  }
</script>


</body>
</html>