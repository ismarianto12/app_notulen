 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>Id Notulen</td><td><?php echo $id_notulen; ?></td></tr>
	    <tr><td>Issue</td><td><?php echo $issue; ?></td></tr>
	    <tr><td>PIC</td><td><?php echo $PIC; ?></td></tr>
	    <tr><td>Due Dete</td><td><?php echo $due_dete; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Remarks</td><td><?php echo $remarks; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('notulen_detail') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>