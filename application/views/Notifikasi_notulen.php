<li>
<div class='message-center'>
    <?php if($data->num_rows() > 0){  foreach($data->result_array() as $data): ?> 
    <a href='<?= base_url('Notulen_detail') ?>'>
      <div class='mail-contnet'>
            <h5><?= $data['agenda'] ?></h5>
            <span class='mail-desc'><?= $data['issue'] ?></span>
            <span class='time'><?= tgl_indonesia($data['date_created']) ?></span>
        </div>
    </a>
    <?php endforeach; }else{ ?>
 
 <div class="alert alert-danger">Tidak ada notulen terbaru</div>
    <?php } ?> 
</div>
</li>
