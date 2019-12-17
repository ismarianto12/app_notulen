<script type="text/javascript">
<?php
$jumla_futsal = $this->Futsall_tr_model->hitung_js();
foreach ($this->Futsall_tr_model->hitung_js()->result_array() as $jumlah_tr):
if ($jumla_futsal->num_rows() > 0) { ?>

// $(function(){ 
// 	$("#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>").timer({
// 		countdown: true,
// 		resume:true,
// duration: '<?=(int)$jumlah_tr['waktu'] ?>m0s',      // This will start the countdown from 3 mins 40 seconds
// callback: function() {  // This will execute after the duration has elapsed
// $("#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>").timer('stop'); 
// $('#waktu_timing').hide();
// $('.tampilkan_timing').html('<button class="btn btn-success" onclick="javascript: return show_pembayaran_<?=$jumlah_tr['id_transaksi'] ?>()">Bayar</button>'); 

// swal({
// title: 'Waktu Habis',
// text: 'Silahkan Cetak Struk Sewa lapangan.',
// type: 'warning',
// showCancelButton: true,
// confirmButtonClass: 'btn-danger',
// confirmButtonText: 'Ya',
// closeOnClickOutside:true,
// },    
// function(){
 
// }); 
// }
// });
// });


function start_timing_<?=$jumlah_tr['id_transaksi'] ?>(n){ 
	$("#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>").timer({
		countdown: true,
		resume:true,
duration: '<?= $jumlah_tr['waktu'] ?>m0s',      // This will start the countdown from 3 mins 40 seconds
callback: function() {  // This will execute after the duration has elapsed
$("#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>").timer('stop'); 
$('#waktu_timing').hide();
$('.tampilkan_timing').html('<button class="btn btn-success" onclick="javascript: return show_pembayaran_<?=$jumlah_tr['id_transaksi'] ?>()">Bayar</button>'); 

swal({
title: 'Waktu Habis',
text: 'Silahkan Cetak Struk Sewa lapangan.',
type: 'warning',
showCancelButton: true,
confirmButtonClass: 'btn-danger',
confirmButtonText: 'Ya',
closeOnClickOutside:true,
},    
function(){
 
}); 
}
});

	var id_transaksi = n; 
	var waktu = $('#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>').val();
	$.ajax({
		url  :'<?=base_url() ?>',
		data : 'id_transaksi='+id_transaksi+'&waktu='+waktu,
		type : 'post',
		success:function(data){

		},error:function(data){
			swall('gagal update waktu');
		}
	});

}

function stop_timing_<?=$jumlah_tr['id_transaksi'] ?>(n){
	$("#sisa_waktu_<?=$jumlah_tr['id_transaksi'] ?>").timer('pause'); 
}

function show_pembayaran_<?= $jumlah_tr['id_transaksi'] ?>(){ 
	$('#modal_timing_<?= $jumlah_tr['id_transaksi'] ?>').modal('show');

}

<?php
}
endforeach; ?>

function HapusKoma(num)
{
	return (num.replace(/,/g,''));  
} 

function formatNumber(num) {
  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}
 
function sum() {


	var id_transaksi = $('#id_transaksi').val();
	var jum_bayar = $('#jum_bayar').val();
	var diskon = $('#diskon').val();

	/*variable notation*/

	var txtFirstNumberValue = document.getElementById('total_kes').value;
	var txtSecondNumberValue = document.getElementById('jum_bayar').value;
	var diskon = document.getElementById('diskon').value;


	var jum_diskon =  txtFirstNumberValue  *  diskon / 100;


	var nilia1 = HapusKoma(txtFirstNumberValue);
	var nilia2 = HapusKoma(txtSecondNumberValue); 
	var result = parseFloat(nilia2) - parseFloat(nilia1) - parseFloat(jum_diskon);
	if (!isNaN(result)) {
		document.getElementById('kembalian').value = formatNumber(result,'.');
         //document.getElementById('terbilang').value = terbilang(result);

         $.post('<?= base_url('futsall_tr/detail_hasil_transaksi') ?>',{ id_transaksi : id_transaksi ,jum_bayar : jum_bayar ,diskon : diskon },function(data){
         	$('.buyying_blade').html(data);
         });
     }
 } 

</script>




	<?php 
		$jumla_futsal = $this->Futsall_tr_model->hitung_js();
		foreach($this->Futsall_tr_model->hitung_js()->result_array() as $modal): 
			if ($jumla_futsal->num_rows() > 0) { ?> 

				<script type="text/javascript">
				 $(function(){ 
				 var tabledata = $('#datatables').DataTable().ajax.reload(); 
				 if (tabledata == true) {
                    $("#sisa_waktu_<?=$modal['id_transaksi'] ?>").timer('pause'); 
                  }   
				 });
				</script>

				<div id="modal_timing_<?= $modal['id_transaksi'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" style="width: 80%">
						<div class="modal-content">
							<div class="modal-body">
							<div class="buyying_notif"></div>
							<div class="buyying_blade"> 
							</div>  
							<div id="notifikasi"></div>
							<div class="table_form">
								<form class="simpan_data" method="POST">
									<input type="hidden" name="id_transaksi" id="id_transaksi" value="<?= $modal['id_transaksi'] ?>">
									<table class="table">
										<input type="hidden" id="total_kes" value="<?= (int)$modal['harga_sewa'] ?>">
										<tr><td>Jumlah Bayar</td><td><h3>Rp.<?= number_format((int)$modal['harga_sewa'],0,0,'.') ?></h3></td></tr>
										<tr><td>Cash</td><td><input type="text" name="dibayarkan" id="jum_bayar" class="currency form-control" placeholder="Jumlah Yang Di Bayarkan.." onkeyup="sum();"></td></tr>
										<tr><td>Diskon</td><td><input type="number" id="diskon" name="diskon" class="form-control" placeholder="Masukan Jumlah Diskon.." onkeyup="sum();"></td></tr>
										<tr><td>Kembalian</td><td><input type="text" id="kembalian" class="form-control" readonly=""></td></tr>
										<br />
										<tr><td><button class="simpan_data btn btn-info">SELESAIKAN TRANSAKSI.</button></td></tr>
									</table>
								</form>  
							</div>
							</div>
						</div>
					</div>
				</div>  
			<?php } endforeach; ?>
			<!-- endmodal -->



<script type="text/javascript">
	$(function(){
       $('.simpan_data').submit(function(e){
       	e.preventDefault();
       	var id_transaksi = $('#id_transaksi').val();
       	var diskon = $('#diskon').val();
       	
         $.ajax({
            url : '<?= base_url('Futsall_tr/simpan_transaksi') ?>',
            data: 'id_transaksi='+id_transaksi+'&diskon='+diskon+'&jum_bayar='+jum_bayar,
            type: 'post',
            chace:false,

            success:function(data){
              $('#notifikasi').html('<div class="alert alert-danger">Data Transaksi Telah Selesai , Silahkan Tambahkan Jika Ada Transaksi Lagi</div>');
              $('#datatables').DataTable().ajax.reload(); 
              $('#table_form').hide();
             // $("#sisa_waktu_"+id_transaksi).timer('stop'); 

            },erro:function(data){ 
              swal('Tidak Dapat Merespons Server 404');
            }
         }); 
       });
	});
</script>