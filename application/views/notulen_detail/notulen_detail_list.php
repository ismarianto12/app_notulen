<div class='row'>
  <div class='col-sm-12'>
    <?= $this->session->userdata('message') ?>
    <div class='white-box'>
      <h3 class='box-title m-b-0'><?= $judul ?></h3>
      <p class='text-muted m-b-30'>Tabel Data <?= $judul ?></p>
      <div class='table-responsive'>  

       <a href="<?= base_url('notulen_detail/tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah data</a> 
       <hr />
       <div class="form-group">
        <label for="varchar" class='control-label col-md-3'><b>Data Notulen</b></label>
        <div class='col-md-9'>
          <select name="id_notulen" class="form-control" id="id_notulen">  
            <option value="">Pilih Notulen</option>
            <?php foreach($data_notulen->result_array() as $not): ?>
              <option value="<?= $not['id_notulen'] ?>"><?= $not['agenda'] ?> / <?= $not['date_create'] ?></option> 
            <?php endforeach; ?>
          </select>
          <hr />
        </div>
      </div>
      <div class="form-group">
        <label for="varchar" class='control-label col-md-3'><b>Data Notulen</b></label>
        <div class='col-md-9'>

          <select name="filter_by" class="form-control" id="filter_by">  
            <option value="">FIlter By Status</option> 
            <option value="N">Open </option>
            <option value="Y">Closed </option>
           </select>
         </div>
      </div> 
      <table class="table" id="datatables">
        <thead>
          <tr>
            <th width="80px">No</th>
            <th>Notulen Data</th>
            <th>Issue</th>
            <th>PIC</th>
            <th>Due Dete</th>
            <th>Status</th>
            <th>Remarks</th>
            <th width="200px">Action</th>
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

          var tabledata = $("#datatables").DataTable({
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
            ajax: {"url": "notulen_detail/json", "type": "POST",data:function(data){
             var id_notulen = $('#id_notulen').val();
             var filter_by = $('#filter_by').val();

             data.id_notulen = id_notulen;  
             data.filter_by = filter_by;              
           },
         },

         dom: 'Bfrtip',
         buttons: [
         { extend: 'copyHtml5',
           exportOptions: {
                 columns: [ 7 ,':visible'],
                  footer: true  
           },          
           
         },
         { extend: 'excelHtml5', 
           exportOptions: {
           messageTop: 'Data Notulen Di Cetak tanggal <?= date('Y-m-d') ?>',
                 columns: [ 7 ,':visible'],
                 footer: true 
             },
           },
         { extend: 'csvHtml5',
           exportOptions: {
             columns: [ 7 ,':visible'], 
             footer: true,
           },
          },
         { extend: 'pdfHtml5', footer: true },
         { extend: 'print',
           exportOptions: {
                 columns: [ 7 ,':visible'],
                 
           }, footer: true }

         ], 

         columns: [
         {
          "data": "id_not_detail",
          "orderable": false
        },{"data": "agenda"},{"data": "issue"},{"data": "PIC"},{"data": "due_dete"},{"data": "status","render": function (data, type, row) {

          if (row.status == 'N') {
            return '<button class="btn btn-success btn-xs">Open</button>';}
            else {
             return '<button class="btn btn-danger btn-xs">Closed</button>';

           }
         }

       },{"data": "remarks"},
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

 var id_notulen = $('#id_notulen').val();
          $('#id_notulen').change(function(){
            tabledata.draw();
            tabledata.ajax.reload();         
           });

          $('#filter_by').change(function(){
           if($('#id_notulen').val() == ''){
            swal('peringatan','anda harus memilih jenis notulen terlebih dahulu','error');
            $('#filter_by').val('');
           }else{ 
            tabledata.draw();
            tabledata.ajax.reload();    
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
            $.ajax({
              url : '<?= base_url('notulen_detail/hapus') ?>',
              data : 'id_not_detail='+n,
              type: 'POST', 
              chace :false, 
              success:function(data){
                $('#datatables').DataTable().ajax.reload();
                swal('success','Data Berhasil di hapus','success');
              },error:function(data){
               swal('Error','Maaf data tidak dapat di proses','error');
             }
           });

          });
        }
/*set close*/

      function set_close(n){
          swal({
            title: 'Konfirmasi Hapus',
            text: 'anda akan menyatakan detail notulen ini telah selsai?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Ya',
            closeOnConfirm: false
          },
          function(){
            $.ajax({
              url : '<?= base_url('notulen_detail/set_close') ?>',
              data : 'id_not_detail='+n,
              type: 'POST', 
              chace :false, 
              success:function(data){
                $('#datatables').DataTable().ajax.reload();
                swal('success','Detail Notulen telah selesai','success');
              },error:function(data){
               swal('Error','Maaf data tidak dapat di proses','error');
             }
           });

          });
        }
      </script>
    </div>
  </div>
</div>
</div>