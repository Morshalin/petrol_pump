@extends('layouts.app', ['title' => 'Bank Account', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Bank Account</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		@can('bank.create')
		<h5 class="card-title">{{_lang('Add New Bank Account')}}
		<a href="{{ route('admin.bankaccount.create') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Create')}} </a>
		</h5>
		@endcan
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
		<div class="card-body">
		<table class="table content_managment_table">
			<thead>
				<tr>
					<th>{{_lang('SI.')}}</th>
					<th>{{_lang('Account Name')}}</th>
					<th>{{_lang('Account No.')}}</th>
					<th>{{_lang('Contact Persion')}}</th>
					<th>{{_lang('Opening Balance')}}</th>
					<th>{{_lang('Status')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>

			 @foreach($models as $key=>$data)
				<tr>
					<td>{{ $key+1}}</td>
					<td>{{$data->acc_name}}</td>
					<td>{{$data->acc_no}}</td>
					<td>{{$data->contact_persion}}</td>
					<td>{{$data->opening_balance}}</td>
					<td>
						@if($data->status==1)
							<span class="badge badge-success">Active</span>
							@else
							<span class="badge badge-danger">Inactive</span>
						
						@endif
					</td>
					<td class="text-center">
						<div class="list-icons">
							<div class="dropdown">
								<a href="#" class="list-icons-item" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									@can('bank.view')
									<a href="{{ route('admin.bankaccount.show', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
									@endcan
									@can('bank.update')
									<a href="{{ route('admin.bankaccount.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
									@endcan
									@can('bank.withdraw')
									<a href="{{ route('admin.moneyWithdraw', $data->id) }}" class="dropdown-item"><i class="icon-clipboard2"></i> Withdraw</a>
									@endcan
									@can('bank.deposit')
									<a href="{{ route('admin.moneyDeposite', $data->id) }}" class="dropdown-item"><i class="icon-shield2"></i> Deposit</a>
									@endcan
									@can('bank.delete')
									<span data-id="{{$data->id}} " data-url="{{route('admin.bankaccount.destroy',$data->id)}} " class="dropdown-item" id="delete_item"><i class="icon-cross2"></i> Delete</span>
									@endcan
								</div>
							</div>
						</div>
					</td>
				</tr>
			 @endforeach
			</tbody>
		</table>
	</div>
</div>		
<!-- /basic initialization -->
@stop
@push('scripts')

<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('js/pages/table.js') }}"></script>
<!-- /theme JS files -->
@endpush