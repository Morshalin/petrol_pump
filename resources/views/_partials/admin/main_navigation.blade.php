<?php $index = 1;?>
<div class="card card-sidebar-mobile  noprint">
	<ul class="nav nav-sidebar" data-nav-type="accordion">
		{{-- @if(Request::segment($index + 1) == 'configuration')
		@include('_partials.admin.configuration', compact('index'))
		@else --}}
		<li class="nav-item">
			<a href="{{route('home')}}" class="nav-link{{ Request::is('home') ? ' active' : '' }}">
				<i class="icon-home4"></i>
				<span>
					{{_lang('Dashboard')}}
				</span>
			</a>
		</li>
		@if(auth()->user()->can('configuration.create'))
		<li class="nav-item">
			<a href="{{ route('admin.configuration') }}" class="nav-link{{ Request::is('admin/configuration') ? ' active' : '' }}">
				<i class="icon-cog spinner"></i>
				<span>
					{{_lang('Setting')}}
				</span>
			</a>
		</li>
		@endif
       @if(auth()->user()->can('language.view'))
		<li class="nav-item">
			<a href="{{ route('admin.language') }}" class="nav-link{{ Request::is('admin/language') ? ' active' : '' }}">
				<i class="icon-stack-text"></i>
				<span>
					{{_lang('Language')}}
				</span>
			</a>
		</li>
		@endif

		<li class="nav-item">
			<a href="{{ route('admin.customer.index') }}" class="nav-link{{ Request::is('admin/customer') ? ' active' : '' }}">
				<i class="icon-users"></i>
				<span>
					{{_lang('Customer Management')}}
				</span>
			</a>
		</li>


		<li class="nav-item nav-item-submenu {{Request::is('admin/employees*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employees Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.employees.index') }}" class="nav-link {{Request::is('admin/employees/index*') ? 'active':''}}">{{_lang(' Employe Information')}}</a></li>
			</ul>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.employees.attendes') }}" class="nav-link {{Request::is('admin/employees/attendes*') ? 'active':''}}">{{_lang('Take Attendes')}}</a></li>
			</ul>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.post.index') }}" class="nav-link {{Request::is('admin/post/index*') ? 'active':''}}">{{_lang('Add Employe Post')}}</a></li>
			</ul>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.shift.index') }}" class="nav-link {{Request::is('admin/shift/index*') ? 'active':''}}">{{_lang('Add Employe shift time')}}</a></li>
			</ul>
		</li>
		
		<li class="nav-item nav-item-submenu {{Request::is('admin/product*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-plus-circle2"></i> <span>{{_lang('Product Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.product.index') }}" class="nav-link {{Request::is('admin/product/index*') ? 'active':''}}">{{_lang('Add product')}}</a></li>
			</ul>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.items.index') }}" class="nav-link {{Request::is('admin/items/index*') ? 'active':''}}">{{_lang('Add Items')}}</a></li>
			</ul>

			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.companyinfo.index') }}" class="nav-link {{Request::is('admin/companyinfo/index*') ? 'active':''}}">{{_lang('Add Company')}}</a></li>
			</ul>
		</li>

		<li class="nav-item nav-item-submenu {{Request::is('admin/sales*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-cart5"></i> <span>{{_lang('Sales Manage')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{route('admin.salescustomers.index')}}" class="nav-link {{Request::is('admin/sales_customer/index*') ? 'active':''}}">{{_lang('Our customers')}}</a></li>
			</ul>
		</li>

		<li class="nav-item nav-item-submenu {{Request::is('admin/employesalary*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employe Salary')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{route('admin.salarysetup.index')}}" class="nav-link {{Request::is('admin/slarysetup/index*') ? 'active':''}}">{{_lang('Salary Setup')}}</a></li>
			</ul>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{route('admin.salarypayment.index')}}" class="nav-link {{Request::is('admin/salarypayment/index*') ? 'active':''}}">{{_lang('Salary Payment')}}</a></li>
			</ul>
		</li>
		

		@if(auth()->user()->can('user.view') || auth()->user()->can('role.view') )
		<li class="nav-item nav-item-submenu {{Request::is('admin/user*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('User Management')}}</span></a>

			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
			  @can('role.view')
				<li class="nav-item "><a href="{{ route('admin.user.role') }}" class="nav-link {{Request::is('admin/user/role*') ? 'active':''}}">{{_lang('Role & Permission')}}</a></li>
			  @endcan
			  @can('user.view')
				<li class="nav-item "><a href="{{ route('admin.user.index') }}" class="nav-link {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}">{{_lang('user manage')}}</a></li>
			  @endcan

			</ul>
		</li>
		@endif

		{{-- @endif --}}
	</ul>
</div>
