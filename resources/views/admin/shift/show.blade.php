@extends('layouts.app', ['title' => 'Employee', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Shift Time</span>
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
		<a href="{{route('admin.shift.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-7">
		<div class="">
			<h3 class="text-danger text-center">Employee Information</h3>
		</div>
	</div>
</div>
	<div class="row">	
		<div class="col-sm-12">
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic text-center">
					<thead>
						<tr>
							<th>Si.</th>
							<th>Employe ID NO</th>	
							<th>Employe Name</th>	
							<th>Employe Number</th>	
							<th>Employe Email</th>	
							<th>Post Name</th>	
							<th>Shift Name</th>	
							<th>image</th>	
						</tr>	
					</thead>
					<tbody>
						@foreach ($models->employess as $key => $item)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$item->employe_id_no}}</td>
								<td>{{$item->employe_name}}</td>
								<td>{{$item->employe_number}}</td>
								<td>{{$item->employe_email}}</td>
								<td>{{$item->post->post_name}}</td>
								<td>{{$item->shift->shift_time}}</td>
								<td><img src="{{ asset('uploads/employer')}}/{{$item->image}}" alt="photo" width="50"></td>
							</tr>
						@endforeach	
					</tbody>		
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