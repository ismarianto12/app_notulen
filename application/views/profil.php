<div class='row'>
<div class='col-md-12'>
<div class='panel panel-info'>
<div class='panel-heading'><i class="icon-user"></i> Edit Profil</div>
<div class='panel-wrapper collapse in' aria-expanded='true'>
<div class='panel-body'>
    <form id="cupdate" enctype="multipart/form-data" class='form-horizontal' method="POST">
       <input type="hidden" name="id_user" value="<?php echo $this->session->id_user; ?>" /> 
       <div class='form-body'>
        <h3 class='box-title'>Username</h3> 
        <hr class='m-t-0 m-b-40'>
        <div class='row'>
            <div class='col-md-6'> 
                <div class='form-group'>
                    <label class='control-label col-md-3'>Username </label>
                    <div class='col-md-9'>
                        <input type='text' name="username" id="username" class='form-control' placeholder='Username' value="<?= $username ?>"></div>
                    </div>
                </div>
                <!--/span-->
                <div class='col-md-6'>
                    <div class='form-group'>
                        <label class='control-label col-md-3'>Password  </label>
                        <div class='col-md-9'>
                            <input type='password' name="password" id="password" class='form-control' placeholder='Password..'></div>
                        </div>
                    </div>

                    <div class='col-md-6'>
                    <div class='form-group'>
                        <label class='control-label col-md-3'>Ulangi Password</label>
                        <div class='col-md-9'>
                            <input type='password' name="password_ul" id="password_ul" class='form-control' placeholder='Password..'></div>
                        </div>
                    </div> 
                </div>
                <!--/row-->
                <div class='row'>
                   <div class='col-md-6'>
                    <div class='form-group'>
                        <label class='control-label col-md-3'>Nama  </label>
                        <div class='col-md-9'>
                            <input type='text' name="nama" id="nama" class='form-control' placeholder='Password..' value="<?= $nama ?>"></div>
                        </div>  
                    </div>
                    
                    </div>
                    <!--/row-->
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group'>
                            <label class='control-label col-md-3'>Email </label>
                            <div class='col-md-9'>
                                <input type='email' name="email" id="email" class='form-control' placeholder='Email..' value="<?= $email ?>"></div>
                            </div>  
                        </div>
                        <!--/span-->
                        <div class='col-md-6'>
                            <div class='form-group'> 
                                <label class='control-label col-md-3'>Foto  </label>
                                <div class='col-md-9'> 
                                 <img src="<?= base_url('assets/img/foto/'.$foto) ?>" alt="" class="header-avatar" id="image_upload_preview" class="img-responsive" style="width: 100px;height: 100px">
                                 <br />
                                 <input type='file' id="foto" name="foto" class='form-control' placeholder='Foto..'></div>
                             </div>  
                         </div>
                         <!--/span-->
                     </div> 
                     <hr class='m-t-0 m-b-40'> 
                 </div>
                 <div class='form-actions'>
                    <div class='row'>
                        <div class='col-md-6'>
                            <div class='row'>
                                <div class='col-md-offset-3 col-md-9'>
                                    <button type='submit' id="cupdate" class='btn btn-success'>Simpan Data</button>
                                    <button type='button' class='btn btn-default'>Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-6'> </div>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</div>
</div>
</div> 


<script type="text/javascript">
$(function(){ 
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image_upload_preview').attr('src', e.target.result);
            $('#image_2').attr('src', e.target.result);
        
        } 
        reader.readAsDataURL(input.files[0]);
    }
}

$("#foto").change(function () {
 var ext = $('#foto').val().split('.').pop().toLowerCase();
//Allowed file types
if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
swal('File Error', 'tidak bisa upload', 'warning'); 
$('#foto').val('');
}else{ 
readURL(this);
}
});


$('#cupdate').submit(function(e){
   e.preventDefault();
   var username = $('#username').val();
   var password = $('#password').val();
   var password_ul = $('#password_ul').val();
   var nama = $('#nama').val();
   var email = $('#email').val();
//   var foto = $('#foto').val();
   if (username == '') {
        swal('Keterangan','Username tidak boleh kosong','error');
    }else if(password ==''){
        swal('Keterangan','Password tidak boleh kosong','error');
    }else if(password_ul==''){
        swal('Keterangan','Ulangi Password tidak boleh kosong','error');
    }else if(password != password_ul){
        swal('Keterangan','password tidak sama silahkan ulangi','error');
    }else if(nama == ''){
        swal('Keterangan','Nama tidak boleh kosong','error');
    }else if(email == ''){
        swal('Keterangan','email tidak boleh kosong','error'); 
    }else{

  var datastring = new FormData(this);  
  $.ajax({
    url:'<?= base_url('profile/action_insert') ?>',
    type:'post',
    data: datastring, 
    cache: false,
    contentType: false,
    processData: false,  
    beforeSend:function(){
      $('#cupdate').attr("disabled","disabled");
      $('#cupdate').css("opacity",".5"); 
    },success:function(data){
      swal('Keterangan','Data username dan password berhasil di update','success');
      $('#cupdate').css("opacity","");
      $("#cupdate").removeAttr("disabled");      
    },error:function(data){
      swal('Keterangan','Data username dan password gagal di update','warning');
    }
  });  
}
  });  
});



</script>