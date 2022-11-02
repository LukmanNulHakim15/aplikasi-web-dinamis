<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pages
			<small>Management Website</small>
		</h1>
	</section>
	<section class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-sm btn-flat btn-danger waves-effect" data-toggle="modal" data-target="#modal-page" style="border-radius: 21px;">
								<i class="fas fa-plus-circle" aria-hidden="true"></i> Add Data Pages</button>
								<br> 
								<br>
				<div class="box box-primary" style="width:100% !important; font-size: 12px">
					<div class="box-header">
						<h3 class="box-title">
							Pages
						</h3>
					</div>
					<div class="box-body">
						<table id="table-pages" class="table dt-responsive nowrap" style="width: 100% !important; font-size: 12px">
							<thead>
								<tr>
									<th>No</th>
									<th>Judul Halaman</th>
									<th>URL Slug</th>
									<th>Opsi</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Judul Halaman</th>
									<th>URL Slug</th>
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
<div class="modal fade modal-flex" id="modal-page" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: skyblue;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Data Katagori</h4>
			</div>
			<div class="modal-body model-container">
				<div class="container">
					<form id="form-pages" method="post" accept-charset="utf-8" autocomplete="off">
						<input type="text" name="id" id="id" class="hidden">
						<div class="form-group row">
							<label class="col-sm-2">Judul Halaman</label>
							<div class="col-sm-7">
								<input type="text" name="judul_halaman" id="judul_halaman" class="form-control" title="Judul Halaman" placeholder="Judul Halaman">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Konten Halaman</label>
							<div class="col-sm-7">
								<textarea class="form-control" name="konten_halaman" id="konten_halaman" data-toggle="tooltip" data-placment="top" style="height: 400px;"></textarea>
							</div>
						</div>
						<button id="save-wifi-hotspot" type="submit" value="1" hidden="1">
						</button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#save-wifi-hotspot').click()" class="btn btn-sm waves-effect waves-light btn-default btn-block" style="border-radius: 5px; background-color: skyblue;">Save Pages</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {

		 // $(function () {
			//  var data = CKEDITOR.replace('konten_halaman');
			//  data.getData();
			// });

			// var editor = CKEDITOR.instances['editor1'];
			// editor.getData();


		 let table;
		 table = $('#table-pages').DataTable({
		 	ajax:"<?php echo base_url('table-pages'); ?>",
		 	response: true,
		 	language: {
		 		zeroRecord:'<center> Data Unavailable</center>'
		 	}
		 });


		 $('#form-pages').submit(function(event) {
		 	event.preventDefault();

		 	if(confirm("Apakah data yang anda input sudah benar?")) {
		 		var id = $('#id').val(), url;
		 		if(id) {
		 			url = "<?php echo base_url('update-pages'); ?>";
		 		} else {
		 			url = "<?php echo base_url('save-pages'); ?>";
		 		}

		 		$.post(url, $(this).serialize()).done((res,status,xhr)=> {
		 			table.ajax.reload();
		 			if(xhr.status == 200) {
		 				alert("Data anda berhasil disimpan");
		 				ClearFormData('#form-pages');
		 				$('#modal-page').modal('hide');
		 			}
		 		}).fail((res,status,err)=> {
		 			if(xhr.status == 500) {
		 				alert("Data anda gagal disimpan");
		 				ClearFormData('#form-pages');
		 				$('#modal-page').modal('hide');
		 			}
		 		})
		 	}
		 });


		 $('#table-pages').on('click', '#update', function(event) {
		 	event.preventDefault();
		 	var id = $(this).data('id');

		 	if(!id) {
		 		alert("Data yang anda cari tidak ditemukan");
		 	}
		 	var url = "<?php echo base_url('pages-id'); ?>"
		 	$.post(url,{id:id}).done((res,status,xhr)=> {
		 		var data = res.data;
		 		if(data) {
		 			$('#id').val(data.id);
		 			$('#judul_halaman').val(data.halaman_judul);
		 			$('#konten_halaman').val(data.halaman_konten);
		 			$('#modal-page').modal('show');
		 		}
		 	})
		 });

		 $('#table-pages').on('click','#delete', function(event) {
		 	event.preventDefault();
		 	if(confirm("Apakah anda yakin ingin menghapus data ini? ")) {
			 	var id = $(this).data('id');
			 	if(!id) {
			 		alert("Data yang anda cari tidak ditemukan");
			 	}

			 	var url = "<?php echo base_url('delete/pages'); ?>";
			 	$.post(url,{id:id}).done((res,status,xhr)=> {
			 		table.ajax.reload();
			 		if(xhr.status == 200) {
			 			alert("Data anda berhasil dihapus");
			 		}
			 	})
		 	} else {
		 		alert("Anda membatalkan hapus data");
		 	}
		 })

	})
</script>