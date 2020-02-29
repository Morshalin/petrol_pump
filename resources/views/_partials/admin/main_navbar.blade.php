<div class="navbar navbar-expand-md navbar-dark fixed-top  noprint">
	<div class="navbar-header navbar-dark d-none d-md-flex align-items-md-center">
		<div class="navbar-brand navbar-brand-md">
			<a href="{{route('home')}}" class="d-inline-block">
				<img src="{{asset('storage/logo/'.get_option('logo'))}}" alt="logo" width="120" height="250">
			</a>
		</div>

		<div class="navbar-brand navbar-brand-xs">
			<a href="{{route('home')}}" class="d-inline-block">
				<img src="{{asset('storage/logo/'.get_option('logo'))}}" alt="logo" width="120" height="250">
			</a>
		</div>
	</div>
	<!-- Mobile controls -->
		<div class="d-flex flex-1 d-md-none">
			<div class="navbar-brand mr-auto">
				<a href="{{route('home')}}" class="d-inline-block">
					<img src="{{asset('storage/logo/'.get_option('logo'))}}" alt="logo" width="120" height="250">
				</a>
			</div>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<!-- /mobile controls -->
	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
		</ul>
		<span class="navbar-text ml-md-3 mr-md-auto">
			<span class="badge bg-success">Online</span>
		</span>
		<ul class="navbar-nav">
            <li class="nav-item dropdown dropdown-user">
                <a class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ isset(auth()->user()->getProfile()->photo)? asset('storage/profile/'.auth()->user()->getProfile()->photo) : asset('asset/global_assets/images/placeholders/placeholder.jpg') }}" class="rounded-circle" alt="">
                    <span>{{isset(auth()->user()->name)?auth()->user()->name:'Unknow'}}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
					
                    <a href="{{route('admin.user.password')}}" class="dropdown-item"><i class="icon-lock4"></i> @lang('Change Password')</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('admin.user.profile')}}" class="dropdown-item"><i class="icon-lock4"></i> @lang('Change Profile')</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" id="logout" data-url='{{ route('logout') }}'>
                        <i class="icon-switch2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
	</div>
</div>
