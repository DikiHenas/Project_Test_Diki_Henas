 <!--
	====================================
	——— LEFT SIDEBAR WITH FOOTER
	=====================================
-->
<aside class="left-sidebar bg-sidebar">
	<div id="sidebar" class="sidebar sidebar-with-footer">
		<!-- Aplication Brand -->
		<div class="app-brand">
			<a href="{{ url('admin/dashboard') }}">
			<span class="brand-name">LaraShop Dashboard</span>
			</a>
		</div>
		<!-- begin sidebar scrollbar -->
		<div class="sidebar-scrollbar">

			<!-- sidebar menu -->
			<ul class="nav sidebar-inner" id="sidebar-menu">			
				<li  class="has-sub {{ ($currentAdminMenu == 'pegawai') ? 'expand active' : ''}}">
					<a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#auth"
						aria-expanded="false" aria-controls="auth">
						<i class="mdi mdi-account-multiple-outline"></i>
						<span class="nav-text">Data Peagawai</span> <b class="caret"></b>
					</a>
					<ul class="collapse {{ ($currentAdminMenu == 'pegawai') ? 'show' : ''}}"  id="auth"
						data-parent="#sidebar-menu">
						<div class="sub-menu">
							<li  class="{{ ($currentAdminSubMenu == 'pegawai') ? 'active' : ''}}" >
								<a class="sidenav-item-link" href="{{ url('admin/pegawai')}}">
								<span class="nav-text">Pegawai</span>
								</a>
							</li>							
						</div>
						<div class="sub-menu">
							<li  class="{{ ($currentAdminSubMenu == 'absensi') ? 'active' : ''}}" >
								<a class="sidenav-item-link" href="{{ url('admin/absensi')}}">
								<span class="nav-text">Absensi Pegawai</span>
								</a>
							</li>							
						</div>
					</ul>
				</li>             
			</ul>
		</div>
	</div>
</aside>