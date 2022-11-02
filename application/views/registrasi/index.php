<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rajin Ngoding | Registrasi</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
	<div class="container">
		<div class="row align-items-center justify-content-center vh-100">
			<div class="col-lg-5">
				<div class="shadow">
					<div class="row">
						<div class="col-lg-12">
								<div class="p-5 ps-4 text-dark">
									<h5 class="mb-1 fw-bold">Silahkan Registrasi Terlebih dahulu</h5>
									<p>Silahkan Isi Semua Kolom Dibawah Ini</p>
									<div class="form-group">
										<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" class="form-control" required placeholder="Email">
									</div>
									<div class="form-group">
										<input type="text" name="telpon" id="telpon" class="form-control" pattern="[0-9]" required placeholder="Nomor Telpon (Hanya Angka)">
									</div>
									<div class="form-group">
										<input type="text" name="username" id="username" class="form-control" required placeholder="Username">
									</div>
									<div class="form-group">
										 <input type="password" name="password" id="password" class="form-control" placeholder="password" required>
									</div>
									<div class="form-group">
										<select id="level" name="level" class="form-control" required>
											<option>Silahkan Pilih</option>
											<option value="admin">Admin</option>
											<option value="penulis">Penulis</option>
										</select>
									</div>
									<button class="btn btn-danger btn-block btn-success" id="btn-registrasi">Registrasi</button>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {

    		$('#btn-registrasi').click(function(event) {
	    			event.preventDefault();
    			if(confirm("Apakah data yang anda input sudah sesuai ?")) {
	    			var nama = $('#nama').val();
	    			var email = $('#email').val();
	    			var telpon = $('#telpon').val();
	    			var username = $('#username').val();
	    			var password = $('#password').val();
	    			var level = $('#level').val();

	    			if (nama.length == "") {
	    				Swal.fire({
	    					type: 'Warning',
	    					title: 'Oops...',
	    					text: 'Nama lengkap wajib diisi'
	    				});
	    			} else if (email.length == "") {
	    				Swal.fire({
	    					type:'warning',
	    					title: 'Oops...',
	    					text: "Email wajib diisi"
	    				});
	    			} else if (telpon.length == "") {
	    				Swal.fire ({
	    					type: 'warning',
	    					title: 'Oops...',
	    					text: 'Nomor Telpon Wajib Diisi'
	    				});
	    			} else if (username.length == "") {
	    				Swal.fire ({
	    					type: 'Warning',
	    					title: 'Oops...',
	    					text: 'Username wajib diisi'
	    				});
	    			} else if (password.length == "") {
	    				Swal.fire ({
		    				type: 'Warning',
		    				title: 'Oops...',
		    				text: 'Password wajib diisi'
	    				});
	    			} else {
	    				$.ajax({
	    					url: "<?php echo base_url('registrasi-save'); ?>",
	    					method: "POST",
	    					data: {
	    						nama: nama,
	    						email: email,
	    						telpon: telpon,
	    						username: username,
	    						password: password,
	    						level:level
	    					},
	    					success:function(response) {
	    						if(response.code == 200) {
	    							Swal.fire({
	    								type: "success",
	    								title: "Registrasi Anda Berhasil",
	    								text: "Silahkan Anda Login"
	    							})
	    							.then(function (){
	    								window.location.href = "Login";
	    							});
	    						} else if (response.code == 500) {
	    							Swal.fire ({
	    								type: 'error',
	    								title: 'Oops...',
	    								text: "Terjadi kesalahan"
	    							});
	    						}
	    					}
	    					
	    				})
	    			}
    				
    			}
    		})
    	})
    </script>
</html>