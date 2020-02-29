@extends('layouts.app', ['title' => _lang('Cutomer manage')])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Customer</span>
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
		<a href="{{route('admin.customer.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Cutomer manage')}}
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
    	<form action="{{route('admin.customer.store')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="customer_name">{{ _lang('Customer Name') }}<span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" name="customer_name" id="customer_name">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="customer_number">{{ _lang('Customer Number') }}<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="customer_number" id="customer_number">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="alter_number">{{ _lang('Alternate Number') }}</label>
	        	<input type="text" class="form-control" name="alter_number" id="alter_number">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="customer_email">{{ _lang('Customer Email') }}</label>
	        	<input type="email" class="form-control" name="customer_email" id="customer_email">
	          </div>
			 </div>
			 
			 <div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="vehicle_name">{{ _lang('Vehicle Name') }}<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="vehicle_name" id="vehicle_name">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="vehicle_number">{{ _lang('Vehicle Number') }}<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="vehicle_number" id="vehicle_number">
	          </div>
	     	</div>

			<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="customer_address">{{ _lang('Photo') }}</label>
	        	<input type="file" name="image" id="image" class="form-control">
	          </div>
	     	</div>

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="customer_address">{{ _lang('Customer Address') }}</label>
	        	<textarea name="customer_address" id="customer_address" cols="3" rows="3" class="form-control"></textarea>
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
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Customer')}}<i class="icon-arrow-right14 position-right"></i></button>
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