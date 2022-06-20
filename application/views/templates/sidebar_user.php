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
        		<a class="nav-link" href="<?php echo base_url('user/index'); ?>">
        			<i class="fas fa-fw fas fa-home"></i>
        			<span>Beranda</span></a>
        	</li>

        	<hr class="sidebar-divider">

        	<div class="sidebar-heading">
        		User
        	</div>

        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('user/permintaan'); ?>">
        			<i class="fas fa-fw fa-bezier-curve"></i>
        			<span>Permintaan</span></a>
        	</li>
        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('user/list_permintaan'); ?>">
        			<i class="far fa-fw fa-list-alt"></i>
        			<span>List Permintaan</span></a>
        	</li>
        	<li class="nav-item">
        		<a class="nav-link" href="<?php echo base_url('user/permintaan_masuk'); ?>">
        			<i class="fab fa-fw fa-centercode"></i>
        			<span>Permintaan Masuk</span></a>
        	</li>

        	<!-- <li class="nav-item">
        		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        			<i class="fas fa-fw far fa-clone"></i>
        			<span>Data</span>
        		</a>
        		<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        			<div class="bg-white py-2 collapse-inner rounded">
        				<h6 class="collapse-header">Custom Components:</h6>
        				<a class="collapse-item" href="#">Data 1</a>
        				<a class="collapse-item" href="#">Data 2</a>
        				<a class="collapse-item" href="#">Data 3</a>
        			</div>
        		</div>
        	</li> -->
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
        <!-- End of Sidebar -->
