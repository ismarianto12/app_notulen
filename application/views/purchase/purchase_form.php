
<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-info'>
            <div class='panel-heading'><?= ucfirst($judul) ?></div>
            <div class='panel-wrapper collapse in' aria-expanded='true'>
                <div class='panel-body'>
                    <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
                        <div class='form-body'> 
                         ** ) Harap Isikan data yang di butuhkan pada form.
                         <br /><br /><br /><br /> 
                         <div class="form-group">
                            <label for="varchar" class='control-label col-md-3'><b>Kode Purchase<?php echo form_error('kode_purchase') ?></b></label>
                            <div class='col-md-9'>
                                <input type="text" class="form-control" name="kode_purchase" id="kode_purchase" placeholder="Kode Purchase" value="<?php echo $kode_purchase; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                           
                
                                <label for="varchar" class='control-label col-md-3'><b>Kategori Menu</b></label>
                                <div class='col-md-9'>
                                    <select class="form-control" id="suplier" name="suplier">
                                       <?php foreach($this->db->get('suplier')->result_array() as $suplier):
                                       if($suplier->id_suplier == $suplier){ 

                                          $selected ='selected'; 

                                      }else{  $selected = ''; }

                                      ?>
                                      <option value="<?= $suplier['id_suplier'] ?>" <?= $selected ?>><?= $suplier['nama_suplier'] ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                      </div>

  
                        <div class="form-group">
                            <label for="alamat_sup" class='control-label col-md-3'><b>Alamat Sup<?php echo form_error('alamat_sup') ?></b></label>

                            <div class='col-md-9'>
                                <textarea class="form-control" rows="3" name="alamat_sup" id="alamat_sup" placeholder="Alamat Sup"><?php echo $alamat_sup; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="int" class='control-label col-md-3'><b>Id Barang </b>
                            </label>
                            <div class='col-md-9'>
                              <div id="tabel_purchase"></div> 
                              <br />
                              <input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" />
                          </div>
                      </div>


                     
                    <input type="hidden" name="id_purchase" value="<?php echo $id_purchase; ?>" />  <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='row'>
                                    <div class='col-md-offset-3 col-md-9'>
                                     <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                                     <a href="<?php echo site_url('purchase') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
</div>
</div>


<script type="text/javascript">
    $(function(){
      $('#id_barang').click(function(){
         $('#data_barang_modal').modal('show');  

      $('#id_bahan').click(function(){  
        var id_barang = $('#id_bahan').val();
        var jumlah_data = $('#jumlah_data').val();
        
        $.ajax({
            url  : '<?= base_url('purchase/purchase_barang') ?>',
            data : 'id_barang='+id_barang+'&jumlah='+jumlah_data,
            type : 'post',
            chace: false,
            success:function(data){ 
               $('#data_barang_modal').modal('hide');  
            $('#tabel_purchase').load('<?= base_url('purchase/data_barang_p') ?>');
            },error:function(data){
            swal('Server Not Respn');
        }  
    })
    });
  }); 
  }) 

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
         $.ajax({
            url  : '<?= base_url('purchase/purchase_barang_delete') ?>',
            data : 'id_barang='+n,
            type : 'post',
            chace: false,
            success:function(data){ 
              $('#tabel_purchase').load('<?= base_url('purchase/data_barang_p') ?>');
          },error:function(data){
            swal('Server Not Respn');
        }  
    })
     });
    }



</script>

<!-- modal bahan -->

<div id="data_barang_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 80%">
    <div class="modal-content">
      <div class="modal-body"> 
        <table class="table" id="datatables">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th> 
                    <th>Stok</th>
                    <th>Satuan</th> 
                    <th>Id Suplier</th>
                    <th>Tanggal Barang</th> 
                    <th>Masukan Jumlah</th> 
                    <th>Action</th>
                </tr>
            </thead>

        </table>

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

                var t = $("#datatables").dataTable({
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
                    ajax: {"url": "<?= base_url('purchase/json_purchase') ?>", "type": "POST"},
                    columns: [
                    {
                        "data": "id_bahan",
                        "orderable": false
                    },{"data": "kode_barang"},{"data": "nama_barang"},{"data": "harga_beli",render: $.fn.dataTable.render.number( ',', '.', 0, 'Rp.' )},{"data": "stok"},{"data": "satuan"},{"data": "nama_suplier"},{"data": "tanggal_barang"},{
                         "data": "jumlah",
                         "orderable": false,
                         "className" : "text-center"
                       },
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


        </script>

    </div> 
</div> 
</div> 
</div>
