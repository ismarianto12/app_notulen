 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>Nama Suplier</td><td><?php echo $nama_suplier; ?></td></tr>
	    <tr><td>Alamat Suplier</td><td><?php echo $alamat_suplier; ?></td></tr>
	    <tr><td>No Hp</td><td><?php echo $no_hp; ?></td></tr>
	    <tr><td>No Rek</td><td><?php echo $no_rek; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('suplier') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>