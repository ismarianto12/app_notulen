 
<?= $this->session->userdata('message') ?>
<div class='row'>
    <div class='col-xs-12 col-md-12' style="background: #fff">
       <div class='widget'>
        <div class='widget-header'>

            <div class='widget-buttons'>
                <a href='#' data-toggle='maximize'>
                    <i class='fa fa-expand'></i>
                </a>
                <a href='#' data-toggle='collapse'>
                    <i class='fa fa-minus'></i>
                </a> 
            </div>


        </div> 
        <div class='widget-body'>
            <table class="table" id="datatables">
                <thead>
                    <tr> 
                        <th>Nama Instansi</th>
                        <th>Alamat Lengkap</th>
                        <th>Telp</th>
                        <th>Fax</th>
                        <th>Npwp</th>
                        <th>Logo</th>
                        <th>Action</th>
                    </tr>
                </thead> 
                <tbody> 
                    <?php foreach($data->result_array() as $sql): ?>

                        <tr>
                            <td><?= $sql['nama_instansi'] ?></td>
                            <td><?= $sql['alamat_lengkap'] ?></td>
                            <td><?= $sql['telp'] ?></td>
                            <td><?= $sql['fax'] ?></td>
                            <td><?= $sql['npwp'] ?></td>
                            <td><img src="<?= base_url('assets/img/'.$sql['logo']) ?>"  class="img-responsive" style="width: 150px;height: 120px"> </td>
                            <td><a href="<?= base_url('instansi/edit/'.$sql['id_instansi']) ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a></td>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table>


        </div> 

        <script type="text/javascript">
            $(document).ready(function() {
               $('#datatables').dataTable();
           });
       </script>