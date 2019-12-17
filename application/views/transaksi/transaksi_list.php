<style type="text/css">
.lebar{
  width: 80%;
}
@media only screen and (max-width: 600px) {
  .lebar{
    width: auto;
 
  }
}

</style>

 <div class='row'>
  <div class='col-md-9' id="lay_ut">
    <?= $this->session->userdata('message') ?>
    <div class='white-box'>
      <center> 
        <h2 class='box-title m-b-0'><?= identitas('nama_perusahaan') ?></h2>
        <p class='text-muted m-b-30'><?= identitas('alamat_lengkap') ?> No Telp .<?= identitas('telp') ?>, Fax <?= identitas('fax') ?>.</p>
        <hr />
        <h2 class='box-title m-b-0' style="text-align: left;"><b>NAMA KASIR : <?= strtoupper($this->session->nama) ?></b></h2>
      </center>
      <div class='table-responsive'> 
        <br /><br />
        <script type="text/javascript">
          $(function(){
           $('#cari_meja').load('<?= base_url('transaksi/data_meja'); ?>');
         }); 
       </script>
       <div class="form-group">
        <label for="int" class='control-label col-md-3'><b>Pilih Meja</b></label>
        <div class='col-md-9'>
          <select class="form-control" name="meja" id="cari_meja">

          </select>
        </div>
      </div>  
      <br />

      <script type="text/javascript">
        $(function(){
         $('#cetak_struk').hide();
         $('#total_harga').hide();
         $('#status').hide();
         if($('#jum_bayar').val() == ''){
           $('.tampil_struk').hide();
         }else{
          $('.tampil_struk').show(); 
        }

      }); 
    </script>

    <div id="notifikasi"></div>
    <div id="status"></div>
    <table class="table" id="datatables">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Transaksi</th>
          <th>Nama Menu</th>
          <th>Nama Meja</th>
          <th>Jumlah Porsi</th>
          <th>Harga Satuan</th>
          <th>Penerima</th>
          <th>Diskon %</th>
          <th>Action</th>
        </tr>
      </thead> 
    </table>

    <div class='tampil_struk'>
     <br /><br /><div align='right'> 
       <button class='btn btn-success' id ='cetak_struk'><i class='fa fa-print'>Pratinjau Struk</i></button>

     </div>
   </div> 

   <div id="total_harga"></div>
   <script type="text/javascript">
    function kosongkan_form(){
      $('#nama_menu').val('');
      $('#jumlah_porsi').val('');
      $('#penerima').val('');
      $('#diskon').val('');
      $('#catatan_trasaksi').val('');  
      $('#nama_meja').val('');
    }


    $(document).ready(function() {
      $('#datatables').hide();
      $('#pencarian_data').hide(); 
      $("#lay_ut").attr('class', 'col-md-12');
      $('#notifikasi').html('<div class="alert alert-warning">silahkan Pilih Meja Aktiv / Status Makanan Bungkus</div>');
      $('#total_harga').load('<?= base_url('transaksi/hitung_transaksi'); ?>');
      $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
        return {
          "iStart": oSettings._iDisplayStart,
          "iEnd": oSettings.fnDisplayEnd(),
          "iLength": oSettings._iDisplayLength,
          "iTotal": oSettings.fnRecordsTotal(),
          "iFilteredTotal": oSettings.fnRecordsDisplay(),
          "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
          "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };

      var datatable_transaksi = $("#datatables").DataTable({
        initComplete: function() {
          var api = this.api();
          $('#datatables input')
          .off('.DT')
          .on('keyup.DT', function(e) {
            if (e.keyCode == 13) {
              api.search(this.value).draw();
            }
          });
        },
        oLanguage: {
          sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "transaksi/json", "type": "POST","data": function(data){
                        // Read values
                        var nama_meja = $('#cari_meja').val();
                        data.id_meja = nama_meja;                         
                      } 
                    },
                    columns: [
                    {
                      "data": "id_ransaksi",
                      "orderable": false
                    },{"data": "kode_transaksi"},{"data": "nama_menu"},{"data": "nama_meja"},{"data": "jumlah_porsi"},{"data": "harga_jual",render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp.' ) },{"data": "penerima"},{"data": "diskon",render: $.fn.dataTable.render.number( ',', '.', 0, '' )},
                    {
                      "data" : "action",
                      "orderable": false,
                      "className" : "text-center"
                    }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                      var info = this.fnPagingInfo();
                      var page = info.iPage;
                      var length = info.iLength;
                      var index = page * length + (iDisplayIndex + 1);
                      $('td:eq(0)', row).html(index);
                    }
                  });

      $('#simpan_transaksi').submit(function(e){
        e.preventDefault();

        var nama_menu= $('#nama_menu').val();
        var jumlah_porsi=$('#jumlah_porsi').val();
        var penerima=$('#penerima').val();
        var catatan_trasaksi= $('#catatan_trasaksi').val();  
        var nama_meja=$('#nama_meja').val();

        if(nama_menu == ''){
          swal('Data Menu Tidak Boleh Kosong');
        }else if(jumlah_porsi == ''){
         swal('Jumlah Porsi Tidak Boleh Kosong');
       }else if(penerima == ''){
         swal('Data Penerima Tidak Boleh Kosong');
       }else{          

        /*menyimpan hasil transaksi ke data table*/

                            // var aksi = $(this).attr('action'); 
                            // var id_menu = $('input[name="id_meja"]').val(this.val());
                            // var id_meja = $('input[name="id_meja"]').val(this.val());
                            var data_insert  = $(this).serialize();
                            var cr_meja = $('.data_meja').val(); 
                            $.ajax({
                              url   : '<?= base_url('transaksi/tambah_data') ?>',
                              type  : 'POST',
                              data  : data_insert,
                              chace :false,
                              success:function(data){ 
                                $('#total_harga').show();
                                kosongkan_form();
                                //$('#status').hide();
                                $(this).find('option:selected');
                                $('#notifikasi').fadeIn().html('<div class="alert alert-success"><i class="fa fa-check"></i>Data Pesanan Berhasil Di Tambahkan.</div>'); 
                                $.post('<?= base_url('transaksi/hitung_transaksi') ?>',{ id_meja : cr_meja },function(data){
                                 $('#total_harga').html(data);
                               },); 

                                $.post('<?= base_url('transaksi/hapus_detail') ?>',{ id_meja : cr_meja },function(data){
                                 $('#status').html('<div class="alert alert-warning">Pembayaran Sebelumnya Di Pending</div>');
                               },);

                                datatable_transaksi.ajax.reload();
                                $(window).scrollTop(0);
                                //$('.tampil_struk').hide();


                              },
                              error:function(data,status,xhr){

                              }   
                            });  
                          }
                        });

      $('#cari_meja').change(function(){
       $('#total_harga').show();
       $('#status').hide(); 
       var dcar_meja = $('#cari_meja').val(); 
       $('#datatables').show();
       if(dcar_meja == ''){
         $('#datatables').hide();
         $('#notifikasi').html('<div class="alert alert-warning">silahkan Pilih Meja Aktiv / Status Makanan Bungkus</div>');
         $('#pencarian_data').hide();  
         swal('Silahkan Masukan Pilihan Meja Atau Makananan Yang ingin di bungkus.');
         $("#lay_ut").attr('class', 'col-md-12');
       }else{
         $("#lay_ut").attr('class', 'col-md-8');
         $('#pencarian_data').show();
       }

       $('#notifikasi').html('<div class="alert alert-info">Pesanan....</div>');
       $(this).find('option:selected');

       datatable_transaksi.ajax.reload();
       datatable_transaksi.draw();
                     // $('#cari_meja').load('<?= base_url('transaksi/data_meja'); ?>');
                     var id_meja = $(this).val();
                     $.post('<?= base_url('transaksi/hitung_transaksi') ?>',{ id_meja : id_meja},function(data){
                       $('#total_harga').html(data);
                     },);
                     /*cari datil meja*/
                     $.ajax({
                      url : '<?= base_url('transaksi/dapatkan_meja') ?>',
                      data: 'id_meja='+id_meja,
                      type :'post',
                      dataType: 'json',
                      chace:false,
                      success:function(data){
                        //$('.tampil_struk').hide();
                        $('.form_meja').html('<div class="alert alert-success"><i class="fa fa-check"></i>Meja /Status Pemesanan :<center> <h3>'+data.nama_meja+'</h3></center><br /><input type="hidden" class="data_meja" name="id_meja" value="'+data.id_meja+'"></div>');
                        $('#notifikasi').html('<div class="alert alert-success"><center>Status Pemesanan <h3>'+data.nama_meja+'</h3></center></div>');

                        /*cek status meja bayar*/

                        $.ajax({
                          url : '<?= base_url('transaksi/cek_detail_meja') ?>',
                          data: 'id_meja='+id_meja,
                          type :'post',
                          dataType: 'json',
                          chace:false,
                          success:function(data){
                           if(data.paid == 'Y'){
                            //$('.tampil_struk').hide();
                            $('#status').html('<div class="alert alert-success"><i class="fa fa-check"></i>Trasaksi Sudah di bayar kan</div>');
                          }else if(data.paid == 'N'){ 
                            $('#status').html('<div class="alert alert-danger"><i class="fa fa-share fa-spin"></i>Trasaksi Belum di bayar kan / Sedang Menunggu pembayaran...</div>'); 
                          }
                        },error:function(data){
                          swal('error Status meja tidak respon ??');
                        }

                      });


                      },
                      error:function(data){
                       alert('something when wrong'); 
                     }    
                   });          
                     /*mejaa*/     
                   });      

    });

function hapus_transaksi(n,id_meja){
  swal({
    title: 'Konfirmasi Hapus',
    text: 'Apakah Anda Yakin Untuk Menghapus Data Ini?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonClass: 'btn-danger',
    confirmButtonText: 'Ya',
    closeOnClickOutside:true,
  },
  function(){
    $.ajax({
      url   : '<?= base_url('transaksi/hapus') ?>',
      type  : 'POST',
      data  : 'id_transaksi='+n,
      chace :  false,

      success:function(data){ 
       //$('.tampil_struk').hide();
       $(this).find('option:selected');
       $.post('<?= base_url('transaksi/hitung_transaksi') ?>',{ id_meja : id_meja},function(data){
         $('#total_harga').html(data);
       },);

       $('#datatables').DataTable().ajax.reload(); 
       $('#notifikasi').fadeIn().html('<div class="alert alert-success"><i class="fa fa-check"></i>Data menu makanan Berhasil Di Hapus</div>');


     },
     error:function(data,status,xhr){
       alert('tidak bisa Menghapus data silahkan coba beberapa saat lagi');
     }   
   }); 
  });
}

</script>
</div>
</div>
</div>
<div class='col-md-3' id="pencarian_data">
  <div class='white-box'>
    <form id="simpan_transaksi" method="post" class='form-horizontal form-bordered'>
      <div class='form-body'>   

        <div class="form-group">
         <div class='col-md-12'>
          <div class="form_meja"></div>
        </div>
      </div>
      <div class="form-group">
        <div class='col-md-12'>
          <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Id Menu" value="" />
          <div class="id_menu"></div>
        </div>
      </div>
      <div class="form-group">
       <div class='col-md-12'>
        <input type="number" class="form-control" name="jumlah_porsi" id="jumlah_porsi" placeholder="Jumlah Porsi" value=""/>
      </div>
    </div>

    <div class="form-group">
     <div class='col-md-12'>
      <input type="number" class="form-control" name="diskon" id="diskon" placeholder="Diskon ..." value=""/>
    </div>
  </div>


  <div class="form-group">
   <div class='col-md-12'>
    <input type="text" class="form-control" name="penerima" id="penerima" placeholder="Penerima" value=""/>
  </div>
</div>

<div class="form-group"> 
  <div class='col-md-12'>
    <textarea class="form-control" rows="3" name="catatan_trasaksi" id="catatan_trasaksi" placeholder="Catatan Trasaksi"></textarea>
  </div>
</div>



<div class='form-actions'>
  <div class='row'>
    <div class='col-md-12'>
      <div class='row'>
        <div class='col-md-offset-3 col-md-9'>
         <button type="submit" id="simpan_transaksi" class="btn btn-info"><i class='fa fa-check'></i>Simpan Transaksi</button> 
         <br /><br />
         <buttton id="cancel" class="btn btn-danger"><i class='fa fa-share'></i>Cancel</button>  
         </div>
       </div>
     </div>
   </div>
 </div>
</form>
</div>
</div>
</div>


<script type="text/javascript">
 $(function(){
   $('#cancel').click(function(){
    $('#notifikasi').html('<div class="alert alert-danger">Transaksi Di Pilih Berhasil Di Batalkan</div>');
    kosongkan_form(); 

  }) 
   
   /*end bagian pembayaran terakhir*/
   $('#nama_menu').click(function(){
    $('#modal_barang').modal('show');  
    $('#pilih_menu').click(function(){
      var id_menu = $(this).val();  
      $.ajax({
       url   : '<?= base_url('transaksi/dapatkan_data') ?>',
       type  : 'POST',
       data  : 'id_menu='+id_menu,
       dataType : 'json',
       chace :false,
       success:function(data){ 
        $('#nama_menu').val(data.nama_menu);
        $('.id_menu').html('<input type="hidden" name="id_menu" value="'+data.id_menu+'">'); 
        $('#modal_barang').modal('hide');   
      },
      error:function(data,status,xhr){
       alert(status); 
     }   
   }); 
    }); 
  });  
 })
 /*meja*/
</script>  

 

<!-- /.modal menu -->
<div id="modal_barang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog lebar">
    <div class="modal-content">
      <div class="modal-body" style="overflow: scroll;"> 
        <table class="table" id="datatables2">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Menu</th>
              <th>Harga Jual</th>
              <th>Jenis</th>
              <th>Kode Menu</th>
              <th>Ketersedian</th>
              <th>Tanggal Create</th>
              <th>Action</th>
            </tr>
          </thead> 
        </table>
      </div> 
    </div> 
  </div> 
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };

    var t = $("#datatables2").dataTable({
      initComplete: function() {
        var api = this.api();
        $('#datatables input')
        .off('.DT')
        .on('keyup.DT', function(e) {
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
      },
      oLanguage: {
        sProcessing: "loading..."
      },
      processing: true,
      serverSide: true,
      ajax: {"url": "menu_resto/json_transaksi", "type": "POST"},
      columns: [
      {
        "data": "id_menu",
        "orderable": false
      },{"data": "nama_menu"},{"data": "harga_jual",render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp.' ) },{"data":"nama_kategori"},{"data": "kode_menu"},{"data": "ketersedian"},{"data": "tanggal_create"},
      {
        "data" : "action",
        "orderable": false,
        "className" : "text-center"
      }
      ],
      order: [[0, 'desc']],
      rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        var index = page * length + (iDisplayIndex + 1);
        $('td:eq(0)', row).html(index);
      }
    });
  });

  function hapus(n){
    swal({
      title: 'Konfirmasi Hapus',
      text: 'Apakah Anda Yakin Untuk Menghapus Data Ini?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn-danger',
      confirmButtonText: 'Ya',
      closeOnConfirm: false
    },
    function(){
     swal('Hapus Data', 'Data Berhasil Di Hapus', 'success'); 
     window.location.href='<?= base_url('menu_resto/hapus/') ?>'+n;
   });
  }
  /*hitung realtime*/



  /*terbilang*/


  function terbilang(bilangan) {

   bilangan    = String(bilangan);
   var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
   var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
   var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

   var panjang_bilangan = bilangan.length;

   /* pengujian panjang bilangan */
   if (panjang_bilangan > 15) {
     kaLimat = "Diluar Batas";
     return kaLimat;
   }

   /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
   for (i = 1; i <= panjang_bilangan; i++) {
     angka[i] = bilangan.substr(-(i),1);
   }

   i = 1;
   j = 0;
   kaLimat = "";


   /* mulai proses iterasi terhadap array angka */
   while (i <= panjang_bilangan) {

     subkaLimat = "";
     kata1 = "";
     kata2 = "";
     kata3 = "";

     /* untuk Ratusan */
     if (angka[i+2] != "0") {
       if (angka[i+2] == "1") {
         kata1 = "Seratus";
       } else {
         kata1 = kata[angka[i+2]] + " Ratus";
       }
     }

     /* untuk Puluhan atau Belasan */
     if (angka[i+1] != "0") {
       if (angka[i+1] == "1") {
         if (angka[i] == "0") {
           kata2 = "Sepuluh";
         } else if (angka[i] == "1") {
           kata2 = "Sebelas";
         } else {
           kata2 = kata[angka[i]] + " Belas";
         }
       } else {
         kata2 = kata[angka[i+1]] + " Puluh";
       }
     }

     /* untuk Satuan */
     if (angka[i] != "0") {
       if (angka[i+1] != "1") {
         kata3 = kata[angka[i]];
       }
     }

     /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
     if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
       subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
     }

     /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
     kaLimat = subkaLimat + kaLimat;
     i = i + 3;
     j = j + 1;

   }

   /* mengganti Satu Ribu jadi Seribu jika diperlukan */
   if ((angka[5] == "0") && (angka[6] == "0")) {
     kaLimat = kaLimat.replace("Satu Ribu","Seribu");
   }

   return kaLimat + "Rupiah";
 }

 function HapusKoma(num)
 {
  return (num.replace(/,/g,''));  
}


function currency(value, separator) {
      if (typeof value == "undefined") return "0";
      if (typeof separator == "undefined" || !separator) separator = ",";
   
      return value.toString()
                  .replace(/[^\d]+/g, "")
                  .replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
}
 
window.addEventListener('keyup', function(e) {
      var el = e.target;
      if (el.classList.contains('currency')) {
            el.value = currency(el.value, el.getAttribute('data-separator'));
      }
  false});


function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function sum() {
  var txtFirstNumberValue = document.getElementById('total_kes').value;
  var txtSecondNumberValue = document.getElementById('jum_bayar').value;

  var nilia1 = HapusKoma(txtFirstNumberValue);
  var nilia2 = HapusKoma(txtSecondNumberValue);

  var result = parseFloat(nilia2) - parseFloat(nilia1);
  if (!isNaN(result)) {
   document.getElementById('kembalian').value = formatNumber(result,'.');
         //document.getElementById('terbilang').value = terbilang(result);

       }
     } 


     $(function(){ 
      $('#cetak_struk').click(function(){ 
       var id_meja    = $('#id_meja').val();
       var jum_bayar = $('#jum_bayar').val();
       $.ajax({
         url : '<?= base_url('transaksi/preview_struk') ?>',
         data: 'id_meja='+id_meja+'&jum_bayar='+jum_bayar,
         type :'post', 
         chace:false,
         success:function(data){ 
           $('.tampil_mode_struk').html(data);
           $('#struk_tampil').modal('show');
         },error:function(data){
           swal('error Status meja tidak respon ??');
         } 
       }); 

     });
    });

     function bayar_(n){ 

      swal({
        title: 'Konfirmasi Bayar',
        text: 'Transaksi akan di bayarkan ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Ya',
        closeOnConfirm: false
      },
      function(){

        var jum_bayar = HapusKoma($('#jum_bayar').val());
        var total_kes = $('#total_kes').val(); 
        var id_meja = $('#id_meja').val(); 


        if(jum_bayar == ''){
         swal('Jumlah Bayar Tidak Boleh Kosong');
       }else if(total_kes ==''){
         swal('Jumlah Bayar Tidak Boleh Kosong');
       }else if(id_meja ==''){
         swal('Jumlah Bayar Tidak Boleh Kosong');
       }else{ 
        $.ajax({
          url : '<?= base_url('transaksi/simpan_transaksi') ?>',
          type :'POST',
          data :'jumlah_bayar='+jum_bayar+'&total_kes='+total_kes+'&id_meja='+id_meja,
          chace:false,
          success:function(data){ 
            swal('Data Transaksi Berhasil Di Simpan');
            $('#bayar_').hide();
            $('#cetak_struk').show();
            $('#batalkan').html('<button class="btn btn-warning" onclik="return batalkan_bayar('+id_meja+')"><i class="fa fa-check"></i>Batalkan Transaksi</button>'); 
            $('#selesai_bayar').html('<br /><button class="btn btn-info" onclick="return selesai_bayar('+id_meja+')"><i class="fa fa-check"></i>Selesaikan  Transaksi</button>'); 
            $('#jum_bayar').attr('readonly',true); 

            $.ajax({
              url : '<?= base_url('transaksi/cek_detail_meja') ?>',
              data: 'id_meja='+id_meja,
              type :'post',
              dataType: 'json',
              chace:false,
              success:function(data){
               if(data.paid == 'Y'){
                $('#status').show();
                $('.tampil_struk').show();
                $('#hapus_item').hide();
                $('#status').html('<div class="alert alert-success"><i class="fa fa-check"></i>Trasaksi Sudah di bayar kan</div>');
              }else if(data.paid == 'N'){ 
                $('#status').show();
                $('#status').html('<div class="alert alert-danger"><i class="fa fa-share fa-spin"></i>Trasaksi Belum di bayar kan / Sedang Menunggu pembayaran...</div>'); 
              }
            },error:function(data){
              swal('error Status meja tidak respon ??');
            }

          });


          },error:function(){
            swal('Server Tidak Bisa Merespon.');
          } 
        }); 
      } 
    });

    } 

  </script>

  <!-- modal pratinjau -->
  <div id="struk_tampil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 80%">
      <div class="modal-content">
        <div class="modal-body"> 
         <div class="tampil_mode_struk"></div>
       </div> 
     </div> 
   </div> 
 </div>

 <!-- fungsi untuk save data transaksi ke db dan di tampilkan ke table transaksi -->
 <script type="text/javascript">

   function batalkan_bayar(n){

     swal({
      title: 'Batalkan Pembayaran ?',
      text: 'Jika Pembayaran di batalkan transaksi tidak akan di prose serta data transaksi akan hilang di list table , anda yakin ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn-danger',
      confirmButtonText: 'Ya',
      closeOnConfirm: false
    },
    function(){
      swal('Proses Berhasil');
      $.ajax({
        url : '<?= base_url('transaksi/batalkan_transaksi') ?>',
        type :'POST',
        data :'id_meja='+n,
        chace:false,
        success:function(data){ 
         swal('Data Transaksi Di Batalkan');
         $('#datatables').DataTable().ajax.reload();  
         
       },error:function(data){
        swal('Server Not respon 403');   
      }
    });
      
    });
   }  

   function selesai_bayar(n){

     swal({
      title: 'Selesaikan Pembayaran',
      text: 'Jika Pembayaran di selesaikan maka transaksi selesai data transaksi tidak di tampilkan lagi, anda yakin ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'btn-danger',
      confirmButtonText: 'Ya',
      closeOnConfirm: false
    },
    function(){
      swal('Proses Berhasil');
      $.ajax({
        url : '<?= base_url('transaksi/selesaikan_transaksi') ?>',
        type :'POST',
        data :'id_meja='+n,
        chace:false,
        success:function(data){ 
          $('#notifikasi').fadeIn().html('<div class="alert alert-success"><i class="fa fa-check"></i>Silahkan  Berbelanja kembali .</div>'); 
          $('#total_harga').hide();
          $('#status').hide();
          $('#jum_bayar').val('');
          $('#kembalian').val('');
          $('#batalkan').hide();
          $('#cetak_struk').hide();
          $('#selesai_bayar').hide(); 
          swal('Data Transaksi Selesaikan Terima Kasih Telah Berbelanja : )');
          $('#datatables').DataTable().ajax.reload();  
          
        },error:function(data){
          swal('Server Not respon 403');   
        }


      });
    });

   } 
   
   
 </script>