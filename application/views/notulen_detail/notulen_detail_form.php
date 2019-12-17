
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
                        <label for="int" class='control-label col-md-3'><b>Id Notulen<?php echo form_error('id_notulen') ?></b></label>
                        <div class='col-md-9'>
                            <input type="text" class="form-control"  id="id_notulen" placeholder="Cari Data Notulen..." />
                            <div class="nilai_notulen"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class='control-label col-md-3'><b>Issue<?php echo form_error('issue') ?></b></label>
                        <div class='col-md-9'>
                            <textarea class="form-control" name="issue" id="issue" placeholder="Issue"><?php echo $issue; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class='control-label col-md-3'><b>PIC<?php echo form_error('PIC') ?></b></label>
                        <div class='col-md-9'>
                            <input type="text" class="form-control" name="PIC" id="PIC" placeholder="type hit and enter.." data-role="tagsinput" value="<?php echo $PIC; ?>" /> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="varchar" class='control-label col-md-3'><b>Due Dete<?php echo form_error('due_dete') ?></b></label>
                        <div class='col-md-9'>
                            <input type="date" class="form-control" name="due_dete" id="due_dete" placeholder="Due Dete" value="<?php echo $due_dete; ?>" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="varchar" class='control-label col-md-3'><b>Division<?php echo form_error('division') ?></b></label>
                        <div class='col-md-9'>
                            <input type="text" class="form-control" name="division" id="division" placeholder="division" value="<?php echo $division; ?>" />
                        </div>
                    </div>
               
                    <div class="form-group">
                        <label for="varchar" class='control-label col-md-3'><b>Remarks<?php echo form_error('remarks') ?></b></label>
                        <div class='col-md-9'>
                            <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks" value="<?php echo $remarks; ?>" />
                        </div>
                    </div>
                    <input type="hidden" name="id_not_detail" value="<?php echo $id_not_detail; ?>" />  

                    <div class='form-actions'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='row'>
                                    <div class='col-md-offset-3 col-md-9'>
                                     <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                                     <a href="<?php echo site_url('notulen_detail') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


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
    <?php if($this->uri->segment(2) == 'edit'): ?>
      var id= <?= $id_notulen ?>;
      $.ajax({
        url:'<?= base_url('notulen_detail/get_detail_json') ?>',
        data:'id_notulen='+id,
        type:'post',
        chace:false,
        dataType:'json', 
        success:function(data){
        $('.nilai_notulen').html('<hr /><input type="hidden" name="data_notulen" value="'+data.id_notulen+'"><input type="text" class="form-control" value="'+data.nama_agenda+'" readonly>');
        },error:function(data){
         swal('error','server not response','error');
        }
      });
    <?php else: ?>
    $('.nilai_notulen').html('<div class="alert alert-danger">Silahkan pilih data notulen</div>');
    <?php endif; ?>
    $('#id_notulen').click(function(){
     $('#modal_not').modal('show');
    });
  }); 
</script>
 

<div class="modal fade" id="modal_not" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width: 80%" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <table class="table" id="datatables">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Agenda</th>
                    <th>Created By</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Tanggal</th>
                    <th>Place</th> 
                    <th width="200px">Action</th>
                </tr>
            </thead> 
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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

        var t = $("#datatables").DataTable({
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
            ajax: {"url": "<?= base_url('notulen_detail/json_notulen') ?>", "type": "POST"},
            columns: [
            {
                "data": "id_notulen",
                "orderable": false
            },{"data": "agenda"},{"data": "nama_user"},{"data": "start_time"},{"data": "end_time"},{"data": "date_create"},{"data": "place"},
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
    
 /*pilih agenda*/
    function pilih_agenda(n){
      $.ajax({
         url : '<?= base_url('notulen_detail/get_detail_json') ?>',
         data :'id_notulen='+n,
         type:'post',
         chace:false,
         dataType:'json',
         success:function(data){
           $('.nilai_notulen').html('<hr /><input type="hidden" name="id_notulen" value="'+data.id_notulen+'"><input type="text" class="form-control" value="'+data.nama_agenda+'" readonly>');
           $('#modal_not').modal('hide');
         },error:function(data){
             swal('error','Data tidak respons','error');   
         }
      })

    }
</script>