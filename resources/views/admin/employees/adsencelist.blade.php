@extends('layouts.app', ['title' => 'Absence', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Absence</span>
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
		<a href="{{route('admin.employees.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Absence List manage')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="col-sm-6 mt-2">
	</div>
	<div class="card-body">
		<table class="table content_managment_table">
			<thead>
				<tr>
					<th>{{_lang('SO.')}}</th>
					<th>{{_lang('ID NO.')}}</th>
					<th>{{_lang('Name')}}</th>
					<th>{{_lang('Number')}}</th>
					<th>{{_lang('Shift Time')}}</th>
					<th>{{_lang('Post')}}</th>
					<th>{{_lang('Absence Start Date')}}</th>
					<th>{{_lang('Absence End Date')}}</th>
					<th>{{_lang('Action')}}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($models as $key=>$data)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$data->employe_id_no}}</td>
					<td>{{$data->employee->employe_name}}</td>
					<td>{{$data->employee->employe_number}}</td>
					<td>{{$data->shift_time}}</td>
					<td>{{$data->employee->post->post_name}}</td>
					<td>{{dateDisplay($data->start_date)}}</td>
					<td>{{dateDisplay($data->end_date)}}</td>
					<td class="text-center">
						<div class="list-icons">
							<div class="dropdown">
								<a href="#" class="list-icons-item" data-toggle="dropdown">
									<i class="icon-menu9"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									@can('employeAdsence.view')
									<a href="{{ route('admin.absence.show', $data->id) }}" class="dropdown-item"><i class="icon-eye"></i>View</a>
									@endcan
									@can('employeAdsence.edit')
									<a href="{{ route('admin.absence.edit', $data->id) }}" class="dropdown-item"><i class="icon-pencil7"></i>Change Leave Date</a>
									@endcan
									@can('employeAdsence.delete')
									<span data-id="{{$data->id}} " data-url="{{route('admin.absence.delete',['id'=>$data->id,'slug'=> $data->employe_id])}}" class="dropdown-item" id="delete_item"><i class="icon-cross2"></i> Delete</span>
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