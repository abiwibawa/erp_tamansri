<div class="row">                   
	<div class="col-md-12">
		
		 <nav class="navbar brb" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-reorder"></span>                            
				</button>                                                
				<a class="navbar-brand" href="<?=base_url()?>"><img src="img/logo.png"/></a>                                                                                     
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">                                     
				<ul class="nav navbar-nav">                            
				   <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-hdd"></span> Master</a>
						<ul class="dropdown-menu">                                    
							<li><a href="<?=base_url('master_jenis_barang')?>">Master Jenis Barang</a></li>
							<li><a href="<?=base_url('master_barang')?>">Master Barang</a></li>
							<li><a href="<?=base_url('master_customers')?>">Master Customers</a></li>
							<li><a href="<?=base_url('master_supplier')?>">Master Supplier</a></li>
							<li><a href="<?=base_url('master_satpam')?>">Master Satpam</a></li>
							<li><a href="<?=base_url('master_supir')?>">Master Supir</a></li>
							<li><a href="<?=base_url('master_ttd')?>">Master Tanda Tangan</a></li>
							<li><a href="<?=base_url('master_pengirim')?>">Master Pengirim</a></li>
							<li><a href="<?=base_url('master_perkiraan')?>">Master Kode Perkiraan</a></li>
							<li><a href="<?=base_url('master_nofaktur')?>">List No.Faktur</a></li>
						</ul>                                
					</li>
					<li class="dropdown active">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-cogs"></span> Penjualan</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Order <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_order')?>">Input Order</a></li>
									<li><a href="<?=base_url('penjualan_laporder')?>">Riwayat Input Order</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Surat Jalan <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_sj')?>">Buat Surat Jalan</a></li>
									<li><a href="<?=base_url('penjualan_lapsj')?>">Riwayat Surat Jalan</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Invoice <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_invoice')?>">Buat Invoice</a></li>
									<li><a href="<?=base_url('penjualan_lapinvoice')?>">Riwayat Invoice</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Faktur Pajak <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_fp')?>">Buat Faktur Pajak</a></li>
									<li><a href="<?=base_url('penjualan_lapfp')?>">Riwayat Faktur Pajak</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Kwitansi <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_kwitansi')?>">Buat Kwitansi</a></li>
									<li><a href="<?=base_url('penjualan_lapkwitansi')?>">Riwayat Kwitansi</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Pembayaran <i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="<?=base_url('penjualan_pembayaran')?>">Pembayaran</a></li>
									<li><a href="<?=base_url('penjualan_lappembayaran')?>">Lap. Pembayaran</a></li>
								</ul>
							</li>
							<li><a href="<?=base_url('penjualan_stokbarang')?>">Stok Barang</a></li>
							<li><a href="<?=base_url('penjualan_laporan')?>">Laporan Penjualan</a></li>
						</ul>
					</li>                          
					<li class="dropdown active">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="icon-globe"></span> Pembelian</a>
						<ul class="dropdown-menu">
							<li><a href="component_blocks.html">Pesan Barang</a></li>
							<li><a href="component_buttons.html">Surat Jalan</a></li>
							<li><a href="component_modals.html">Invoice</a></li>
							<li><a href="component_progress.html">Reture</a></li>
							<li><a href="component_tabs.html">Faktur Pajak</a></li>
							<li><a href="component_lists.html">Pembayaran</a></li>
							<li><a href="component_messages.html">Stok Barang</a></li>
							<li><a href="component_messages.html">Laporan Penjualan</a></li>
						</ul>
					</li>
					
					<!--Produksi-->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-alt"></span> Produksi</a>
						<ul class="dropdown-menu">
							<li><a href="sample_login.html">Login</a></li>
							<li><a href="sample_registration.html">Registration</a></li>
							<li><a href="sample_profile.html">User profile</a></li>
							<li><a href="sample_profile_social.html">Social profile</a></li>
							<li><a href="sample_edit_profile.html">Edit profile</a></li>
							<li><a href="sample_mail.html">Mail</a></li>
							<li><a href="sample_search.html">Search</a></li>
							<li><a href="sample_invoice.html">Invoice</a></li>                                    
							<li><a href="sample_contacts.html">Contacts</a></li>
							<li><a href="sample_tasks.html">Tasks</a></li>
							<li><a href="sample_timeline.html">Timeline</a></li>
							<li>
								<a href="#">Email templates<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="email_sample_1.html">Sample 1</a></li>
									<li><a href="email_sample_2.html">Sample 2</a></li>
									<li><a href="email_sample_3.html">Sample 3</a></li>
									<li><a href="email_sample_4.html">Sample 4</a></li>
								</ul>
							</li>                                     
							<li>
								<a href="#">Error pages<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="sample_error_403.html">403 Forbidden</a></li>
									<li><a href="sample_error_404.html">404 Not Found</a></li>
									<li><a href="sample_error_500.html">500 Internal Server Error</a></li>
									<li><a href="sample_error_503.html">503 Service Unavailable</a></li>
									<li><a href="sample_error_504.html">504 Gateway Timeout</a></li>                                                                                       
								</ul>
							</li>                                    
						</ul>
					</li> 
					
					<!--Accounting-->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-alt"></span> Accounting</a>
						<ul class="dropdown-menu">
							<li><a href="sample_login.html">Login</a></li>
							<li><a href="sample_registration.html">Registration</a></li>
							<li><a href="sample_profile.html">User profile</a></li>
							<li><a href="sample_profile_social.html">Social profile</a></li>
							<li><a href="sample_edit_profile.html">Edit profile</a></li>
							<li><a href="sample_mail.html">Mail</a></li>
							<li><a href="sample_search.html">Search</a></li>
							<li><a href="sample_invoice.html">Invoice</a></li>                                    
							<li><a href="sample_contacts.html">Contacts</a></li>
							<li><a href="sample_tasks.html">Tasks</a></li>
							<li><a href="sample_timeline.html">Timeline</a></li>
							<li>
								<a href="#">Email templates<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="email_sample_1.html">Sample 1</a></li>
									<li><a href="email_sample_2.html">Sample 2</a></li>
									<li><a href="email_sample_3.html">Sample 3</a></li>
									<li><a href="email_sample_4.html">Sample 4</a></li>
								</ul>
							</li>                                     
							<li>
								<a href="#">Error pages<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="sample_error_403.html">403 Forbidden</a></li>
									<li><a href="sample_error_404.html">404 Not Found</a></li>
									<li><a href="sample_error_500.html">500 Internal Server Error</a></li>
									<li><a href="sample_error_503.html">503 Service Unavailable</a></li>
									<li><a href="sample_error_504.html">504 Gateway Timeout</a></li>                                                                                       
								</ul>
							</li>                                    
						</ul>
					</li>
					
					<!--Setting-->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="icon-file-alt"></span> Setting</a>
						<ul class="dropdown-menu">
							<li><a href="sample_login.html">Login</a></li>
							<li><a href="sample_registration.html">Registration</a></li>
							<li><a href="sample_profile.html">User profile</a></li>
							<li><a href="sample_profile_social.html">Social profile</a></li>
							<li><a href="sample_edit_profile.html">Edit profile</a></li>
							<li><a href="sample_mail.html">Mail</a></li>
							<li><a href="sample_search.html">Search</a></li>
							<li><a href="sample_invoice.html">Invoice</a></li>                                    
							<li><a href="sample_contacts.html">Contacts</a></li>
							<li><a href="sample_tasks.html">Tasks</a></li>
							<li><a href="sample_timeline.html">Timeline</a></li>
							<li>
								<a href="#">Email templates<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="email_sample_1.html">Sample 1</a></li>
									<li><a href="email_sample_2.html">Sample 2</a></li>
									<li><a href="email_sample_3.html">Sample 3</a></li>
									<li><a href="email_sample_4.html">Sample 4</a></li>
								</ul>
							</li>                                     
							<li>
								<a href="#">Error pages<i class="icon-angle-right pull-right"></i></a>
								<ul class="dropdown-submenu">
									<li><a href="sample_error_403.html">403 Forbidden</a></li>
									<li><a href="sample_error_404.html">404 Not Found</a></li>
									<li><a href="sample_error_500.html">500 Internal Server Error</a></li>
									<li><a href="sample_error_503.html">503 Service Unavailable</a></li>
									<li><a href="sample_error_504.html">504 Gateway Timeout</a></li>                                                                                       
								</ul>
							</li>                                    
						</ul>
					</li>
				</ul>
				<form class="navbar-form navbar-right" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="search..."/>
					</div>                            
				</form>                                            
			</div>
		</nav>               

	</div>            
</div>