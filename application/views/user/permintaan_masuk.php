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
   					<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
   					<?php echo $this->session->flashdata('msg'); ?>
   					<?php if (validation_errors()) { ?>
   						<div class="alert alert-danger">
   							<strong><?php echo strip_tags(validation_errors()); ?></strong>
   							<a href="" class="float-right text-decoration-none" data-dismiss="alert"><i class="fas fa-times"></i></a>
   						</div>
   					<?php } ?>
   					<div class="table-responsive">
   						<table class="table table-bordered" id="table-id">
   							<thead>
   								<th>#</th>
   								<th>Tgl</th>
   								<th>No. Reg</th>
								<th>Cabang</th>
   								<th>Kategori</th>
   								<th>Permintaan</th>
   								<th>Jumlah</th>
   								<th>Permintaan</th>
   								<th>Status</th>
   								<th>Aksi</th>
   							</thead>
   							<tbody>
   								<?php $i = 1; ?>
   								<?php foreach ($permintaan_masuk as $lu) : ?>
   									<tr>
   										<td><?php echo $i++; ?></td>
   										<td><?php echo format_indo($lu['tgl_minta']); ?></td>
   										<td><?php echo $lu['kode_minta']; ?></td>
										<td><?php echo $lu['namacabang']; ?></td>
   										<td><?php echo $lu['nama_kategori']; ?></td>
   										<td><?php echo $lu['nama_divisi']; ?></td>
   										<td><?php echo $lu['jml_minta']; ?> <?php echo $lu['nama_satuan']; ?></td>
   										<td><?php echo $lu['permintaan']; ?></td>
   										<td class="text-center font-weight-bolder">Pending</td>
   										<td><a href="#" class="tombol-edit btn btn-primary btn-block btn-sm" data-id="<?php echo $lu['id_minta']; ?>" data-toggle="modal" data-target="#edit-user"><i class="fas fa-reply-all"></i> Respond</a></td>
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


   <div class="modal fade" id="edit-user">
   	<div class="modal-dialog">
   		<div class="modal-content">
   			<div class="modal-header">
   				<h4 class="modal-title">Respond Permintaan</h4>
   			</div>
   			<div class="modal-body">
   				<div class="box-body">
   					<form action="<?php echo base_url('user/permintaan_masuk'); ?>" method="post">
   						<div class="row">
   							<div class="col-md-6">
   								<div class="form-group">
   									<label>No Registrasi</label>
   									<input type="hidden" name="id_minta" id="id_minta">
   									<input type="text" class="form-control form-control-sm" id="kode_minta" readonly>
   								</div>
   							</div>
							   <div class="form-group">
   									<label>Cabang</label>
   									<input type="hidden" name="namacabang" id="namacabang">
   									<input type="text" class="form-control form-control-sm" id="namacabang" readonly>
   								</div>
   							<div class=" col-md-6">
   								<div class="form-group">
   									<label>Tgl Permintaan</label>
   									<input type="text" class="form-control form-control-sm" id="tgl_minta" readonly>
   								</div>
   							</div>
   						</div>
   						<div class="row">
   							<div class="col-md-6">
   								<div class="form-group">
   									<label>Jumlah</label>
   									<input type="number" class="form-control form-control-sm" id="jml_minta" readonly>
   								</div>
   							</div>
   							<div class="col-md-6">
   								<div class="form-group">
   									<label>Satuan</label>
   									<select class="form-control form-control-sm" name="satuan_kode" id="satuan_kode" selected="true" disabled="disabled">
   										<?php foreach ($satuan as $k) : ?>
   											<option value="<?php echo $k['kode_satuan']; ?>"><?php echo $k['nama_satuan']; ?></option>
   										<?php endforeach; ?>
   									</select>
   								</div>
   							</div>
   						</div>
   						<div class="form-group">
   							<label>Permintaan</label>
   							<input type="text" class="form-control form-control-sm" id="permintaan" readonly>
   						</div>
   						<div class="form-group">
   							<label>Keterangan</label>
   							<textarea class="form-control form-control-sm" rows="2" id="keterangan" readonly></textarea>
   						</div>
   						<div class="form-group">
   							<label>Penerima</label>
   							<input type="text" class="form-control form-control-sm" name="penerima" value="<?php echo $user['nama']; ?>" readonly>
   						</div>
   						<div class="form-group">
   							<label>Alasan Ditolak</label>
   							<textarea class="form-control" rows="2" name="alasan_tolak" placeholder="Ketik minus ( - ) jika penerimaan di terima." required></textarea>
   						</div>
   						<div class="form-group">
   							<div class="form-check">
   								<input class="form-check-input" type="radio" name="status_minta" value="0" required>
   								<label class="form-check-label">Terima</label>
   							</div>
   							<div class="form-check">
   								<input class="form-check-input" type="radio" name="status_minta" value="2">
   								<label class="form-check-label">Tolak</label>
   							</div>
   						</div>
   						<div class="box-footer">
   							<button type="submit" class="btn btn-primary pull-right">Simpan Data</button>
   							<button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
   						</div>
   					</form>
   				</div>
   			</div>
   		</div>
   	</div>
   </div>


   <script>
   	$('.tombol-edit').on('click', function() {
   		const id_minta = $(this).data('id');
   		$.ajax({
   			url: '<?php echo base_url('user/get_minta'); ?>',
   			data: {
   				id_minta: id_minta
   			},
   			method: 'post',
   			dataType: 'json',
   			success: function(data) {
   				$('#keterangan').val(data.keterangan);
   				$('#permintaan').val(data.permintaan);
   				$('#satuan_kode').val(data.satuan_kode);
   				$('#jml_minta').val(data.jml_minta);
   				$('#tgl_minta').val(data.tgl_minta);
   				$('#kode_minta').val(data.kode_minta);
   				$('#id_minta').val(data.id_minta);
				$('#idcabang').val(data.idcabang);
   			}
   		});
   	});
   </script>
