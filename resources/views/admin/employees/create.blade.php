@extends('layouts.app', ['title' => _lang('Employees manage')])
@section('page.header')
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Employe</span>
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
		<h5 class="card-title">{{_lang('Employees manage')}}
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
		{{-- <div class="text-center">
			<img src="{{ asset('asset/table_loader.gif') }}" id="table_loading" width="100px">
		</div> --}}
 
    <fieldset class="mb-3" id="form_field">
    	<form action="{{route('admin.employees.store')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_id_no">Employe ID NO. <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="{{$ref_no}}" name="employe_id_no" id="employe_id_no">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_name">Employe Name <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" name="employe_name" id="employe_name">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_number">Employe Number <span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="employe_number" id="employe_number">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="alter_number">Alternate Number</label>
	        	<input type="text" class="form-control" name="alter_number" id="alter_number">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_email">Employe Email</label>
	        	<input type="email" class="form-control" name="employe_email" id="employe_email">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_age">Employe Age <span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="employe_age" id="employe_age">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_post">Employe Post <span class="text-danger">*</span></label>
	        	<select name="post_id" id="post_id" class="form-control select">
	        		<option value="0">Select One</option>
	        		@foreach($models as $data)
	        		<option value="{{$data->id}}">{{$data->post_name}}</option>
	        		@endforeach
	        	</select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_gender">Employe Gender <span class="text-danger">*</span></label>
	        	<select name="employe_gender" id="employe_gender" class="form-control select">
	        		<option value="0">Select One</option>
	        		<option value="Male">Male</option>
	        		<option value="Female">Female</option>
	        		<option value="Others">Others</option>
	        	</select>
	          </div>
	     	</div>


	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_join_date">Employe Join Date<span class="text-danger">*</span></label>
	        	<input type="date" class="form-control date" name="employe_join_date" id="employe_join_date">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="shift_id">Employe shift</label>
	        	<select name="shift_id" id="shift_id" class="form-control select">
	        		<option value="0">Select One</option>
					@foreach($shift_time as $datas)
					<option value="{{$datas->id}}">{{$datas->shift_time}}</option>
					@endforeach
	        	</select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_sallary">Employe Sallary<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="employe_sallary" id="employe_sallary">
	          </div>
	     	</div>


			<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="image">Photo</label>
	        	<input type="file" name="image" id="image" class="form-control">
	          </div>
	     	</div>

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="employe_address">Employer Address</label>
	        	<textarea name="employe_address" id="employe_address" cols="3" rows="2" class="form-control"></textarea>
	          </div>
	     	</div>

	     </div>

	     <div class="row">
	     	<div class="col-md-4">
	     		<div class="form-check form-check-switchery form-check-inline">
					<label class="form-check-label">Status
						<input type="checkbox" name="status" value="1" id="status" class="form-check-status-switchery" checked data-fouc>
					</label>
				</div>
	     	</div>
	     </div>

		<div class="text-right">
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Employes')}}<i class="icon-arrow-right14 position-right"></i></button>
	    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

	 </div>
	</form>
     <fieldset class="mb-3" id="form_field">
  
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