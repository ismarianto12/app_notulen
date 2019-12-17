<?php 

$string = " 
<div class='row'>
    <div class='col-sm-12'>
      <?= \$this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst(\$judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class=\"table\">";
foreach ($non_pk as $row) {
    $string .= "\n\t    <tr><td>".label($row["column_name"])."</td><td><?php echo $".$row["column_name"]."; ?></td></tr>";
}
$string .= "\n\t    <tr><td></td><td><a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\"><i class='fa fa-home'></i>Back To Home</a></td></tr>";
$string .= "\n\t</table>
</div>
</div>
</div>
</div>";



$hasil_view_read = createFile($string, $target."views/" . $c_url . "/" . $v_read_file);

?>