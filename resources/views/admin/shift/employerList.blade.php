@extends('layouts.app', ['title' => 'Purchase Report', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Purchase Report</span>
            </div>
            <a href="javascript:void(0)" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
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
					<th>#</th>
					<th>{{_lang('Employer Name')}}</th>
					<th>{{_lang('Email')}}</th>
					<th>{{_lang('Phone Number')}}</th>
					<th>{{_lang('Join Date')}}</th>
					<th>{{_lang('Address')}}</th>
				</tr>
			</thead>
			<tbody>
                @foreach ($models->employess as $key => $item)
				<tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->employe_name}}</td>
                    <td>{{$item->employe_email}}</td>
                    <td>{{$item->employe_number}}</td>
                    <td>{{$item->employe_join_date}}</td>
                    <td>{{$item->employe_address}}</td>
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