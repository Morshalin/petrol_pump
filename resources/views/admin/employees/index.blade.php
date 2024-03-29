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
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		@can('employe.create')
		<h5 class="card-title">{{_lang('Add New Employees')}}
			{{-- Create New Employeer Button --}}
			<a href="{{ route('admin.employees.create') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Create')}} </a>
		</h5>
		@endcan
		@can('employeAdsence.list')
		<h5 class="card-title">{{_lang('')}}
			{{-- Create New Employeer Button --}}
			<a href="{{ route('admin.adsence.list') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-list2 mr-1"></i>{{_lang('Absence List')}} </a>
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
					<th>{{_lang('So.')}}</th>
					<th>{{_lang('ID NO.')}}</th>
					<th>{{_lang('Name')}}</th>
					<th>{{_lang('Number')}}</th>
					<th>{{_lang('Shift Time')}}</th>
					<th>{{_lang('Post')}}</th>
					<th>{{_lang('Image')}}</th>
					<th>{{_lang('Status')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($models as $key=>$data)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$data->employe_id_no}}</td>
					<td>{{$data->employe_name}}</td>
					<td>{{$data->employe_number}}</td>
					<td>{{$data->shift?$data->shift->shift_time:""}}</td>
					<td>{{$data->post->post_name}}</td>
					<td><img src="{{ asset('uploads/employer')."/".$data->image}}" alt="" width="50"></td>
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
									@can('employe.purchase')
									<a href="{{ route('admin.employer.purchase.show', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>Purchase View</a>
									@endcan
									@can('employe.view')
									<a href="{{ route('admin.employees.show', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
									@endcan
									@can('employe.update')
									<a href="{{ route('admin.employees.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil7"></i> Edit</a>
									@endcan
									@can('employeAdsence.create')
									@if ($data->status == 1)
										<a href="{{ route('admin.addAdsence', $data->id) }}" class="dropdown-item"><i class="icon-flip-vertical2"></i>Absence</a>
									@endif
									
									@endcan
									@can('employe.delete')
									<span data-id="{{$data->id}} " data-url="{{route('admin.employees.destroy',$data->id)}} " class="dropdown-item" id="delete_item"><i class="icon-cross2"></i> Delete</span>
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
@endpush