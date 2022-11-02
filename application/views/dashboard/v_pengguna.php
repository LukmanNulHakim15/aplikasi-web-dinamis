<div class="content-wrapper">
	<div class="content-header">
		<h1>
			Pengguna
			<small>Pengguna Website</small>
		</h1>
	</div>
	<div class="content" style="border-radius: 21px;">
		<div class="row">
			<div class="col-lg-12">
				<button type="button" class="btn btn-sm btn-flat btn-danger waves-effect" data-toggle="modal" data-target="#modal-pengguna"  style="border-radius: 21px;">
								<i class="fas fa-plus" aria-hidden="true"></i> Buat Pengguna Baru
								</button>
				<br>
				<br>
				<div class="box box-primary" style="width: 100% !important; font-size: 12px;">
					<div class="box-header">
						<h3>Pengguna</h3>
					</div>
					<div class="box-body">
						<table id="table-pengguna" class="table dt-responsive nowrap" style="width: 100% !important; font-size: 12px;">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th>Opsi</th>	
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Username</th>
									<th>Level</th>
									<th>Status</th>
									<th>Opsi</th>	
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-flex" id="modal-pengguna" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header" style="background-color: skyblue;">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Data Pengguna</h4>
			</div>
			<div class="modal-body model-container">
				<div class="container">
					<form id="form-pengguna" method="post" accept-charset="utf-8" autocomplete="off">
						<input type="text" name="id" id="id" class="hidden">
						<div class="form-group row">
							<label class="col-sm-2">Nama</label>
							<div class="col-sm-6">
								<input type="text" name="name" id="name" class="form-control" title="name" placeholder="Name">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Email</label>
							<div class="col-sm-6">
								<input type="email" name="email" id="email" class="form-control" placeholder="email" title="email">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Username</label>
							<div class="col-sm-6">
								<input type="text" name="username" id="username" class="form-control" title="Username" placeholder="Username">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Password</label>
							<div class="col-sm-6">
								<input type="password" name="password" id="password" class="form-control" title="Password" placeholder="Password">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Level</label>
							<div class="col-sm-6">
								<select id="level" name="lavel" required class="form-control">
									<option>Pilih Level</option>
									<option value="penulis">Penulis</option>
									<option value="admin">Admin</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-2">Status</label>
							<div class="col-sm-6">
								<select id="level" name="lavel" required class="form-control">
									<option>Pilih Status</option>
									<option value="aktif">Aktif</option>
									<option value="nonaktif">Non Aktif</option>
								</select>
							</div>
						</div>
						<button type="submit" value="1" hidden="1" id="savePengguna"></button>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" onclick="$('#savePengguna').click()" class="btn btn-sm waves-effect waves-light btn-default btn-block" style="border-radius: 5px; background-color: skyblue;">Save Pengguna</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {

		let table;

		table = $('#table-pengguna').DataTable({
			ajax: {
				url: "<?php echo base_url(''); ?>"
			},
			response: true,
			language:{
				zeroRecord: '<center> Data Unavailable </center>'
			}
		})
	})
</script>