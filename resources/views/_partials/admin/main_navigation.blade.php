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
		
		<li class="nav-item nav-item-submenu {{Request::is('admin/customer*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-users"></i> <span>{{_lang('Customer Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.customer.index') }}" class="nav-link {{Request::is('admin/customer/index*') ? 'active':''}}">{{_lang('Permanent Customer')}}</a></li>
			</ul>
		</li>

		<li class="nav-item nav-item-submenu {{Request::is('admin/emp-all*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employees Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">

				<li class="nav-item "><a href="{{ route('admin.employees.index') }}" class="nav-link {{Request::is('admin/emp-all/emp_info*') ? 'active':''}}">{{_lang(' Employe Information')}}</a></li>
			
				<li class="nav-item "><a href="{{ route('admin.employees.attendes') }}" class="nav-link {{Request::is('admin/emp-all/attendes') ? 'active':''}}">{{_lang('Take Attendees')}}</a></li>
			
				<li class="nav-item "><a href="{{ route('admin.post.index') }}" class="nav-link {{Request::is('admin/emp-all/post*') ? 'active':''}}">{{_lang('Add Employe Post')}}</a></li>

				<li class="nav-item "><a href="{{ route('admin.shift.index') }}" class="nav-link {{Request::is('admin/emp-all/shift*') ? 'active':''}}">{{_lang('Add Employe shift time')}}</a></li>
			</ul>
		</li>
		
		<li class="nav-item nav-item-submenu {{Request::is('admin/pro-manage*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-plus-circle2"></i> <span>{{_lang('Product Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{ route('admin.purchase.index') }}" class="nav-link {{Request::is('admin/pro-manage/purchase*') ? 'active':''}}">{{_lang('All Purchase Product')}}</a></li>
				<li class="nav-item "><a href="{{ route('admin.items.index') }}" class="nav-link {{Request::is('admin/pro-manage/items*') ? 'active':''}}">{{_lang('Add Product Items')}}</a></li>
				<li class="nav-item "><a href="{{ route('admin.companyinfo.index') }}" class="nav-link {{Request::is('admin/pro-manage/companyinfo*') ? 'active':''}}">{{_lang('Add Product Company')}}</a></li>
			</ul>
		</li>

		<li class="nav-item nav-item-submenu {{Request::is('admin/sales*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-cart5"></i> <span>{{_lang('Sales Manage')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{route('admin.sale.index')}}" class="nav-link {{Request::is('admin/sales/saleall*') ? 'active':''}}">{{_lang('All Sale Product')}}</a></li>
			</ul>
		</li>

		{{-- <li class="nav-item nav-item-submenu {{Request::is('admin/salary*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employe Salary')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">

				<li class="nav-item "><a href="{{route('admin.salarysetup.index')}}" class="nav-link {{Request::is('admin/salary/salarysetup*') ? 'active':''}}">{{_lang('Salary Setup')}}</a></li>
			
				<li class="nav-item "><a href="{{route('admin.salarypayment.index')}}" class="nav-link {{Request::is('admin/salary/salarypayment*') ? 'active':''}}">{{_lang('Salary Payment')}}</a></li>
			
				<li class="nav-item "><a href="{{route('admin.salaryreport.index')}}" class="nav-link {{Request::is('admin/salary/salaryreport*') ? 'active':''}}">{{_lang('Salary Report')}}</a></li>
			</ul>
		</li> --}}

		<li class="nav-item nav-item-submenu {{Request::is('admin/receipt*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-calculator3"></i> <span>{{_lang('Account Manage')}}</span></a>

			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				<li class="nav-item "><a href="{{route('admin.calculation.index')}}" class="nav-link {{Request::is('admin/receipt/calculation*') ? 'active':''}}">{{_lang('Calculation')}}</a></li>
			
				<li class="nav-item "><a href="{{route('admin.investment.index')}}" class="nav-link {{Request::is('admin/receipt/investment*') ? 'active':''}}">{{_lang('Investment')}}</a></li>
			
				<li class="nav-item "><a href="{{route('admin.investowner.index')}}" class="nav-link {{Request::is('admin/receipt/investowner*') ? 'active':''}}">{{_lang('Owner Manage')}}</a></li>
			</ul>
		</li>

		<li class="nav-item nav-item-submenu {{Request::is('admin/report*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-newspaper"></i> <span>{{_lang('Report')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">

				<li class="nav-item "><a href="{{ route('admin.stockreport') }}" class="nav-link {{Request::is('admin/report/stockreport') ? 'active':''}}">{{_lang('Product Stock Report')}}</a></li>

				<li class="nav-item "><a href="{{route('admin.reports')}}" class="nav-link {{Request::is('admin/sales/reports') ? 'active':''}}">{{_lang('Product Sales Report')}}</a></li>
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

		{{-- @endif --}}
	</ul>
</div>
