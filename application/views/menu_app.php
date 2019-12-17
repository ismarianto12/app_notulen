<?php 
$sc = isset($_GET['save']) ? $_GET['save']  : '';  
if ($sc == 'sc' ) { 
  echo "<div class='alert alert-success'>Perubahan pada settingan menu berhasil di simpan.</div>";
}

echo $this->session->flashdata('pesan');
?>

<div class="row" style="background: #fff;padding: 20px">
  <link href="<?= base_url('assets')  ?>/template/css/menu.css" rel="stylesheet">
 <script src="<?= base_url('assets/template/js/jquery.nestable.js') ?>"></script>
 <div class="widget">

  <div class="col-lg-8">  


    <div class="ibox-title">
      <h3>Struktur Menu</h3>
    </div><!-- /.box-header -->
    <div class="ibox-content">

     <hr />
     <input type="hidden" id="id">
     <div class="dd" id="nestable">
      <?php
      $ref   = [];
      $items = [];
      foreach ($record->result() as $data) {
        $thisRef = &$ref[$data->id_menu];
        $thisRef['id_parent'] = $data->id_parent;
        $thisRef['icon'] = $data->icon;
        $thisRef['level'] = $data->level;
        $thisRef['nama_menu'] = $data->nama_menu;
        $thisRef['link'] = $data->link;
        $thisRef['id_menu'] = $data->id_menu;
        $thisRef['position'] = $data->position;

        if($data->id_parent == 0) {
          $items[$data->id_menu] = &$thisRef;
        } else {
          $ref[$data->id_parent]['child'][$data->id_menu] = &$thisRef;
        }

      }

      function get_menu($items,$class = 'dd-list') {
        $ci = & get_instance();
        $html = "<ol class=\"".$class."\" id=\"menu-id\">";
        foreach($items as $key=>$value) {
          $akses_level = str_replace('.', ',', $value['level']);
          if ($value['position']=='Top'){ $icon = 'down text-danger'; $ket ='Pindah ke Bottom Menu'; }else{ $icon = 'up text-success';  $ket ='Pindah ke Top Menu'; }
          $html.= '<li class="dd-item dd3-item" data-id="'.$value['id_menu'].'" >
          <div style="cursor:move" class="dd-handle dd3-handle '.$value['position'].'"></div>
          <div class="dd3-content"><span id="label_show'.$value['id_menu'].'">'.$value['nama_menu'].'</span> 
          <span class="span-right">/<span id="link_show'.$value['id_menu'].'">'.$value['link'].'</span> &nbsp;&nbsp; 
          &nbsp; 

          <a class="edit-button" id="'.$value['id_menu'].'" label="'.$value['nama_menu'].'" link="'.$value['link'].'" level="'.$akses_level.'" icon="'.$value['icon'].'" ><i class="fa fa-pencil"></i></a>  &nbsp; 
          '.$value['level'].'
          <i class="fa fa-user"></i>  &nbsp;  
          <a class="del-button" id="'.$value['id_menu'].'"><i class="fa fa-trash"></i></a></span> 
          </div>';
          if(array_key_exists('child',$value)) {
            $html .= get_menu($value['child'],'child');
          }
          $html .= "</li>";
        }
        $html .= "</ol>";
        return $html;
      }
      print get_menu($items);
      ?>
    </div>
  </div>

  <input type="hidden" id="nestable-output">
</div>

<div class="col-lg-4">  

 <div class="ibox">
  <div class="ibox-title">
    <h3>Source Menu URL</h3>
  </div><!-- /.box-header -->
  <div class="ibox-content">
    <table class="table table-striped">
      <tr><td><input class='form-control'id="label" type="text" placeholder="Nama Menu" required><br /><button class="btn btn-success" id="label_cr"><i class="fa fa-search"></i>Cari Menu.</button></td></tr>
      <tr><td><input class='form-control link' type="text" id="link" placeholder="example.com" autocomplete='off' required>
      </td></tr>
      <tr>
        <td>
          <div id="icon">
            <a data-toggle="modal" class="btn btn-primary" href="#modal-form">Pilih Icon Menu</a>
          </div>
          <div id="modal-form" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <h4>Favicon Menu</h4>
                  <div class="row"> 
                   <?php foreach ($icon as $key => $val) { ?>

                    <div class="control-group">
                      <div class="radio">
                        <label>
                          <input class="icon_r" type="radio" value="<?= $key ?>">
                          <span class="text"><i class="<?= $key ?>"></i><?= $key ?></span>
                        </label>
                      </div>

                    </div>

                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tampil"></div>
      </td>
    </tr>
    <tr><td>
     <h4>Level Akses</h4>
     <br />
     <?php 
     $level = ['admin','user'];
     foreach($level as $s): 
       ?>
       <div class="form-group">
        <div class="checkbox checkbox-success">
          <div id="level_akses_otp"></div>
           
            <input id="checkbox<?= $s ?>" type="checkbox" name="checkbox" value="<?= $s?>">
            <label for="checkbox<?= $s ?>"><?= ucfirst($s) ?></label>
         
        </div>
      </div>
    <?php endforeach; ?>

  </td></tr>
  <tr><td><button class='btn btn-sm btn-success' id="submit">Submit</button> <button class='btn btn-sm btn-default' id="reset">Reset</button></td></tr>
</table>
</div>
</div>
</div>
</div>
<script>
  $(function(){
    $('.tampil').html('<br /><div class="alert alert-danger">Icon Menu</div>') ;
    $('.icon_r').click(function(){
     var id = $(this).val();
     $('.modal').modal('hide');
     $('.tampil').html('<div class="control-group"><div class="radio"><label><input id="fa_icon" type="radio" value="'+id+' fa-fw" checked><span class="text"><i class="'+id+' fa-fw"></i>'+id+'</span></label></div></div>');

   });  
  });

  $(document).ready(function(){
    var updateOutput = function(e){
      var list   = e.length ? e : $(e.target),
      output = list.data('output');
      if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
          } else {
            output.val('JSON browser support required for this demo.');
          }
        };

    // activate Nestable for list 1
    $('#nestable').nestable({
      group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    $('#nestable-menu').on('click', function(e){
      var target = $(e.target),
      action = target.data('action');
      if (action === 'expand-all') {
        $('.dd').nestable('expandAll');
      }
      if (action === 'collapse-all') {
        $('.dd').nestable('collapseAll');
      }
    });
  });


  function kosong(){
   $("input[name='checkbox']").val('');
   $('.tampil').html('<br /><div class="alert alert-danger">Icon Menu</div>');
 }


</script>

<script>
  $(document).ready(function(){
    $("#load").hide();
    $("#submit").click(function(){
     if ($("#fa_icon").val() == '') { 
       alert('Semua form isian wajib di isi');
     }else{  

      $("#load").show();  
      var levels =  [];   
      $.each($("input[name='checkbox']:checked"),function() {
        levels.push($(this).val());
      });
      var selected_values = levels.join(".");
      var dataString = { 
        level : selected_values,
        icon : $("#fa_icon").val(),
        label : $("#label").val(),
        link : $("#link").val(),
        id : $("#id").val()
      };

      $.ajax({
        type: "POST",
        url: "<?= base_url('setting/menu/simpan'); ?>",
        data: dataString,
        dataType: "json",
        cache : false,
        success: function(data){
          if(data.type == 'add'){
           $("#menu-id").append(data.menu);
           window.location.href='<?= base_url('setting/menu?save=sc') ?>';
         } else if(data.type == 'edit'){
           $('#label_show'+data.id).html(data.label);
           $('#label_show').removeAttr('id');
           $('#link_show'+data.id).html(data.link);
           $('#page_show'+data.id).html(data.page);
           $('#kategori_show'+data.id).html(data.kategori);
           window.location.href='<?= base_url('setting/menu?save=sc') ?>';
         }
         $('#label').val('');
         $('#link').val('');
         $('#page').val('');
         $('#kategori').val('');
         $('#id').val('');
         $("#load").hide();
         kosong();
       } ,error: function(xhr, status, error) {
        swal('Tidak Dapat Memproses silahkan pilih icon terlebih dahulu.');
      },
    });

    }

  });


    $('.dd').on('change', function() {
      $("#load").show();

      var dataString = { 
        data : $("#nestable-output").val(),
      };

      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>setting/menu/save_position",
        data: dataString,
        cache : false,
        success: function(data){
          $("#load").hide();
        } ,error: function(xhr, status, error) {
          swal('Tidak Dapat Merespon Data 404');
        },
      });
    });

    $(document).on("click",".pos-button",function() {
      var id = $(this).attr('id');
      $("#load").show();
      $.ajax({
        type: "POST",
        url: "<?= base_url('menu/menu_web/kategori'); ?>",
        data: { id : id },
        cache : false,
        success: function(data){
          $("#load").hide();
        } ,error: function(xhr, status, error) {
        swal('Tidak Dapat Merespon Data 404');
       },
     });
    });

    $(document).on("click",".del-button",function() {
      var id = $(this).attr('id');
      swal({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda Yakin Untuk Menghapus Data Ini?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Ya',
        closeOnConfirm: false
      },
      function() {
        setTimeout(function(){
          $("#load").show();
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>setting/menu/delete",
            data: { id : id },
            cache : false,
            success: function(data){
              $("#load").hide();
              $("li[data-id='" + id +"']").remove();
              window.location.href='<?= base_url('setting/menu?save=sc') ?>';
            } ,error: function(xhr, status, error) {
                  //alert(error);
                alert( data.Message );
                },
              });
        }, 100);
      });
    });


    $(document).on("click",".edit-button",function() {
    
      var id = $(this).attr('id');
      var label = $(this).attr('label');
      var link = $(this).attr('link');
      var level = $(this).attr('level'); 
      var icon = $(this).attr('icon');  

      $("#id").val(id);
      $("#label").val(label);
      $("#link").val(link);
      $('#level_akses').html(level);

      var kali    = $('#level_akses').html(level);      
      $('#level_akses_otp').html(level.toUpperCase()+'<br />');
      var level_aks = $("#level_akses").html(level);
      var lev = level.split(',');
         for(i=0; i<lev.length; i++){
            $('#checkbox'+lev[i]).attr('checked', true);
            //$('[value='+lev[i]+']').attr('checked', true);

     }

  
      $(".tampil").html('<div class="control-group"><div class="radio"><label><input tabindex="7" class="check" id="fa_icon minimal-radio-1" type="radio" value="icon '+icon+'" checked><span class="text"><i class="'+icon+'"></i>'+icon+'</span></label></div></div>');
    });

    $(document).on("click","#reset",function() {
      $('#label').val('');
      $('#link').val('');
      $('#level_akses').val('');
      $('#id').val('');
    });

  });

</script>

<script type="text/javascript">
 function UbahLevel(nm){
  ck = "";
  if (nm.checked == true) {
    var nilai = data.LevelID.value;
    if (nilai.match(nm.value+".") != nm.value+".") data.LevelID.value += nm.value + ".";
  }
  else {
    var nilai = data.LevelID.value;
    data.LevelID.value = nilai.replace(nm.value+".", "");
  }
} 
</script>


<script type="text/javascript">
 $(function(){
  $('#label_cr').click(function(){
   $('#tampil_cmodal').modal('show');

 });
  $('.menu_app').click(function(){
    var id_menu = $(this).val();
    $('#label').val(id_menu); 
    $('#link').val(id_menu).attr('readonly',true); 
    $('#tampil_cmodal').modal('hide');
    $('.menu_app').attr('checked',false);

  })
})


</script>

</div>  


<div id="tampil_cmodal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title" id="myLargeModalLabel">Data menu dan modul akses</h4>
      </div>
      <div class="modal-body">
       <?php 
                  //in_array('arsip', haystack);
       $controllers = get_filenames(APPPATH.'controllers/');
       foreach($controllers as $ct):
        $has=str_replace('.php', '', $ct);
        $data =$this->db->get_where('menu',array('link'=>strtolower($has)));
        if ($data->num_rows() > 0) {
         echo '<div class="alert alert-danger"><i class="fa fa-check"></i>'.$has.'Menu ini Sudah Ada </div>';
       }else{ 
        echo '  <div class="control-group">
        <div class="radio">
        <label>
        <input class="menu_app" type="radio" value="'.$has.'">
        <span class="text"> '.$has.'</span>
        </label>
        </div> 
        </div>';
      } 
    endforeach;

    ?>
  </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>