		<!-- Navbar Right Menu -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				@if (Auth::guest())
					<li><a href="{{ url('/login') }}">Login</a></li>
					<li><a href="{{ url('/register') }}">Register</a></li>
				@else
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							@if(Auth::user()->gender == "Female")
								<img src="{{ url('/la-assets/img/laki_laki.png') }}" class="user-image" alt="User Image"/>
							@else
								<img src="{{ url('/la-assets/img/perempuan.png') }}" class="user-image" alt="User Image"/>
							@endif
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">{{ Auth::user()->name }}</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								@if(Auth::user()->gender == "Male")
									<img src="{{ url('/la-assets/img/laki_laki.png') }}" class="img-circle" alt="User Image" />
								@else
									<img src="{{ url('/la-assets/img/perempuan.png') }}" class="img-circle" alt="User Image" />
								@endif
								<p>
									{{ Auth::user()->name }}
								</p>
							</li>
							<!-- Menu Body -->
							@role("SUPER_ADMIN")
<!-- 							<li class="user-body">
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('laraadmin.adminRoute') . '/lacodeeditor') }}"><i class="fa fa-code"></i> <span>Editor</span></a>
								</div>
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('laraadmin.adminRoute') . '/modules') }}"><i class="fa fa-cubes"></i> <span>Modules</span></a>
								</div>
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('laraadmin.adminRoute') . '/la_menus') }}"><i class="fa fa-bars"></i> <span>Menus</span></a>
								</div>
								<div class="col-xs-6 text-center mb10">
									<a href="{{ url(config('laraadmin.adminRoute') . '/la_configs') }}"><i class="fa fa-cogs"></i> <span>Configure</span></a>
								</div>
								<div class="col-xs-6 text-center">
									<a href="{{ url(config('laraadmin.adminRoute') . '/backups') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a>
								</div>
							</li> -->
							@endrole
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="text-center">
									<a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Keluar</a>
								</div>
							</li>
						</ul>
					</li>
				@endif
				@if(LAConfigs::getByKey('show_rightsidebar'))
				<!-- Control Sidebar Toggle Button -->
				@endif
			</ul>
		</div>