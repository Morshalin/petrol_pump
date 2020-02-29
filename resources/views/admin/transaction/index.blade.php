@extends('layouts.app', ['title' => 'Transaction', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Transaction</span>
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
		<h5 class="card-title">
		@can('transaction.deposit')
		<a href="{{ route('admin.moneyDeposite') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Deposit')}} </a>
		@endcan
		@can('transaction.withdraw')
		<a href="{{ route('admin.moneyWithdraw') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Withdraw')}} </a>
		@endcan
		</h5>
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
					<th>#</th>
					<th>{{_lang('Date')}}</th>
					<th>{{_lang('REF')}}</th>
					<th>{{_lang('TYPE')}}</th>
					<th>{{_lang('ACCOUNT')}}</th>
					<th>{{_lang('CREDIT')}}</th>
					<th>{{_lang('DEBIT')}}</th>
					<th>{{_lang('BALANCE')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($models as $key => $item)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{date("F d, Y",strtotime($item->updated_at)) }}</td>
						<td>{{$item->invo_id}}</td>
						<td><span class="badge {{$item->type=='Withdraw'?'badge-danger':'badge-success'}}">{{$item->type}}</span></td>
						<td>{{$item->bankAccount->acc_name}}</td>
						<td>{{$item->acc_type=='Credit'?$item->amount:''}}</td>
						<td>{{$item->acc_type=='Debit'?$item->amount:''}}</td>
						<td>{{$item->balance}}</td>
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