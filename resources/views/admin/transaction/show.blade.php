@extends('layouts.app', ['title' => 'Expense', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Expense</span>
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
		<a class="btn btn-info" href="{{ route('admin.expenseall.index') }}" >Back</a>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-7">
		<div class="">
			<h3 class="text-danger">Expense Information</h3>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-sm-2"></div>	
		<div class="col-sm-1"></div>	
		<div class="col-sm-7">
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic text-center">
					<tr>
						<td>Expense Name</td>
						<td>{{$model->expenseCategory->name}}</td>
					</tr>
					<tr>
						<td>Amount</td>
						<td>{{$model->amount}}</td>
					</tr>
					<tr>
						<td>Reson</td>
						<td>{{$model->reson}}</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>{{$model->date}}</td>
					</tr>
					<tr>
						<td>Note</td>
						<td>{{$model->note}}</td>
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