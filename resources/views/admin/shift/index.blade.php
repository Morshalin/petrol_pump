@extends('layouts.app', ['title' => 'Shift Time', 'modal' => true])
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
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Add New Shift Time')}}
		@can('user.create')
		<a href="{{ route('admin.shift.create') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Create')}} </a>
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
					<th>So.</th>
					<th>Shift Time</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			 @foreach($models as $key=>$data)
				<tr>
					<td>{{ $key+1}}</td>
					<td>{{$data->shift_time}}</td>
					<td>
						@if($data->status==1)
							<span class="badge badge-success">Active</span>
							@else
							<span class="badge badge-danger">Inactive</span>
						
						@endif
					</td>
					<td class="text-center">
						<div class="list-icons">
							<div class="dropdown">
								<a href="#" class="list-icons-item" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">

									<a href="{{ route('admin.shift.employe.list', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>Employer View</a>
									<a href="{{ route('admin.shift.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
									<a href="{{ route('admin.shift.show', $data->id) }}" class="dropdown-item"><i class="icon-list-numbered"></i>Employee List</a>
									
									<span data-id="{{$data->id}} " data-url="{{route('admin.shift.destroy',$data->id)}} " class="dropdown-item" id="delete_item"><i class="icon-cross2"></i>Delete</span>
									
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
@endpush