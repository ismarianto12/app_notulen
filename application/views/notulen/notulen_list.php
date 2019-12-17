<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
        <h3 class='box-title m-b-0'><?= $judul ?></h3>
        <p class='text-muted m-b-30'>Tabel Data <?= $judul ?></p>
        <div class='table-responsive'>    
           <?php echo anchor(site_url('notulen/tambah'), 'Tambah Data', 'class="btn btn-primary"'); ?>
           <hr />
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
                    ajax: {"url": "notulen/json", "type": "POST"},

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
            "data": "id_notulen",
            "orderable": false
        },{"data": "agenda"},{"data": "nama_user"},{"data": "start_time"},{"data": "end_time"},{"data": "tanggal_not"},{"data": "place"},
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
                   window.location.href='<?= base_url('notulen/hapus/') ?>'+n;
               });
            }
        </script>
    </div>
</div>
</div>
</div>