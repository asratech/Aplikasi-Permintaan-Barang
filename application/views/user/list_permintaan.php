   <!-- Begin Page Content -->
   <div class="container-fluid">
   	<div class="d-sm-flex align-items-center justify-content-between mb-4">
   		<h2 class="h4 mb-0 text-gray-800"><?php echo $title; ?></h2>
   		<!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
   	</div>
   	<div class="row">
   		<div class="col-xl-12 col-lg-5">
   			<div class="card shadow mb-4">
   				<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
   					<h6 class="m-0 font-weight-bold"><?php echo $nama_divisi['nama_divisi']; ?></h6>
   				</div>
   				<div class="card-body">
   					<div class="table-responsive">
   						<table class="table table-bordered" id="table-data">
   							<thead>
   								<th>#</th>
   								<th>Tgl</th>
   								<th>No. Reg</th>
   								<th>Kategori</th>
								<th>Cabang</th>
   								<th>Penerima</th>
								<th>Approve by</th>
								<th>Tgl.Approve</th>
   								<th>Jumlah</th>
   								<th>Permintaan</th>
   								<th>Alasan Tolak</th>
   								<th>Status</th>

   							</thead>
   							<tbody>
   								<?php $i = 1; ?>
   								<?php foreach ($list_permintaan as $lu) : ?>
   									<tr>
   										<td><?php echo $i++; ?></td>
   										<td><?php echo format_indo($lu['tgl_minta']); ?></td>
   										<td><?php echo $lu['kode_minta']; ?></td>
   										<td><?php echo $lu['nama_kategori']; ?></td>
										<td><?php echo $lu['namacabang']; ?></td>
   										<td><?php echo $lu['nama_divisi']; ?></td>
										<td><?php echo $lu['approveby']; ?></td>
										<td><?php echo $lu['approvedate']; ?></td>
   										<td><?php echo $lu['jml_minta']; ?> <?php echo $lu['nama_satuan']; ?></td>
   										<td><?php echo $lu['permintaan']; ?></td>
   										<td><?php echo $lu['alasan_tolak']; ?></td>
   										<?php if ($lu['status_minta'] == 2) : ?>
   											<td><span class="btn btn-danger btn-block btn-sm font-weight-bolder">Ditolak</span></td>
   										<?php else : ?>
   											<td><span class="btn btn-success btn-block btn-sm font-weight-bolder">Diterima</span></td>
   										<?php endif; ?>
   									</tr>
   								<?php endforeach; ?>
   							</tbody>
   						</table>
   					</div>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>