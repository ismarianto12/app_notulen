
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
        <label for="varchar" class='control-label col-md-3'><b>Kode Transaksi<?php echo form_error('kode_transaksi') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="kode_transaksi" id="kode_transaksi" placeholder="Kode Transaksi" value="<?php echo $kode_transaksi; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="int" class='control-label col-md-3'><b>Id Menu<?php echo form_error('id_menu') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="id_menu" id="id_menu" placeholder="Id Menu" value="<?php echo $id_menu; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="int" class='control-label col-md-3'><b>Id Meja<?php echo form_error('id_meja') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="id_meja" id="id_meja" placeholder="Id Meja" value="<?php echo $id_meja; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="int" class='control-label col-md-3'><b>Jumlah Porsi<?php echo form_error('jumlah_porsi') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="jumlah_porsi" id="jumlah_porsi" placeholder="Jumlah Porsi" value="<?php echo $jumlah_porsi; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="varchar" class='control-label col-md-3'><b>Penerima<?php echo form_error('penerima') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="penerima" id="penerima" placeholder="Penerima" value="<?php echo $penerima; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="varchar" class='control-label col-md-3'><b>Id User<?php echo form_error('id_user') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="id_user" id="id_user" placeholder="Id User" value="<?php echo $id_user; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="date" class='control-label col-md-3'><b>Tanggal Transaksi<?php echo form_error('tanggal_transaksi') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi" value="<?php echo $tanggal_transaksi; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="date" class='control-label col-md-3'><b>Memo Khusus<?php echo form_error('memo_khusus') ?></b></label>
        <div class='col-md-9'>
            <input type="text" class="form-control" name="memo_khusus" id="memo_khusus" placeholder="Memo Khusus" value="<?php echo $memo_khusus; ?>" />
        </div>
    </div>
    <div class="form-group">
        <label for="catatan_trasaksi" class='control-label col-md-3'><b>Catatan Trasaksi<?php echo form_error('catatan_trasaksi') ?></b></label>

        <div class='col-md-9'>
            <textarea class="form-control" rows="3" name="catatan_trasaksi" id="catatan_trasaksi" placeholder="Catatan Trasaksi"><?php echo $catatan_trasaksi; ?></textarea>
        </div>
    </div>
    <input type="hidden" name="id_ransaksi" value="<?php echo $id_ransaksi; ?>" /> 


    <div class='form-actions'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='row'>
                    <div class='col-md-offset-3 col-md-9'>
                     <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
                     <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>
                     

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
