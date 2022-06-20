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

                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
                           <table class="table table-bordered" id="table-id">
                               <thead>
                                   <th>#</th>
                                   <th>Tgl</th>
                                   <th>No. Reg</th>
                                   <th>Kategori</th>
                                   <th>Nama</th>
                                   <th>Cabang</th>
                                   <th>Divisi</th>
                                   <th>Jumlah</th>
                                   <th>Permintaan</th>
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
                                           <td><?php echo $lu['nama']; ?></td>
                                           <td><?php echo $lu['namacabang']; ?></td>
                                           <td><?php echo $lu['nama_divisi']; ?></td>
                                           <td><?php echo $lu['jml_minta']; ?> <?php echo $lu['nama_satuan']; ?></td>
                                           <td><?php echo $lu['permintaan']; ?></td>
                                           <?php if ($lu['status_minta'] == 2) : ?>
                                               <td><span class="btn btn-danger btn-block btn-sm font-weight-bolder">Ditolak</span></td>
                                           <?php elseif ($lu['status_minta'] == 1) : ?>
                                               <td><span class="btn btn-warning btn-block btn-sm font-weight-bolder">Pending</span></td>
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