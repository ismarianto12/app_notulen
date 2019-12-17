<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
        <div id="notifikasi"></div>
         <div class='table-responsive'>  
             <div class="example">
                <h5 class="box-title m-t-30">Laporan Pendapatan Transaksi</h5>
                <p class="text-muted m-b-20">Pilih Kolom pertama<code>#date-range</code> Sampai Dengan Kolom kedua.</p>
                <div class="input-daterange input-group" id="date-range">
                    <input type="text" class="form-control" name="start" id='dari' /> <span class="input-group-addon bg-info b-0 text-white">Sampai dengan .</span>
                    <input type="text" class="form-control" name="end" id="sampai" /> </div>
                   <br />
                 <button class="btn btn-info" id="cari">Cari data.</button>
                 <br /><br /><br />
                </div>
                 <div id="notifikasi"></div>
                <table class="table" id="datatables">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Durasi Transaksio</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>  
                    <tfoot><tr><td colspan="4"><div align='right'><b>Total</b></div></td><td><div id="jumlah_transaksi"></div></td></tr><tr>
                           <td colspan="4"><div align='right'>Item</div></td><td><div id="item"></div></td></tr>
                         </tfoot>
                </table>

                <div id="keterangan"></div>

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

                        var table_laporan = $("#datatables").DataTable({
                            "bSort":false, 
                            "dom": 'Bfrtip',

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
                            ajax: {"url": "<?= base_url('laporan_keuntungan/json_data') ?>", "type": "POST","data": function(data){

                               var dari = $('#dari').val();
                               var sampai = $('#sampai').val();
                          //dapatkan data :
                          data.dari = dari;    
                          data.sampai = sampai;     

                            }  
                         },

                            buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                            ],

                            columns: [
                            {
                                "data": ++no,
                             },{"data": "nama_menu"},{"data": "kode_menu"},{"data": "harga_jual",render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )},{"data": "jumlah_porsi"},{"data": "subtotal",render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )}   
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

                     $('#cari').click(function(){
                      var dari = $('#dari').val();
                      var sampai = $('#sampai').val();
                      if(dari != '' &&  sampai !=''){  

                          document.title = 'Data Laporan Dari'+dari+' Sampai Dengan '+sampai;
                          $.ajax({
                             url : '<?= base_url('Laporan_keuntungan/laba_rugi') ?>',
                             data :'dari='+dari+'&sampai='+sampai,
                             type:'post',
                             chace:false, 
                             dataType:'json',
                              success:function(data){
                                $('#jumlah_transaksi').html(data.jumlah_total);
                                $('#item').html(data.item);
 
                             },error:function(data){

                             }
                          });
                         $('#notifikasi').html('<div class="alert alert-info">Data Laporan Dar'+dari+' Sampai Dengan '+sampai+'</div>');
                           table_laporan.draw();
                          table_laporan.ajax.reload();  
                          }else{
                            swal('Perhatian !!','Data Tidak Boleh kosong');
                          }
                       }); 
                    });

 
                </script>
            </div>
        </div>
    </div>
</div>