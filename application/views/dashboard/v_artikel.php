<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Artikel
			<small>Pengisian Artikel</small>
		</h1>
	</section>
	<section class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-12">
				<!-- <a href="<?php echo base_url('artikel/artikel_tambah'); ?>" class="btn btn-sm btn-primary">Buat Artikel Baru</a> -->
				<button type="button" class="btn btn-sm btn-flat btn-danger waves-effect" data-toggle="modal" data-target="#modal-wifi-hotspot"  style="border-radius: 21px;">
								<i class="fas fa-plus" aria-hidden="true"></i> Add Data Kategori
								</button>
				<br>
				<br>
				<div class="box box-primary" style="width: 100% !important; font-size: 12px">
					<div class="box-header">
						<h3 class="box-title">Artikel Baru</h3>	
					</div>
					<div class="box-body">
						<table id="table-artikel" class="table dt-responsive nowrap" style="width: 100% !important; font-size: 12px">
							<thead>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Artikel</th>
									<th>Author</th>
									<th>Kategori</th>
									<th>Gambar</th>
									<th>Status</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Tanggal</th>
									<th>Artikel</th>
									<th>Author</th>
									<th>Kategori</th>
									<th>Gambar</th>
									<th>Status</th>
									<th>Opsi</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<div class="modal fade modal-flex" id="modal-wifi-hotspot" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: skyblue;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Data Katagori</h4>
				</div>
			<div class="modal-body model-container">
				<div class="container">
					<form id="form-wifi-hotspot" method="post" accept-charset="utf-8" autocomplete="off">
						<input type="hidden" name="id" id="id" class="id">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label">Judul Artikel</label>
							<div class="col-sm-7">
								<input type="text" name="judul" id="judul" pattern="[a-zA-Z0-9\s]{3,35}" minlength="2" maxlength="35" placeholder="Judul Artikel" data-toggle="tooltip" data-placment="top" title="Judul Artikel" class="form-control" required="1">
								<!-- <span id="name" name="name"></span> -->
							</div>
						</div>
					<div class="form-group row">
							<label class="col-sm-2 col-form-label">Konten</label>
							<div class="col-sm-7">
								<textarea type="text" name="isi" id="isi"   placeholder="Judul Artikel" data-toggle="tooltip" data-placment="top" title="Judul Artikel" class="form-control" required="1" style="height: 400px;"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Kategori</label>
							<div class="col-sm-7">
								<select class="form-control" name="kategori" id="kategori">
									<option value="">Pilih Kategori</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Status</label>
							<div class="col-sm-7">
								<select class="form-control" name="status" id="status">
									<option value="">Pilih Status</option>
									<option value="draft">Draft</option>
									<option value="publish">Publish</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Gambar Sampul</label>
							<div class="col-sm-7">
								<input type="file" name="sampul" id="sampul">
							</div>
						</div>
						<button id="save-wifi-hotspot" type="submit" value="1" hidden="1">
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#save-wifi-hotspot').click()" class="btn btn-sm waves-effect waves-light btn-default btn-block" style="border-radius: 5px; background-color: skyblue;">Save Artikel</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		const getDataKategori = () => {
			url = "<?php echo base_url('kategori-dropdown'); ?>";
			$.post(url, function(response) {
				if(response) {
					$('#kategori').empty();
					$('#kategori').append("<option value='' selected='true' disabled='true'> Pilih Kategori </option>");
					const data = response.data;
					$.each(data, function(index, val){
						$('#kategori').append(`<option value="${val.id}"> ${val.kategori_name} </option>`);
					})
				}
			})
		}
		getDataKategori();

		


		$('#form-wifi-hotspot').submit(function(event) {
			event.preventDefault();
			if(confirm("apakah data yang anda input sudah benar ?")) {
				var form_data = new FormData($('#form-wifi-hotspot')[0]);
				var id = $('#id').val();
				if(id) {
					$.ajax({
						url:"<?php echo base_url('update-artikel'); ?>",
						type: 'POST',
						data: form_data,
						processData: false,
						contentType: false,
						cache:false,
						async:false,
						success: function(response) {
							table.ajax.reload();
							ClearFormData('#form-wifi-hotspot');
							alert("Update data berhasil");
							$('#modal-wifi-hotspot').modal('hide');
							// alert("Save data berhasil");
						}
					});
				} else {
					$.ajax({
						url:"<?php echo base_url('save-artikel'); ?>",
						type: 'POST',
						data: form_data,
						processData: false,
						contentType: false,
						cache:false,
						async:false,
						success: function(response) {
							table.ajax.reload();
							$('#modal-wifi-hotspot').modal('hide');
							ClearFormData('#form-wifi-hotspot');
							alert("Save data berhasil");
							$('#modal-wifi-hotspot').modal('hide');
						}
					});
				}
			}
		});


		let table;

		table = $('#table-artikel').DataTable({
			ajax:{
				url:"<?php echo base_url('table-artikel'); ?>"
			},
			response:true,
			language:{
				zeroRecord: '<center> Data Unavailable </center>'
			},
		});

		$('#table-artikel').on('click', '#update', function(event){
			event.preventDefault();
			let id = $(this).data('id');
		
			if(!id) {
				alert('Id tidak ditemukan');
			}
			const url = "<?php echo base_url('artikel-id'); ?>";
			$.post(url, {id: id}).done((res,status,xhr)=> {

				const data = res.data;
				if(data) {
					$('#id').val(data.id);
					$('#judul').val(data.artikel_judul);
					$('#editor').val(data.artikel_konten);
					$('#modal-wifi-hotspot').modal('show');
					
				}
			});
		});

		$(function () {
			CKEDITOR.instance('isi', {
				filebrowserImageBrowseUrl : '<?php echo base_url('assets/kcfinder/browser.php'); ?>',
				height: '400px'
			});
		});

		$('#table-artikel').on('click', '#delete', function(event) {
			event.preventDefault();
			if(confirm("Apakah anda ingin menghapus data ini ?")) {
				var id = $(this).data('id');
				if(!id) {
					alert("Data tidak ditemukan");
				}
				var url = "<?php echo base_url('artikel-delete'); ?>";
				$.post(url,{id:id}).done((res,status,xhr)=> {
					table.ajax.reload();
					if(xhr.status == 200) {
						alert("Data anda berhasil dihapus");
					}
				})

			} else {
				alert("Anda membatalkan untuk menghapus data");
			}
		});

	});
</script>