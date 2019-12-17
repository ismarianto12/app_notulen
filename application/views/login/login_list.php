<div class='row'>
    <div class='col-sm-12'>
     <div class="session_flasdata"> <?= $this->session->userdata('message') ?></div>
     <div class='white-box'>
        <h3 class='box-title m-b-0'><?= $judul ?></h3>
        <p class='text-muted m-b-30'>Tabel Data <?= $judul ?></p>
        <div class='table-responsive'>  
            <?php echo anchor(site_url('login/tambah'), 'Tambah Data', 'class="btn btn-primary"'); ?>
            <?php echo anchor(site_url('login/excel'), '<i class=\'fa fa-file-excel-o\'></i>Excel', 'class="btn btn-info"'); ?>
            <?php echo anchor(site_url('login/word'), '<i class=\'fa fa-file-word-o\'></i>Word', 'class="btn btn-danger"'); ?>

            <br /><br />
            <table class="table" id="datatables">
                <thead>
                    <tr>
                        <th width="80px">No</th>
                        <th>Username</th> 
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Foto</th>
                        <th>Level</th>
                        <th>Nama Divisi</th> 
                        <th>Date Create</th>
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
                        ajax: {"url": "login/json", "type": "POST"},
                        columns: [
                        {
                            "data": "id_user",
                            "orderable": false
                        },{"data": "username"},{"data": "nama"},{"data": "email"},{"data": "foto_user"},{"data": "level"},{"data": "nama_divsi"},{"data": "date_create"},
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
                        $.ajax({
                           url : '<?= base_url('login/hapus') ?>',
                           data :'id_user='+n,
                           type : 'post', 
                           //chace : false,
                           dataType : "json",
                           chace :false,
            success:function(data){
            if(data.pesan == 'berhasil'){ 
                  swal('Hapus Data', 'Data Berhasil Di Hapus', 'success'); 
                  $('#session_flasdata').html('<div class="alert alert-danger">Data Berhasil di hapus</div>');
                  $("#datatables").DataTable().ajax.reload();
                }else{
                swal('gagal', 'tidak dapat hapus karena :'+data.pesan, 'error');$('#session_flasdata').html('<div class="alert alert-danger">Data Berhasil di hapus</div>');
                $("#datatables").DataTable().ajax.reload();
              }
            },error:function(data){
              swal('erorr', 'Data tidak dapat di hapus', 'success'); 
            } 
         }); 
                    });
                }
            </script>
        </div>
    </div>
</div>
</div>