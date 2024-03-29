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
	<div class="col-sm-1">
		<a href="{{route('admin.employees.index')}}" class="btn btn-info btn-lg mt-1" ><i class="icon-arrow-left7"></i> Back</a>
	</div>
	<div class="col-sm-9">
		<div class="card">
			<h3 class="text-info text-uppercase text-center pt-1">Employees Information</h3>
		</div>
	</div>
</div>
	<div class="row">
		<div class="col-sm-2">
			<div class="text-center">
				<img class="img-fluid img-thumbnail" src="{{ asset('uploads/employer')."/".$model->image}}" alt="" width="">
			</div>
		</div>	
		
		<div class="col-sm-8">
			
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic">
					<tr>
						<td>ID NO.</td>
						<td>{{$model->employe_id_no}}</td>
					</tr>
					<tr>
						<td>Name</td>
						<td>{{$model->employe_name}}</td>
					</tr>
					<tr>
						<td>Alt.Number</td>
						<td>{{$model->alter_number}}</td>
					</tr>
					<tr>
						<td>Number</td>
						<td>{{$model->employe_number}}</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>{{$model->employe_email}}</td>
					</tr>
					<tr>
						<td>Employe Age</td>
						<td>{{$model->employe_age}}</td>
					</tr>
					
					<tr>
						<td>Post Name</td>
						<td>{{$model->post->post_name}}</td>
					</tr>
					<tr>
						<td>Gender</td>
						<td>{{$model->employe_gender}}</td>
					</tr>
					<tr>
						<td>Join Date</td>
						<td>{{dateDisplay($model->employe_join_date)}}</td>
					</tr>
					<tr>
						<td>Duty Time</td>
						<td>{{$model->shift->shift_time}}</td>
					</tr>
					<tr>
						<td>Sallary</td>
						<td>{{$model->employe_sallary}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
					</tr>
					<tr>
						<td>Address</td>
						<td>{{$model->employe_address}}</td>
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
				<div class="text-right">
					<a href="{{route('admin.employees.index')}}" class="btn btn-info btn-sm m-2" ><i class="icon-arrow-left7"></i> Back</a>
				</div>
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