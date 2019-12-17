
<div class='row'>
<div class='col-md-12'>
<div class='panel panel-info'>
<div class='panel-heading'><?= ucfirst($judul) ?></div>
<div class='panel-wrapper collapse in' aria-expanded='true'>
<div class='panel-body'>
    <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
        <div class='form-body'> 
           ** ) Harap Isikan data yang di butuhkan pada form.
           <br /><br /><br /><br /> 
           <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Id Parent<?php echo form_error('id_parent') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="id_parent" id="id_parent" placeholder="Id Parent" value="<?php echo $id_parent; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Nama Menu<?php echo form_error('nama_menu') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="Nama Menu" value="<?php echo $nama_menu; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Icon<?php echo form_error('icon') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Link<?php echo form_error('link') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="link" id="link" placeholder="Link" value="<?php echo $link; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="enum" class='control-label col-md-3'><b>Aktif<?php echo form_error('aktif') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="aktif" id="aktif" placeholder="Aktif" value="<?php echo $aktif; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Urutan<?php echo form_error('urutan') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="urutan" id="urutan" placeholder="Urutan" value="<?php echo $urutan; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="enum" class='control-label col-md-3'><b>Position<?php echo form_error('position') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="position" id="position" placeholder="Position" value="<?php echo $position; ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Level<?php echo form_error('level') ?></b></label>
            <div class='col-md-9'>
                <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
            </div>
        </div>
        <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>" /> 
        

        <div class='form-actions'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='row'>
                        <div class='col-md-offset-3 col-md-9'>
                           <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                           <a href="<?php echo site_url('menu') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>
                           

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
