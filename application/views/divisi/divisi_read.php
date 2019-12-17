 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>Id Instansi</td><td><?php echo $id_instansi; ?></td></tr>
	    <tr><td>Nama Divsi</td><td><?php echo $nama_divsi; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('divisi') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>