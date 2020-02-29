@extends('layouts.app', ['title' => 'Employees', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Absences</span>
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
		<a href="{{route('admin.adsence.list')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-7">
		<div class="">
			<h3 class="text-danger">Employe Information</h3>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-sm-2">
			<div class="text-center">
				<img src="{{ asset('uploads/employer')."/".$model->employee->image}}" alt="" width="200">
			</div>
		</div>	
		<div class="col-sm-1"></div>	
		<div class="col-sm-7">
			
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic text-center">
					<tr>
						<td>ID NO.</td>
						<td>{{$model->employee->employe_id_no}}</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>{{$model->employee->employe_name}}</td>
					</tr>
					<tr>
						<td>Alt.Number</td>
						<td>{{$model->employee->alter_number}}</td>
					</tr>
					<tr>
						<td>Number</td>
						<td>{{$model->employee->employe_number}}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{{$model->employee->employe_email}}</td>
					</tr>
					
					
					<tr>
						<td>Post Name</td>
						<td>{{$model->employee->post->post_name}}</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>{{$model->employee->employe_gender}}</td>
					</tr>
					
					<tr>
						<td>Duty Time</td>
						<td>{{$model->employee->shift->shift_time}}</td>
					</tr>
					
					<tr>
						<td>Address</td>
						<td>{{$model->employee->employe_address}}</td>
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