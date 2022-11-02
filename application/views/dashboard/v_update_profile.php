<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Profile
			<small>Update Profile Pengguna</small>
		</h1>
	</section>
	<section class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							Update Profile
						</h3>
					</div>
					<div class="box-body">
						<form method="post" accept-charset="utf-8" autocomplete="off" id="update_profile">
							<input type="text" name="id" class="hidden" id="id">
							<div class="form-group row">
								<label class="col-sm-2">Nama</label>
								<div class="col-sm-4">
									<input type="text" name="name" id="name" class="form-control" placeholder="Inputkan nama anda" title="Nama">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2">Email</label>
								<div class="col-sm-4">
									<input type="email" name="email" id="email" class="form-control" placeholder="email" title="email">
								</div>
							</div>
							<input type="submit" class="btn btn-success" value="Update">
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	$('#update_profile').submit(function(event) {
		event.preventDefault();
		if(confirm("Apakah anda yakin ingin mengganti profile anda?")) {
			var url = "<?php echo base_url('update-profile'); ?>";
			$.post(url,$(this).serialize()).done((res,status,xhr)=> {
				location.reload();
				if(xhr.status == 200) {
					alert("anda berhasil update profile");
					ClearFormData('#update_profile');
				}
			})
		}
	});
</script>