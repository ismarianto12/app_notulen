<div class='row'>
  <div class='col-md-12'>
    <div class='panel panel-info'>
      <div class='panel-heading'><?= ucfirst($judul) ?></div>
      <div class='panel-wrapper collapse in' aria-expanded='true'>
        <div class='panel-body'>
          <?= $this->session->flashdata('message') ?>
          <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered' enctype="multipart/form-data">
            <div class='form-body'> 
             ** ) Harap Isikan data yang di butuhkan pada form.
             <br /><br /><br /><br />

             <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>No Agenda<?php echo form_error('no_agenda') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="no_agenda" id="no_agenda" placeholder="No Agenda" value="<?php echo $no_agenda; ?>" />
              </div>
            </div>

            
             <div class="form-group">
              <label for="agenda" class='control-label col-md-3'><b>Agenda<?php echo form_error('agenda') ?></b></label>

              <div class='col-md-9'>
                <textarea class="form-control" rows="3" name="agenda" id="agenda" placeholder="Agenda"><?php echo $agenda; ?></textarea>
              </div>
            </div>

            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Start Time<?php echo form_error('start_time') ?></b></label>
              <div class='col-md-9'>
                <input type="time" class="form-control" name="start_time" id="start_time" placeholder="Start Time" value="<?php echo $start_time; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>End Time<?php echo form_error('end_time') ?></b></label>
              <div class='col-md-9'>
                <input type="time" class="form-control" name="end_time" id="end_time" placeholder="End Time" value="<?php echo $end_time; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Place<?php echo form_error('place') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="place" id="place" placeholder="Place" value="<?php echo $place; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Participan<?php echo form_error('participan') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="participan" id="participan" placeholder="Participan" data-role="tagsinput" value="<?php echo $participan; ?>" />
              </div>
            </div>
            
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Absensi<?php echo form_error('absensi') ?></b></label>
              <div class='col-md-9'>
                <?php if($this->uri->segment(2) == 'edit'): ?>
                     <a href="<?= base_url('assets/absensi/'.$absensi) ?>" class="btn btn-info btn-xs" style='color:#fff'>Lampiran File</a>
                     <hr />
                <?php endif; ?>
                <input type="file" class="form-control" name="absensi" id="absensi" placeholder="Absensi" value="<?php echo $absensi; ?>" />
              </div>
            </div>

              <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Tada tangan Pimpinan<?php echo form_error('tdd_pimpinan') ?></b></label>
              <div class='col-md-9'>
                <?php if($this->uri->segment(2) == 'edit'): ?>
                     <a href="<?= base_url('assets/absensi/'.$tdd_pimpinan) ?>" class="btn btn-info btn-xs" style='color:#fff'>Lampiran File</a>
                     <hr />
                <?php endif; ?>
                <input type="file" class="form-control" name="tdd_pimpinan" id="tdd_pimpinan" placeholder="Absensi" value="<?php echo $tdd_pimpinan; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>No Dokumen<?php echo form_error('no_dokumen') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="no_dokumen" id="no_dokumen" placeholder="No Dokumen" value="<?php echo $no_dokumen; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>No Revisi<?php echo form_error('no_revisi') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="no_revisi" id="no_revisi" placeholder="No Revisi" value="<?php echo $no_revisi; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Notulis<?php echo form_error('notulis') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="notulis" id="notulis" placeholder="Notulis" value="<?php echo $notulis; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Pimpinan Rapat<?php echo form_error('pimpinan_rapat') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="pimpinan_rapat" id="pimpinan_rapat" placeholder="Pimpinan Rapat" value="<?php echo $pimpinan_rapat; ?>" />
              </div>
            </div>
            <div class="form-group">
              <label for="varchar" class='control-label col-md-3'><b>Jenis Rapat<?php echo form_error('jenis_rapat') ?></b></label>
              <div class='col-md-9'>
                <input type="text" class="form-control" name="jenis_rapat" id="jenis_rapat" placeholder="Jenis Rapat" value="<?php echo $jenis_rapat; ?>" />
              </div>
            </div>
       
            <input type="hidden" name="id_notulen" value="<?php echo $id_notulen; ?>" /> 
            <div class='form-actions'>
              <div class='row'>
                <div class='col-md-12'>
                  <div class='row'>
                    <div class='col-md-offset-3 col-md-9'>
                     <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                     <a href="<?php echo site_url('notulen') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


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
