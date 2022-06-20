 <!-- Begin Page Content -->
 <div class="container-fluid">
 	<div class="d-sm-flex align-items-center justify-content-between mb-4">
 		<h2 class="h4 mb-0 text-gray-800"><?php echo $title; ?></h2>
 		<!-- <a href="#" class="btn btn-sm btn-primary shadow-sm float-right" data-toggle="modal" data-target="#edit-profile"><i class="fas fa-download fa-sm text-white-50"></i> Edit Profile</a> -->
 	</div>

 	<!-- Content Row -->
 	<div class="row">
 		<!-- Earnings (Monthly) Card Example -->
 		<div class="col-xl-3 col-md-6 mb-4">
 			<div class="card border-left-primary shadow h-100 py-2">
 				<div class="card-body">
 					<div class="row no-gutters align-items-center">
 						<div class="col mr-2">
 							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Menunggu Respon</div>
 							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending; ?></div>
 						</div>
 						<div class="col-auto">
 							<i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<!-- Earnings (Monthly) Card Example -->
 		<div class="col-xl-3 col-md-6 mb-4">
 			<div class="card border-left-success shadow h-100 py-2">
 				<div class="card-body">
 					<div class="row no-gutters align-items-center">
 						<div class="col mr-2">
 							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Diterima</div>
 							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $diterima; ?></div>
 						</div>
 						<div class="col-auto">
 							<i class="fas fa-check fa-2x text-gray-300"></i>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="col-xl-3 col-md-6 mb-4">
 			<div class="card border-left-danger shadow h-100 py-2">
 				<div class="card-body">
 					<div class="row no-gutters align-items-center">
 						<div class="col mr-2">
 							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Permintaan Ditolak</div>
 							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ditolak; ?></div>
 						</div>
 						<div class="col-auto">
 							<i class="far fa-times-circle fa-2x text-gray-300"></i>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 		<div class="col-xl-3 col-md-6 mb-4">
 			<div class="card border-left-warning shadow h-100 py-2">
 				<div class="card-body">
 					<div class="row no-gutters align-items-center">
 						<div class="col mr-2">
 							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Permintaan</div>
 							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total; ?></div>
 						</div>
 						<div class="col-auto">
 							<i class="fas fa-cubes fa-2x text-gray-300"></i>
 						</div>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 	<?php if ($permintaan_masuk == 0) : ?>
 	<?php else : ?>
 		<div class="row">
 			<div class="col-md-12">
 				<div class="alert alert-danger alert-dismissible fade show" role="alert">
 					<strong><a href="<?php echo base_url('user/permintaan_masuk'); ?>" class="text-decoration-none"><i class="far fa-bell"></i>  <?php echo $permintaan_masuk; ?> Permintaan Masuk Belum Di Respon.</strong></a>
 					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 						<span aria-hidden="true">&times;</span>
 					</button>
 				</div>
 			</div>
 		</div>
 	<?php endif; ?>
	<div class="card mb-4 py-3 border-bottom-danger">
        <div class="card-body">
			<strong>Sebelum Mengajukan Permintaan, Silahkan <a href="<?php echo base_url('assets\dist\form_permintaan.xlsx'); ?>" class="text-decoration-none">Download Form Permintaan Disini</a></strong></a>
        </div>
    </div>
 	<div class="row">
 		<div class="col-xl-4 col-lg-7">
 			<div class="card shadow mb-4">
 				<div class="card-header">
 					<h6 class="m-0 font-weight-bold text-primary">Profile </h6>
 				</div>
 				<div class="card-body">
 					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
 					<?php echo $this->session->flashdata('msg'); ?>
 					<?php if (validation_errors()) { ?>
 						<div class="alert alert-danger">
 							<strong><?php echo strip_tags(validation_errors()); ?></strong>
 							<a href="" class="float-right text-decoration-none" data-dismiss="alert"><i class="fas fa-times"></i></a>
 						</div>
 					<?php } ?>
 					<div class="text-center">
 						<img class="profile-user-img img-fluid rounded-circle" src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" alt="User profile picture" style="width:120px;height:120px;">
 					</div>
 					<h5 class="profile-username text-center mt-1 mb-1"><?php echo $user['nama']; ?></h5>
 					<ul class="list-group list-group-unbordered mb-3">
 						<li class="list-group-item">
 							<b>Tgl Register</b> <a class="float-right"><?php echo format_indo($user['date_created']); ?></a>
 						</li>
 						<li class="list-group-item">
 							<b>Level</b> <a class="float-right"><?php echo $user['level']; ?></a>
 						</li>
 						<li class="list-group-item">
 							<b>Email</b> <a class="float-right"><?php echo $user['email']; ?></a>
 						</li>
 						<li class="list-group-item">
 							<b>No HP</b> <a class="float-right"><?php echo $user['hp']; ?></a>
 						</li>
 					</ul>
 					<button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#edit-profile"><b>Ubah Profile</b></button>
 					<button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#edit-pass"><b>Ubah Password</b></button>
 				</div>
 			</div>
 		</div>

 		<!-- Pie Chart -->
 		<div class="col-xl-8">
 			<div class="card shadow mb-4">
 				<!-- Card Header - Dropdown -->
 				<div class="card-header ">
 					<h6 class="m-0 font-weight-bold text-primary">Activity</h6>
 				</div>
 				<!-- Card Body -->
 				<div class="card-body">
 					<div class="chart-area">
 						<canvas id="myChart" style="width:30%;height:30%;"></canvas>
 						<script>
 							var ctx = document.getElementById("myChart").getContext('2d');
 							var myChart = new Chart(ctx, {
 								type: 'bar',
 								data: {
 									labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sept", "Okt", "Nov", "Des"],
 									datasets: [{
 										label: 'Total Permintaan <?php echo date('Y'); ?>',
 										data: ['<?php echo $januari; ?>', '<?php echo $februari; ?>', '<?php echo $maret; ?>', '<?php echo $april; ?>', '<?php echo $mei; ?>', '<?php echo $juni; ?>', '<?php echo $juli; ?>', '<?php echo $agustus; ?>', '<?php echo $september; ?>', '<?php echo $oktober; ?>', '<?php echo $november; ?>', '<?php echo $desember; ?>'],
 										backgroundColor: [
 											'rgba(255, 99, 132, 0.2)',
 											'rgba(54, 162, 235, 0.2)',
 											'rgba(255, 206, 86, 0.2)',
 											'rgba(75, 192, 192, 0.2)',
 											'rgba(153, 102, 255, 0.2)',
 											'rgba(255, 159, 64, 0.2)',
 											'rgba(255, 99, 132, 0.2)',
 											'rgba(54, 162, 235, 0.2)',
 											'rgba(255, 206, 86, 0.2)',
 											'rgba(75, 192, 192, 0.2)',
 											'rgba(153, 102, 255, 0.2)',
 											'rgba(255, 159, 64, 0.2)'
 										],
 										borderColor: [
 											'rgba(255,99,132,1)',
 											'rgba(54, 162, 235, 1)',
 											'rgba(255, 206, 86, 1)',
 											'rgba(75, 192, 192, 1)',
 											'rgba(153, 102, 255, 1)',
 											'rgba(255, 159, 64, 1)',
 											'rgba(255,99,132,1)',
 											'rgba(54, 162, 235, 1)',
 											'rgba(255, 206, 86, 1)',
 											'rgba(75, 192, 192, 1)',
 											'rgba(153, 102, 255, 1)',
 											'rgba(255, 159, 64, 1)'
 										],
 										borderWidth: 1
 									}]
 								},
 								options: {
 									scales: {
 										yAxes: [{
 											ticks: {
 												beginAtZero: true
 											}
 										}]
 									}
 								}
 							});
 						</script>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 </div>

 <div class="modal fade" id="edit-profile">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title">Edit Profile</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<?php echo form_open_multipart('user/index'); ?>
 				<div class="form-group row">
 					<label for="username" class="col-sm-2 col-form-label">Username</label>
 					<div class="col-sm-10">
 						<input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
 						<input type="text" class="form-control" id="username" value="<?php echo $user['username']; ?>" readonly>
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="name" class="col-sm-2 col-form-label">Nama</label>
 					<div class="col-sm-10">
 						<input type="text" class="form-control" name="nama" value="<?php echo $user['nama']; ?>">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="name" class="col-sm-2 col-form-label">Email</label>
 					<div class="col-sm-10">
 						<input type="text" class="form-control" name="email" value="<?php echo $user['email']; ?>">
 					</div>
 				</div>
 				<div class="form-group row">
 					<label for="name" class="col-sm-2 col-form-label">No HP</label>
 					<div class="col-sm-10">
 						<input type="number" class="form-control" name="hp" value="<?php echo $user['hp']; ?>">
 					</div>
 				</div>
 				<div class="form-group row">
 					<div class="col-sm-2"><label>Photo</label></div>
 					<div class="col-sm-10">
 						<div class="row">
 							<div class="col-sm-3">
 								<img src="<?php echo base_url('assets/dist/img/profile/') . $user['image']; ?>" class="img-thumbnail">
 							</div>
 							<div class="col-sm-9">
 								<div class="form-group">
 									<label for="exampleFormControlFile1">Upload Photo</label>
 									<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 				<button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
 				<button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
 				</form>
 			</div>
 			<div class="modal-footer">

 			</div>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>

 <div class="modal fade" id="edit-pass">
 	<div class="modal-dialog">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h4 class="modal-title">Ubah Password</h4>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<form action="<?php echo base_url('user/ubah_password'); ?>" method="post">
 					<div class="form-group">
 						<label for="current_password">Password Lama</label>
 						<input type="password" class="form-control" id="current_password" name="current_password">
 					</div>
 					<div class="form-group">
 						<label for="new_password1">Password Baru</label>
 						<input type="password" class="form-control" id="new_password1" name="new_password1">
 					</div>
 					<div class="form-group">
 						<label for="new_password2">Ulang Password Baru</label>
 						<input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru">
 					</div>
 					<button type="button" class="btn btn-default float-right ml-1" data-dismiss="modal">Tutup</button>
 					<button type="submit" class="btn btn-primary float-right">Simpan Perubahan</button>
 				</form>
 			</div>
 		</div>
 		<!-- /.modal-content -->
 	</div>
 	<!-- /.modal-dialog -->
 </div>
