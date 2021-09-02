@extends('layouts.app', ['title' => 'Sales Report', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Sales Report</span>
            </div>
            <a href="javascript:void(0)" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
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
					<th>{{_lang('Customer Name')}}</th>
					<th>{{_lang('Sub Total')}}</th>
					<th>{{_lang('Discount')}}</th>
					<th>{{_lang('Net Total')}}</th>
					<th>{{_lang('Invoice No')}}</th>
					<th>{{_lang('Transactions Date')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($models as $key => $item)
				<tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$item->customer->customer_name }}</td>
                    <td>{{$item->sub_total}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                    <td>{{$item->discount}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                    <td>{{$item->net_total}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
					<td><a target="_blank" href="{{route('admin.sale.saleinvoice', $item->id)}}"><span class="badge badge-success">#invoice: {{$item->invoice_no}}</span></a> </td>
                    <td>{{dateDisplay($item->transactions_date) }}</td>
                    <td><a target="_blank" href="{{route('admin.sale.show', $item->id)}}"><span class="badge badge-success">View</span></a> </td>
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