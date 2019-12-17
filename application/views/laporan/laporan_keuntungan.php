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
					<hr />
					<table class="table" id="datatables">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Menu</th>
								<th>Kode Menu</th>
								<th>Harga Jual</th>
								<th>Jumlah porsi</th> 
								<th>Tanggal Transaksi</th>  
								<th>Subtotal</th> 
							</tr>
						</thead>  
						  <tfoot>
						  	<tr> 
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		<th></th>
						  		
						  	</tr>

						  </tfoot>
					</table> 
					<div id="keterangan"></div>

					<script type="text/javascript">

						function formatDate(date) {
							var d = new Date(date),
							month = '' + (d.getMonth() + 1),
							day = '' + d.getDate(),
							year = d.getFullYear();

							if (month.length < 2) month = '0' + month;
							if (day.length < 2) day = '0' + day;

							return [year, month, day].join('-');
						}


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

								"footerCallback": function ( row, data, start, end, display ) {
									var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
            	return typeof i === 'string' ?
            	i.replace(/[\$,]/g, '')*1 :
            	typeof i === 'number' ?
            	i : 0;
            };

            // Total over all pages
            total = api
            .column( 6 )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            }, 0 );

 			total_item = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            }, 0 );
            

            // Total over this page
            pageTotal = api
            .column( 6, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
            	return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $( api.column( 6 ).footer() ).html(
            	'Rp.'+pageTotal +' ( Rp.'+ total +' / Total Bersih Penjualan)'
            	); 
            $(api.column( 4 ).footer() ).html(total_item+' /Total Porsi Terjual'); 
        },

       //  "bSort":false,  
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
                  dom: 'Bfrtip',
                  buttons: [
                  { extend: 'copyHtml5', footer: true },
                  { extend: 'excelHtml5', footer: true },
                  { extend: 'csvHtml5', footer: true },
                  { extend: 'pdfHtml5', footer: true },
                  { extend: 'print', footer: true }
                  
                  ], 
                  columns: [

                  {"data": "id_ransaksi",},{"data": "nama_menu"},{"data": "kode_menu"},{"data": "harga_jual",render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )},{"data": "jumlah_porsi"},{"data":"t_transaksi"},{"data":"subtotal",render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp' )}  
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
                                //var dari_s = text.replace('/',da);
                                var f_dari =  formatDate(dari);
                                var f_sampai =formatDate(sampai);
                                $('#jumlah_transaksi').html(data.jumlah_total);
                                $('#item').html(data.item);

                            },error:function(data){

                            }
                        });
									$('#notifikasi').html('<div class="alert alert-info">Data Laporan Dar'+dari+' Sampai Dengan '+sampai+'</div>');
									table_laporan.draw();
									table_laporan.ajax.reload();

									var total_pendapatan = table_laporan.rows('subtotal').count();

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