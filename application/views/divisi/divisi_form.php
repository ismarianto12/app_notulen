
<div class='row'>
<div class='col-md-12'>
<div class='panel panel-info'>
<div class='panel-heading'><?= ucfirst($judul) ?></div>
<div class='panel-wrapper collapse in' aria-expanded='true'>
    <div class='panel-body'>
        <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
            <div class='form-body'> 
               ** ) Harap Isikan data yang di butuhkan pada form.
               
            <div class="form-group">
                <label for="varchar" class='control-label col-md-3'><b>Nama Divsi<?php echo form_error('nama_divsi') ?></b></label>
                <div class='col-md-9'>
                    <input type="text" class="form-control" name="nama_divsi" id="nama_divsi" placeholder="Nama Divsi" value="<?php echo $nama_divsi; ?>" />
                </div>
            </div>
            <input type="hidden" name="id_divisi" value="<?php echo $id_divisi; ?>" /> 


            <div class='form-actions'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-offset-3 col-md-9'>
                               <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                               <a href="<?php echo site_url('divisi') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


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
