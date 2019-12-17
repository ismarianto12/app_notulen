 
<div class='col-lg-12'>
<div class='widget'>
    <div class='widget-header bg-blue'>
        <span class='widget-caption'><?= ucfirst($judul) ?></span>
    </div>
  <div class='widget-body'> 
        <div class='form-title'><h2 style="margin-top:0px"><?= ucfirst($judul) ?> : Detail </h2></div>
        <table class="table">
	    <tr><td>Id Instantsi</td><td><?php echo $id_instantsi; ?></td></tr>
	    <tr><td>Nama Instansi</td><td><?php echo $nama_instansi; ?></td></tr>
	    <tr><td>Alamat Lengkap</td><td><?php echo $alamat_lengkap; ?></td></tr>
	    <tr><td>Telp</td><td><?php echo $telp; ?></td></tr>
	    <tr><td>Fax</td><td><?php echo $fax; ?></td></tr>
	    <tr><td>Npwp</td><td><?php echo $npwp; ?></td></tr>
	    <tr><td>Logo</td><td><?php echo $logo; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('instansi') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>