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
		{{-- Customert serction --}}
		@can('customer.show')
		<li class="nav-item">
			<a href="{{ route('admin.customer.index') }}" class="nav-link {{Request::is('admin/cus-manage*') ?'active':''}}">
				<i class="icon-users"></i><span>{{_lang('Permanent Customer')}}</span>
			</a>
		</li>
		@endcan
		{{-- Employees serction --}}
		
		@can('employe.show'||'employeAttendees.show'||'employeDesignation.show'||'shiftTime.show')
		<li class="nav-item nav-item-submenu {{Request::is('admin/emp-all*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="#" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employees Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('employe.show')
				<li class="nav-item "><a href="{{ route('admin.employees.index') }}" class="nav-link {{Request::is('admin/emp-all/emp_info*') ? 'active':''}}">{{_lang('All Employees')}}</a></li>
				@endcan
				@can('employeAttendees.show')
				<li class="nav-item "><a href="{{ route('admin.employees.attendes') }}" class="nav-link {{Request::is('admin/emp-all/attendes') ? 'active':''}}">{{_lang('Attendees')}}</a></li>
				@endcan
				@can('employeAttendees.show')
				<li class="nav-item "><a href="{{ route('admin.addAdsence') }}" class="nav-link {{Request::is('admin/emp-all/emplye/adsence*') ? 'active':''}}">{{_lang('Absence')}}</a></li>
				@endcan
				@can('employeDesignation.show')
				<li class="nav-item "><a href="{{ route('admin.post.index') }}" class="nav-link {{Request::is('admin/emp-all/post*') ? 'active':''}}">{{_lang('Designation')}}</a></li>
				@endcan
				@can('shiftTime.show')
				<li class="nav-item "><a href="{{ route('admin.shift.index') }}" class="nav-link {{Request::is('admin/emp-all/shift*') ? 'active':''}}">{{_lang('shift time')}}</a></li>
				@endcan
			</ul>
		</li>
		@endcan
		{{-- Product Managemen serction --}}
		<li class="nav-item nav-item-submenu {{Request::is('admin/pro-manage*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-plus-circle2"></i> <span>{{_lang('Product Management')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('productItem.show')
				<li class="nav-item "><a href="{{ route('admin.items.index') }}" class="nav-link {{Request::is('admin/pro-manage/item*') ? 'active':''}}">{{_lang('All Product Items')}}</a></li>
				@endcan
				@can('productCompany.show')
				<li class="nav-item "><a href="{{ route('admin.companyinfo.index') }}" class="nav-link {{Request::is('admin/pro-manage/companyinfo*') ? 'active':''}}">{{_lang('All Product Company')}}</a></li>
				@endcan
				
			</ul>
		</li>
		{{-- Purchase Managemen serction --}}
		@can('productPurchase.show')
		<li class="nav-item">
			<a href="{{ route('admin.purchase.index') }}" class="nav-link {{Request::is('admin/purchase*') ?'active':''}}">
				<i class="icon-folder-plus3"></i><span>{{_lang('Purchase Product')}}</span>
			</a>
		</li>
		@endcan
		{{-- Sales Managemen serction --}}
		@can('productSale.show')
		<li class="nav-item">
			<a href="{{ route('admin.sale.index') }}" class="nav-link {{Request::is('admin/sales*') ?'active':''}}">
				<i class="icon-cart2"></i><span>{{_lang('Sale Product')}}</span>
			</a>
		</li>
		@endcan
		{{-- Salary Managemen serction --}}
		<li class="nav-item nav-item-submenu {{Request::is('admin/salary*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-user-plus"></i> <span>{{_lang('Employe Salary')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('salary.payShow')
				<li class="nav-item "><a href="{{route('admin.salarypayment.index')}}" class="nav-link {{Request::is('admin/salary/salarypayment*') ? 'active':''}}">{{_lang('Salary Payment')}}</a></li>
				@endcan
				@can('salarySetup.show')
				<li class="nav-item "><a href="{{route('admin.salarysetup.index')}}" class="nav-link {{Request::is('admin/salary/salarysetup*') ? 'active':''}}">{{_lang('Salary Setup')}}</a></li>
				@endcan
			</ul>
		</li>
		{{-- Account Expense serction --}}
		<li class="nav-item nav-item-submenu {{Request::is('admin/expensemanage*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-diff-removed"></i> <span>{{_lang('Expense Manage')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('expenseCategory.show')
				<li class="nav-item "><a href="{{route('admin.expensecategory.index')}}" class="nav-link {{Request::is('admin/expensemanage/expensecategory*') ? 'active':''}}">{{_lang('Expense Category')}}</a></li>
				@endcan
				@can('expense.show')
				<li class="nav-item "><a href="{{route('admin.expenseall.index')}}" class="nav-link {{Request::is('admin/expensemanage/expenseall*') ? 'active':''}}">{{_lang('Expense All')}}</a></li>
				@endcan
			</ul>
		</li>
		{{-- Account Managemen serction --}}
		<li class="nav-item nav-item-submenu {{Request::is('admin/account*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-calculator3"></i> <span>{{_lang('Account Manage')}}</span></a>

			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('bank.show')
				<li class="nav-item "><a href="{{route('admin.bankaccount.index')}}" class="nav-link {{Request::is('admin/account/bankaccount*') ? 'active':''}}">{{_lang('Bank Account')}}</a></li>
				@endcan
				@can('incomeSourse.show')
				<li class="nav-item "><a href="{{route('admin.incomesourse.index')}}" class="nav-link {{Request::is('admin/account/incomesourse*') ? 'active':''}}">{{_lang('Income Source')}}</a></li>
				@endcan
				@can('transaction.show')
				<li class="nav-item "><a href="{{route('admin.transaction.index')}}" class="nav-link {{Request::is('admin/account/money*') ? 'active':''}}">{{_lang('Transaction')}}</a></li>
				@endcan
				@can('accountBalance.show')
				<li class="nav-item "><a href="{{route('admin.accountbalance')}}" class="nav-link {{Request::is('admin/account/balance*') ? 'active':''}}">{{_lang('Account Balance')}}</a></li>
				@endcan
			</ul>
		</li>

		{{-- Account report serction --}}
		<li class="nav-item nav-item-submenu {{Request::is('admin/report*') ?'nav-item-expanded nav-item-open':''}}">
			<a href="javascript:void(0)" class="nav-link"><i class="icon-newspaper"></i> <span>{{_lang('Report')}}</span></a>
			<ul class="nav nav-group-sub" data-submenu-title="Layouts">
				@can('report.productStock')
				<li class="nav-item "><a href="{{ route('admin.stockreport') }}" class="nav-link {{Request::is('admin/report/stockreport') ? 'active':''}}">{{_lang('Product Stock Report')}}</a></li>
				@endcan
				@can('report.productSale')
				<li class="nav-item "><a href="{{route('admin.salereport')}}" class="nav-link {{Request::is('admin/report/salereport') ? 'active':''}}">{{_lang('Product Sales Report')}}</a></li>
				@endcan
				@can('report.companyPurchase')
				<li class="nav-item "><a href="{{route('admin.company.report')}}" class="nav-link {{Request::is('admin/report/company/report') ? 'active':''}}">{{_lang('Company Purchase Report')}}</a></li>
				@endcan
				@can('report.companySale')
				<li class="nav-item "><a href="{{route('admin.customer.report')}}" class="nav-link {{Request::is('admin/report/customer/report') ? ' active':''}}">{{_lang('Customer Sale Report')}}</a></li>
				@endcan
				@can('report.profitLoss')
				<li class="nav-item "><a href="{{route('admin.profit.loss')}}" class="nav-link {{Request::is('admin/report/profit/loss') ? 'active':''}}">{{_lang('Profit / Loss Report')}}</a></li>
				@endcan
				@can('report.employSalary')
				<li class="nav-item "><a href="{{route('admin.salaryreport.index')}}" class="nav-link {{Request::is('admin/report/salaryreport*') ? ' active':''}}">{{_lang('Employe Salary Report')}}</a></li>
				@endcan
				@can('report.dayBydayMonth')
				<li class="nav-item "><a href="{{route('admin.dayBydayReport')}}" class="nav-link {{Request::is('admin/report/dayBydayReport*') ? ' active':''}}">{{_lang('Day By Day Stock and Sale Month Report')}}</a></li>
				@endcan
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
