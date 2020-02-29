@extends('layouts.app', ['title' => _lang('Company  manage')])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Comapany Information</span>
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
		<a href="{{route('admin.companyinfo.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Company  manage')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card-body form-control">
				<fieldset class="mb-3" id="form_field">
					<form action="{{route('admin.companyinfo.update', $model->id)}}" method="post" id="content_form">
						@csrf
						@method('PUT');
						
						<div class="row">
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="company_name">Company Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" name="company_name" value="{{$model->company_name}}" id="company_name">
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="number">Phone Number</label>
									<input type="text" class="form-control" value="{{ $model->number}}" name="number" id="number">
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" class="form-control" value="{{ $model->email}}" name="email" id="email">
								</div>
							</div>
							<div class="col-md-6 ">
								<div class="form-group">
									<label for="city">Town OR City Name</label>
									<input type="text" class="form-control" value="{{$model->city}}" name="city" id="city">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="address">Address</label>
									<textarea name="address" id="address" cols="3" rows="2" class="form-control">{{$model->address}}</textarea>
								</div>
							</div>
						</div>


						<div class="text-right">
							<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
							<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
						</div>
					</form>
				<fieldset class="mb-3" id="form_field">
			</div>
		</div>
	</div>
	
</div>

<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/pages/user.js') }}"></script>
<script>
	$(document).ready(function(){
		_componentStatusSwitchery();
	});
</script>
<!-- /theme JS files -->
@endpush