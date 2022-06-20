        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        	<!-- Sidebar - Brand -->
        	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        		<div class="sidebar-brand-icon">
        			<i class="fas fa-check-double"></i>
        		</div>
        		<div class="sidebar-brand-text mx-3">Permintaan</div>
        	</a>

        	<hr class="sidebar-divider my-0">

        	<li class="nav-item active">
        		<a class="nav-link" href="<?php echo base_url('admin/index'); ?>">
        			<i class="fas fa-fw fas fa-home"></i>
        			<span>Beranda</span></a>
        	</li>
        	<hr class="sidebar-divider">

        	<div class="sidebar-heading">
        		Administrator
        	</div>

        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('admin/man_user'); ?>">
        			<i class="fas fa-fw fa-users"></i>
        			<span>Manajemen User</span></a>
        	</li>


        	<li class="nav-item">
        		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        			<i class="fas fa-fw far fa-clone"></i>
        			<span>Master Data</span>
        		</a>
        		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        			<div class="bg-white py-2 collapse-inner rounded">
        				<h6 class="collapse-header">All Master :</h6>
        				<a class="collapse-item" href="<?php echo base_url('admin/mst_divisi'); ?>">Master Divisi</a>
        				<a class="collapse-item" href="<?php echo base_url('admin/mst_kategori'); ?>">Master Kategori</a>
        				<a class="collapse-item" href="<?php echo base_url('admin/mst_satuan'); ?>">Master Satuan</a>
						<a class="collapse-item" href="<?php echo base_url('admin/mst_cabang'); ?>">Master Cabang</a>
        			</div>
        		</div>
        	</li>

        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('admin/view'); ?>">
        			<i class="fas fa-fw fa-hotdog"></i>
        			<span>View Permintaan</span></a>
        	</li>


        	<hr class="sidebar-divider">

        	<div class="sidebar-heading">
        		END
        	</div>

        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('auth/logout'); ?>" id="tombol-logout">
        			<i class="fas fa-fw fa-sign-out-alt"></i>
        			<span>Logout</span></a>
        	</li>

        	<hr class="sidebar-divider d-none d-md-block">

        	<div class="text-center d-none d-md-inline">
        		<button class="rounded-circle border-0" id="sidebarToggle"></button>
        	</div>

        </ul>