<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Ganti Password
			<small>Ubah password anda</small>
		</h1>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Ganti Password</h3>
					</div>
					<div class="box-body">
						<?php 
							if(isset($_GET['alert'])) {
								if($_GET['alert']=="sukses") {
									echo "<div class='alert alert-success'>Password telah diubah</div>";
								} else if ($_GET['alert']=="gagal") {
									echo "<div class='alert alert-denger'>Maaf, password lama yang anda masukkan salah</div>";
								}
							}

						?>

						<form method="post" accept-charset="utf-8" autocomplete="off" id="ganti-password">
							<input class="hide" id="id" name="id">
							<div class="box-body">
								<div class="form-group">
									<label>Password Lama</label>
									<input type="password" name="password_lama" id="password_lama" class="form-control" placeholder="Masukkan password lama anda">
									<!-- <?php echo form_error('password_lama'); ?> -->
								</div>
								<hr>
								<div class="form-group">
									<label>Password Baru</label>
									<input type="password" name="password_baru" id="password_baru" class="form-control" placeholder="Masukkan password baru anda">
								</div>
								<div class="form-group">
									<label>Konfirmasi Password</label>
									<input type="password" name="konfirmasi_password" id="konfirmasi_password" class="form-control" placeholder="Konfirmasi password baru anda">
									<!-- <?php form_error('konfirmasi_password'); ?> -->
								</div>
							</div>
							<input type="submit" class="btn btn-primary" value="Ganti Password">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(event){

		$('#ganti-password').submit(function(event) {
			event.preventDefault();
			
			var url = "<?php echo base_url('konfirmas-password'); ?>";

			$.post(url,$(this).serialize()).done((res,status,xhr)=> {
				if(xhr.status == 200) {
					Swal.fire({
                            type: "success",
                            title: "Sukses",
                            text: "Selamat password anda berhasil diganti"
                        });
				} 
			}).fail((xhr,status,err)=> {
				if(xhr.status == 500) {
					Swal.fire({
                        type: "error",
                        title: "Gagal",
                        text: "Password lama anda salah"
                    })
				}
			})
		})
	});
	
</script>