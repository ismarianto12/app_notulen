$(function(){
	$('#clogin').submit(function(event){
		event.preventDefault();
		username = $('input[name="username"]').val();
		password = $('input[name="password"]').val();
		if (username == '') {
			$('#notifikasi').html('<div class="alert alert-danger"><i class="fa fa-close"></i>Username Tidak Boleh Kosong</div>');
		}else if(password == ''){
			$('#notifikasi').html('<div class="alert alert-warning"><i class="fa fa-close"></i>Password Tidak Boleh Kosong</div>');
		}else{ 
			$.ajax({
				url:base_url()+'/Akses/login',
				type: 'POST',
				data: {username : username , password : password},
				success:function(data){
					if(data == 'y'){ 
						swal('Keterangan','Sedang Mengalihkan ...','success');
						window.location.href=base_url()+'?rg=welcome';
					}else{
						$('#notifikasi').html('<div class="alert alert-danger"><i class="fa fa-close"></i>Username dan Password yang anda masukan salah .</div>');
					} 
				},
				error:function(jqXHR, textStatus, errorThrown){
					alert('GAgal');
				} 
			}); 
		} 

	});

});