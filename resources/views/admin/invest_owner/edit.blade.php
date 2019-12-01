@extends('layouts.app', ['title' => _lang('Customer manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Customer manage')}}
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
		<fieldset class="mb-3" id="form_field">
    	<form action="{{route('admin.investowner.update', $model->id)}}" method="post" id="content_form">
		@csrf
		@method('PUT')
	     <div class="row">
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="customer_name">Owner Name <span class="text-danger">*</span></label>
			   <input type="text" class="form-control" name="owner_name" value="{{$model->owner_name}}" id="owner_name">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="owner_number">Owner Number <span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="owner_number" value="{{$model->owner_number}}" id="owner_number">
	          </div>
	     	</div>


	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="owner_email">Owner Email</label>
	        	<input type="email" class="form-control" name="owner_email" value="{{$model->owner_email}}" id="owner_email">
	          </div>
			 </div>
			 
			 

			<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="customer_address">Photo</label>
	        	<input type="file" name="image" id="image" class="form-control">
	          </div>
	     	</div>

	     </div>

	     <div class="row">
	     	<div class="col-md-4">
	     		<div class="form-check form-check-switchery form-check-inline">
					<label class="form-check-label">
						<input type="checkbox" name="status" value="1" id="status" class="form-check-status-switchery" checked data-fouc>
					</label>
				</div>
	     	</div>
	     </div>

		<div class="text-right">
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Owner')}}<i class="icon-arrow-right14 position-right"></i></button>
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