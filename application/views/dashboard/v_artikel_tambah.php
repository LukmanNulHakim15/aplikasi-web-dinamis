<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Artikel
			<small>Tulis Artikel Baru</small>
		</h1>
	</section>
	<section class="content">
		<a href="<?php echo base_url('dashboard'); ?>" class="btn btn-sm btn-primary">Kembali</a>
		<br/>
		<br/>
		<form id="form-tambah-artikel" method="post" accept-charset="utf-8" autocomplete="off" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">
					<div class="box box-primary">
						<div class="box-body">
							<div class="box-body">
								<div class="form-group">
									<label>Judul</label>
									<input type="text" class="hide" name="id" id="id">
									<input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul Artikel">
									<br />

								</div>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label>Konten</label>
									<br/>
									<textarea class="form-control" id="editor" name="editor" ></textarea>
								</div>
							</div>
						<!-- 	<div class="box-body">
							<div class="form-group">
								<label>kategori</label>
								<select class="form-control" name="kategori" id="kategori">
									<option value="">Pilih Kategori</option>
								</select>
								<br/>
							</div>
							<div class="form-group">
								<label>status</label>
								<select class="form-control" name="status" id="status">
									<option value="">Pilih Kategori</option>
									<option value="Draft">Draft</option>
									<option value="Publish">Publish</option>
								</select>
								<br/>
							</div>
							<br/> <br/>
							<div class="form-group">
								<label>Gambar Sampul</label>
								<input type="file" name="sampul" id="sampul">
								<br/>
							</div>
							<br/> <br/>
							<input type="submit" name="" class="btn btn-success btn-block">
						</div> -->
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="box box-primary">
						<div class="box-body">
							<div class="form-group">
								<label>kategori</label>
								<select class="form-control" name="kategori" id="kategori">
									<option value="">Pilih Kategori</option>
								</select>
								<br/>
							</div>
							<div class="form-group">
								<label>status</label>
								<select class="form-control" name="status" id="status">
									<option value="">Pilih Kategori</option>
									<option value="Draft">Draft</option>
									<option value="Publish">Publish</option>
								</select>
								<br/>
							</div>
							<br/> <br/>
							<div class="form-group">
								<label>Gambar Sampul</label>
								<input type="file" name="sampul" id="sampul">
								<br/>
							</div>
							<br/> <br/>
							<input type="submit" name="" class="btn btn-success btn-block">
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		const getDataProvinsi = () => {
			url = "<?php echo base_url('kategori-dropdown') ?>"; 
			$.post(url, function(res) {
				if(res) {
					$('#kategori').empty();
					$('#kategori').append("<option value='' selected='true' disabled='true'> Pilih Kategori </option>");
					const data = res.data;
					if(data) {
						$.each(data, function(index,val) {
							$('#kategori').append(`<option value="${val.id}"> ${val.kategori_name} </option>`);
						});
					}
				}
			}); 
		};
		getDataProvinsi();


		$('#form-tambah-artikel').submit(function(event) {
			event.preventDefault();
			if(confirm("apakah data yang anda input sudah benar ?")) {

				var form_data = new FormData($('#form-tambah-artikel')[0]);
				$.ajax({
					url:"<?php echo base_url('save-artikel'); ?>",
					type: 'POST',
					data: form_data,
					processData: false,
					contentType: false,
					cache:false,
					async:false,
					success: function(response) {
						alert("Save data berhasil");
					}
				});
			}
		});
	})

	
</script>
