 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>Kode Purchase</td><td><?php echo $kode_purchase; ?></td></tr>
	    <tr><td>Suplier</td><td><?php echo $suplier; ?></td></tr>
	    <tr><td>Alamat Sup</td><td><?php echo $alamat_sup; ?></td></tr>
	    <tr><td>Id Barang</td><td><?php echo $id_barang; ?></td></tr>
	    <tr><td>Tanggal Purchase</td><td><?php echo $tanggal_purchase; ?></td></tr>
	    <tr><td>Detail</td><td><?php echo $detail; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('purchase') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>