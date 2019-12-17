<?php  
$string = " 
<div class='col-lg-12'>
<div class='box'>
 <div class='box-title'>
  ".strtoupper($judul)."
  <br />   
  <?php echo anchor(site_url('".$c_url."/tambah'), 'Tambah Data', 'class=\"btn bg-maroon btn-flat margin\"'); ?>
  </div>
 <div class='ibox-content'> 
 <?= \$this->session->flashdata('message') ?>
        <table class=\"table table-bordered\" style=\"margin-bottom: 10px\">
            <tr>
                <th>No</th>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t<th>" . label($row['column_name']) . "</th>";
}
$string .= "\n\t\t<th>Action</th>
            </tr>";
$string .= "<?php
            foreach ($" . $c_url . "_data as \$$c_url)
            {
                ?>
                <tr>";

$string .= "\n\t\t\t<td width=\"80px\"><?php echo ++\$start ?></td>";
foreach ($non_pk as $row) {
    $string .= "\n\t\t\t<td><?php echo $" . $c_url ."->". $row['column_name'] . " ?></td>";
}

$string .= "\n\t\t\t<td style=\"text-align:center\" width=\"200px\"><div class='btn-group'>"
        . "\n\t\t\t\t<?php "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/detail/'.$".$c_url."->".$pk."),'Detail','class=\"btn bg-maroon btn-flat margin\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/edit/'.$".$c_url."->".$pk."),'Edit','class=\"btn bg-green btn-flat margin\"'); "
        . "\n\t\t\t\techo '  '; "
        . "\n\t\t\t\techo anchor(site_url('".$c_url."/hapus/'.$".$c_url."->".$pk."),'Hapus','class=\"btn bg-red btn-flat margin\"','onclick=\"javasciprt: return confirm(\\'Are You Sure ?\\')\"'); "
        . "\n\t\t\t\t?>"
        . "\n\t\t\t</div></td>";
$string .=  "\n\t\t</tr>
                <?php
            }
            ?>
        </table>
        <div class=\"row\">
            <div class=\"col-md-6\">
                <a href=\"#\" class=\"btn btn-info\">Total Data Yang Tersedia : <?php echo \$total_rows ?></a>";
if ($export_excel == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/excel'), 'Excel','class=\"btn bg-maroon btn-flat margin\"'); ?>";
}
if ($export_word == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/word'), 'Word','class=\"btn bg-maroon btn-flat yellow\"'); ?>";
}
if ($export_pdf == '1') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$c_url."/pdf'), 'PDF','class=\"btn bg-maroon btn-flat margin\"'); ?>";
}
$string .= "\n\t    </div>
            <div class=\"col-md-6 text-right\">
                <?php echo \$pagination ?>
            </div>
        </div>
       </div>
     </div>
    </div>
   ";
$hasil_view_list = createFile($string, $target."views/" . $c_url . "/" . $v_list_file);

?>