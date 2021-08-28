@extends('layouts.app', ['title' => 'Customer', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>{{_lang('Customer')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="row">
	<div class="col-sm-1">
	<a href="{{route('admin.customer.index')}}" class="btn btn-info btn-lg mt-1" ><i class="icon-arrow-left7"></i> Back</a>
	</div>
	
	<div class="col-sm-9">
		<div class="card">
			<h3 class="text-info pt-1 text-center">{{_lang('Customer Information')}}</h3>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-sm-2">
			<div class="text-center">
				<img class="img-fluid img-thumbnail" src="{{ asset('uploads/customers')."/".$model->image}}" alt="Photo">
			</div>
		</div>	
		<div class="col-sm-8">
			
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic">
					<tr>
						<td>{{_lang('Customer Name')}}</td>
						<td>{{$model->customer_name}}</td>
					</tr>
					<tr>
						<td>{{_lang('Alt.Number')}}</td>
						<td>{{$model->alter_number}}</td>
					</tr>
					<tr>
						<td>{{_lang('Number')}}</td>
						<td>{{$model->customer_number}}</td>
					</tr>
					<tr>
						<td>{{_lang('Email')}}</td>
						<td>{{$model->customer_email}}</td>
					</tr>
					<tr>
						<td>{{_lang('Vehicle Name')}}</td>
						<td>{{$model->vehicle_name}}</td>
					</tr>
					<tr>
						<td>{{_lang('Vehicle Number')}}</td>
						<td>{{$model->vehicle_number}}</td>
					</tr>
					
					<tr>
						<td>{{_lang('Address')}}</td>
						<td>{{$model->customer_address}}</td>
					</tr>
					<tr>
						<td>{{_lang('Status')}}</td>
						<td>
							@if($model->status==1)
								<span class="badge badge-success">{{_lang('Active')}}</span>
								@else
								<span class="badge badge-danger">{{_lang('Inactive')}}</span>
							
							@endif
						</td>
					</tr>		
				</table>
				
			</div>
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
<script src="{{ asset('js/pages/user.js') }}"></script>
<script src="{{ asset('js/pages/table.js') }}"></script>
<!-- /tdeme JS files -->
@endpush