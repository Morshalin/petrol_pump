@extends('layouts.app', ['title' => 'Salary Setup', 'modal' => true])
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
		@can('salarySetup.create')
		<h5 class="card-title">{{_lang('Salary Setup')}}
			{{-- Create New Employeer Button --}}
			<a href="{{ route('admin.salarysetup.create') }}" class="btn btn-outline alpha-info text-info-800 border-info-600 rounded-round"><i class="icon-stack-plus mr-1"></i>{{_lang('Create')}} </a>
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
					<th>{{_lang('Post Name')}}</th>
					<th>{{_lang('Sallary')}}</th>
					<th>{{_lang('Status')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($models as $key=>$data)
				<tr>
					<td>{{ $key+1}}</td>
					<td>{{$data->employe_id_no}}</td>
					<td>{{$data->employe->employe_name}}</td>
					<td>{{$data->post_name}}</td>
					<td>{{$data->employe_sallary}} <span class="text-muted font-weight-bold">Taka</span></td>
					<td>
						@if($data->status==1)
						<span class="badge badge-success">Active</span>
						@else
						<span class="badge badge-danger">Inactive</span>
						@endif
					</td>
					<td>
						<div>
							@can('salarySetup.delete')
							<span data-id="{{$data->id}} " data-url="{{route('admin.salarysetup.destroy',$data->id)}} " class="btn btn-danger btn-sm" id="delete_item">Delete</span>
							@endcan
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