@extends('layouts.app', ['title' => 'Purchase Report', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Purchase Report</span>
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
		<a href="{{route('admin.employees.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Purchase Report')}}
			<span class="text-info">( {{isset($models[0])?$models[0]->employess->employe_name:'Record Not Found'}} )</span>
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
					<th>{{_lang('Invoice No')}}</th>
					<th>{{_lang('Transactions Date')}}</th>
					<th>{{_lang('Pay Type')}}</th>
					<th>{{_lang('Action')}}</th>
					<th>{{_lang('Sub Total')}}</th>
					<th>{{_lang('Discount')}}</th>
					<th>{{_lang('Dou')}}</th>
					<th>{{_lang('Net Total')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($models as $key => $item)
				<tr>
                    <td>{{ $key+1 }}</td>
					<td><a target="_blank" href="{{route('admin.purchase.purchaseinvoice', $item->id)}}"><span class="badge badge-success">#invoice: {{$item->invoice_no}}</span></a> </td>
                    <td>{{dateDisplay($item->transactions_date) }}</td>
                    <td>
						@if ($item->due > 0)
						<span style="cursor: pointer;" data-url="{{route('admin.purchase.due', ['id'=>$item->id,'employe_id'=>$item->employess_id])}}" id="content_managment" class="badge badge-danger">Due</span>
						@else
							<span class="badge badge-success">Paid</span>
						@endif
					</td>
                    <td><a target="_blank" href="{{route('admin.purchase.show', $item->id)}}"><span class="badge badge-success">View</span></a> </td>
                    <td>{{$item->sub_total}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                    <td>{{$item->discount}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                    <td>{{$item->due}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                    <td>{{$item->net_total}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
				</tr>
				@endforeach
			</tbody>
			<tfooter>
				<tr>
					<th colspan="4"></th>
					<th>Total: </th>
					<th>{{ $models->sum('sub_total') }} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></th>
					<th>{{ $models->sum('discount') }} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></th>
					<th>{{ $models->sum('due') }} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></th>
					<th>{{ $models->sum('net_total') }} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></th>
				</tr>
			</tfooter>
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
<script>
 $(document).ready(function(){
	 $(document).on("keyup","#pay_due",function(){
		var pay_amount = checkValue(parseFloat($(this).val()));
		var paid = checkValue(parseFloat($("#P_paid").val()));
		var due = checkValue(parseFloat($("#pdue").val()));
		var totl_paid = checkValue(parseFloat(pay_amount +paid));
		var total_due = checkValue(parseFloat(due -pay_amount));
		 $("#paid").val(totl_paid);
		 $("#due").val(total_due);
	 });

 });

 function checkValue(s){
	if (isNaN(s) || !s ) {
		return 0;
	}
	return s;
 }
</script>
@endpush