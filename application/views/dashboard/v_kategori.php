<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori
			<small>Kategori Artikel</small>
		</h1>
	</section>
	<section class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-sm btn-flat btn-danger waves-effect" data-toggle="modal" data-target="#modal-wifi-hotspot"  style="border-radius: 21px;">
								<i class="fas fa-plus" aria-hidden="true"></i> Add Data Kategori
								</button>
				<br/>
				<br/>
				<div class="box box-primary" style="width: 100% !important; font-size: 12px">
					<div class="box-header">
						<h3 class="box-title">Kategori</h3>
					</div>
					<div class="box-body" >
						<table id="table-wifi-hotspot" class="table dt-responsive nowrap" style="width: 100% !important; font-size: 12px">
								<thead>
									<tr>
										<th>No.</th>
										<th>Kategori</th>
										<th>Slug</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>No.</th>
										<th>Kategori</th>
										<th>Slug</th>
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
	<div class="modal-dialog" role="document">
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
							<label class="col-sm-1 col-form-label">Nama</label>
							<div class="col-sm-4">
								<input type="text" name="name" id="name" pattern="[a-zA-Z0-9\s]{3,35}" minlength="2" maxlength="35" placeholder="Nama Produk" data-toggle="tooltip" data-placment="top" title="produk name" class="form-control" required="1">
								<!-- <span id="name" name="name"></span> -->
							</div>
						</div>
						<button id="save-wifi-hotspot" type="submit" value="1" hidden="1">
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#save-wifi-hotspot').click()" class="btn btn-sm waves-effect waves-light btn-default btn-block" style="border-radius: 5px; background-color: skyblue;">Save Wifi Hotspot</button>
			</div>
		</div>
	</div>
</div>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$('#form-wifi-hotspot').trigger("reset");

		let table;

		table = $('#table-wifi-hotspot').DataTable({
			ajax: {
				url: "<?php echo base_url('table-kategori'); ?>"
			},
			response: true,
			language: {
				zeroRecord: '<center> Data Unavailable </center>'
			},
		});


		$('#form-wifi-hotspot').submit(function(event) {
			event.preventDefault();

			if(confirm("Apakah data yang anda input sudah benar ?")) {
				var id = $('#id').val();
				if(id) {
					var url = "<?php echo base_url('update-kategori'); ?>";
				}else {
					var url = "<?php echo base_url('save-kategori'); ?>";
				}

				$.post(url, $(this).serialize()).done((res,status,xhr)=> {
					table.ajax.reload();
					if(xhr.status == 200) {
						Swal.fire({
							type: 'success',
							title: 'Berhasil',
							text: 'Selamat anda berhasil menyimpan data'
						});
						$('#modal-wifi-hotspot').modal('hide');
						ClearFormData('#form-wifi-hotspot');
					}
				}).fail((xhr,status,err)=>{
					if(xhr.status == 401) {
						Swal.fire({
							type: 'error',
							title: 'Gagal',
							text: 'Gagal simpan data'
						});
					} else if(xhr.status == 402) {
						Swal.fire({
							type: 'error',
							title: 'Gagal',
							text: 'Tidak sesuai pettern'
						});
					}
				});

			} else {
				var gagal = alert("Batal menyimpan data");
			}

		});



		$('#table-wifi-hotspot').on('click', '#edit', function(event) {
			event.preventDefault();
			var id = $(this).data('id');
			// console.log(id);
			if(!id) {
				alert('Data tidak diketahui');
			}
			var url = "<?php echo base_url('table-kategori-id'); ?>";
			$.post(url,{id:id}).done((res,status,xhr)=> {
				var data = res.data;

				if(data) {

					$('#id').val(data.id);
					$('#name').val(data.kategori_name);
					$('#modal-wifi-hotspot').modal('show');
				}
			})
		});


		$('#table-wifi-hotspot').on('click','#delete', function(event) {
			event.preventDefault();

			var id = $(this).data('id');
			if(confirm("Apakah anda yakin akan menghapus data ini ?")) {
				if(!id) {
					alert("Id yang anda cari tidak ada");
				}

				var url = "<?php echo base_url('table-delete-kategori'); ?>";
				$.post(url,{id:id}).done((res,status,xhr)=> {
						table.ajax.reload();
					if(xhr.status == 200) {
						alert("Data anda berhasil dihapus");
						$('#modal-wifi-hotspot').modal('hide');
					}
				})
			}
		})
	})
</script>