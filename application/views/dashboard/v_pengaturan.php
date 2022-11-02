<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengaturan
			<small>Update pengaturan website</small>
		</h1>
	</section>
	<section class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-6">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">
							Pengaturan
						</h3>
					</div>
					<div class="box-body">
						<form method="post" accept-charset="utf-8" autocomplete="off" id="form-pengaturan" enctype="multipart/form-data" >
							<input type="text" name="id" id="id" class="hidden">
							<div class="form-group row">
								<label class="col-sm-4">Name Website</label>
								<div class="col-sm-4">
									<input  type="text" name="name" id="name" class="form-control" placeholder="Name" title="Name">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Deskripsi Website</label>
								<div class="col-sm-4">
									<input  type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" title="Deskripsi">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Logo Website</label>
								<div class="col-sm-4">
									<input type="file" name="logo" id="logo">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Link Facebook</label>
								<div class="col-sm-4">
									<input type="text" name="linkfb" id="linkfb" class="form-control" placeholder="Link Facebook" title="Link Facebook">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Link Twitter</label>
								<div class="col-sm-4">
									<input type="text" name="linktwt" id="linktwt" class="form-control" placeholder="Link Twitter" title="Link Twitter">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Link Instagram</label>
								<div class="col-sm-4">
									<input type="text" name="linkig" class="form-control" id="linkig" placeholder="Link Instagram" title="Link Instagram">
								</div>
							</div>
							<div class="form-group row" style="margin-top: 20px;">
								<label class="col-sm-4">Link Github</label>
								<div class="col-sm-4">
									<input type="text" name="linkgit" id="linkgit" class="form-control" placeholder="Link Github" title="Link Github">
								</div>
							</div>
							<button class="btn btn-danger btn-block btn-success" id="btn-update">Update</button>  
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('#btn-update').click(function(event) {
			event.preventDefault();
			if(confirm("Apakah data yang anda input sudah benar?")) {
				var form_data = new FormData($('#form-pengaturan')[0]);
				$.ajax({
					url:"<?php echo base_url('save-pengaturan'); ?>",
					method: 'POST',
					dataType: 'JSON',
					data: form_data,
					processData: false,
					contentType: false,
					cache:false,
					async:false,
					success:function(response) {
						var data = response.data;
						if(data.code == 200) {
							ClearFormData('#form-pengaturan');
						}
					}
				})  
				
			}
		})


		async function getData()
		{
			url = "<?php echo base_url('get-data'); ?>";
			await $.post(url).done((res,status,xhr)=> {
				var data = res.data;
				if(data) {
					$('#name').val(data.name);
					$('#deskripsi').val(data.deskripsi);
					$('#linkfb').val(data.link_facebook);
					$('#linktwt').val(data.link_twitter);
					$('#linkig').val(data.link_instagram);
					$('#linkgit').val(data.link_github);

				}
			})
		}

		getData();
	})
</script>