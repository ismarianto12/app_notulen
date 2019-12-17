
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
            <label for="varchar" class='control-label col-md-3'><b>Kode Barang<?php echo form_error('kode_barang') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Nama Barang<?php echo form_error('nama_barang') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Harga Beli<?php echo form_error('harga_beli') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="currency form-control" name="harga_beli" id="harga_beli" placeholder="Harga Beli" value="<?php echo $harga_beli; ?>"  />
        </div>
    </div> 
	 <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Stok<?php echo form_error('stok') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Satuan<?php echo form_error('satuan') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="satuan" id="satuan" placeholder="Satuan" value="<?php echo $satuan; ?>" />
        </div>
    </div>

    
  <div class="form-group">
        <label for="varchar" class='control-label col-md-3'><b>Suplier</b></label>
        <div class='col-md-9'>  
            <select class="form-control" id="id_suplier" name="id_suplier">
             <?php foreach($this->db->get('suplier')->result_array() as $kategori):
             if($kategori->id_suplier == $id_suplier){ 

              $selected ='selected'; 

              }else{  $selected = ''; }

              ?>
             <option value="<?= $kategori['id_suplier'] ?>" <?= $selected ?>><?= $kategori['nama_suplier'] ?></option>
         <?php endforeach; ?>
     </select>
 </div>
</div>
<input type="hidden" name="id_bahan" value="<?php echo $id_bahan; ?>" /> 
	   
<div class='form-actions'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='row'>
                <div class='col-md-offset-3 col-md-9'>
 <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bahan') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>
	

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


<script type="text/javascript">
 function currency(value, separator) {
      if (typeof value == "undefined") return "0";
      if (typeof separator == "undefined" || !separator) separator = ",";
   
      return value.toString()
                  .replace(/[^\d]+/g, "")
                  .replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
}
 
window.addEventListener('keyup', function(e) {
      var el = e.target;
      if (el.classList.contains('currency')) {
            el.value = currency(el.value, el.getAttribute('data-separator'));
      }
  false});
     

</script>

