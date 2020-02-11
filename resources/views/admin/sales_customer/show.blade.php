@extends('layouts.app', ['title' => 'Employees', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Employees</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="row">
	<div class="col-sm-2">
		<a class="btn btn-info" href="{{ route('admin.salescustomers.index') }}" >Back</a>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-9">
		<div class="">
			<h3 class="text-danger">Sale  Information</h3>
		</div>
	</div>
</div>
	<div class="row">	
		<div class="col-sm-1"></div>	
		<div class="col-sm-10">
			
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic">
					<tr>
						<td>Product Name</td>
						<td>{{$model->productitem->product_name}}</td>
					</tr>
					<tr>
						<td>Customer Nmae</td>
						<td>{{$model->customer_name}}</td>
					</tr>
					<tr>
						<td>Customer Nmae</td>
						<td>{{$model->customer_number}}</td>
					</tr>
					<tr>
						<td>Vehicle Name</td>
						<td>{{$model->vehicle_name}}</td>
					</tr>
					<tr>
						<td>Vehicle Number</td>
						<td>{{$model->vehicle_number}}</td>
					</tr>
					<tr>
						<td>Stack Oil</td>
						<td>{{$model->oil_sale}} <span class="text-muted font-weight-bold">Liter</span></td>
					</tr>
					<tr>
						<td>Oil Price</td>
						<td>{{$model->oil_price}} <span class="text-muted font-weight-bold">Taka</span></td>
					</tr>
					
					<tr>
						<td>Total price of Oil</td>
						<td>{{$model->oil_total_price}} <span class="text-muted font-weight-bold">Taka</span></td>
					</tr>
					<tr>
						<td>Stack Date</td>
						<td>{{$model->sale_date}}</td>
					</tr>
					<tr>
						<td>Description</td>
						<td>{{$model->cus_description}}</td>
					</tr>
					<tr>
						<td>Status</td>
						<td>
							@if($model->status==1)
								<span class="badge badge-success">Active</span>
								@else
								<span class="badge badge-danger">Inactive</span>
							
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
<script>
function myFunction() {
  window.print();
}
</script>
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