@extends('layouts.app', ['title' => 'Purchase Due', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Purchase List</span>
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
		@can('productPurchase.create')
		<h5 class="card-title">{{_lang('Purchase Product')}}
			{{-- Create New Employeer Button --}}
			<a href="{{ route('admin.purchase.create') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Purchase Product')}} </a>
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
					<th>{{_lang('Si.')}}</th>
					<th>{{_lang('Product Name')}}</th>
					<th>{{_lang('Company Name')}}</th>
					<th>{{_lang('Vehicel NO')}}</th>
					<th>{{_lang('Employee Name')}}</th>
					<th>{{_lang('Pay Method')}}</th>
					<th>{{_lang('Pay Type')}}</th>
					<th>{{_lang('Net Total')}}</th>
					<th>{{_lang('Paid')}}</th>
					<th>{{_lang('Due')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($models as $key=>$data)
				<tr>
					<td>{{ $key+1}}</td>
					<td>
						@foreach ($data->purchase_line as $item)
							<span class="badge badge-info">{{$item->item->product_name}}</span>
						@endforeach
					</td>
					<td>{{$data->company->company_name}}</td>
					<td>
						@foreach ($data->purchase_line as $line_item)
							<span class="badge badge-info">{{$line_item->vehicle_no}}</span>
						@endforeach
					</td>
					<td>{{$data->employess->employe_name}} </td>
					<td>{{$data->pay_method}} </td>
					<td>
						@if ($data->due > 0)
							@can('productPurchase.due')
							<span style="cursor: pointer;" data-url="{{route('admin.purchase.due', $data->id)}}" id="content_managment" class="badge badge-danger">Due</span>
							@endcan
						@else
							<span class="badge badge-success">Paid</span>
						@endif
					</td>
					<td>{{$data->net_total}} </td>
					<td>{{$data->paid}} </td>
					<td>{{$data->due}} </td>
					<td class="text-center">
						<div class="list-icons">
							<div class="dropdown">
								<a href="#" class="list-icons-item" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									@can('productPurchase.show')
									<a href="{{ route('admin.purchase.show', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
									@endcan
									@can('productPurchase.invoice')
									<a target="_blank" href="{{ route('admin.purchase.purchaseinvoice', $data->id) }}" class="dropdown-item"><i class="icon-newspaper"></i>Purchase Ivoice</a>
									@endcan
									@can('productPurchase.due')
									@if ($data->due > 0)
										<span style="cursor: pointer;" class="dropdown-item" data-url="{{route('admin.purchase.due', $data->id)}}" id="content_managment"><i class="icon-cross2"></i> Payment</span>
									@else
										<span style="cursor: not-allowed;" class="dropdown-item"><i class="icon-cross2"></i> Payment</span>
									@endif
                                   @endcan
                                   @can('productPurchase.update') 
                                    <a href="{{ route('admin.purchase.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
                                    @endcan
                                    @can('productPurchase.delete')
									<span data-id="{{$data->id}} " data-url="{{route('admin.purchase.destroy',['id'=>$data->id,'slug'=> $data->product_item_id])}} " class="dropdown-item" id="delete_item"><i class="icon-cross2"></i> Delete</span>
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