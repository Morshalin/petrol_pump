@extends('layouts.app', ['title' => _lang('Invoice manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Invoice manage')}}
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
	     	  	<label for="customer_name">Customer Name <span class="text-danger">*</span></label>
	     	  	<select name="customer_name" id="customer_name" class="form-control select">
	     	  	@foreach ($cus_name as $data)
	     	  		<option value="{{$data->id}}">{{$data->customer_name}}</option>
	     	  	@endforeach
	     	  </select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="amount_petrol">Amount of Petrol</label>
	        	<input type="text" class="form-control" name="amount_petrol" id="amount_petrol">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="amount_disel">Amount of Desel</label>
	        	<input type="text" class="form-control" name="amount_disel" id="amount_disel">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="petrol_pay_bill">Pay Bill of Petrol</label>
	        	<input type="email" class="form-control" name="petrol_pay_bill" id="petrol_pay_bill">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="disel_pay_bill">Pay Bill of Disel</label>
	        	<input type="text" class="form-control" name="disel_pay_bill" id="disel_pay_bill">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="total_pay_bill">Total Bill<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="total_pay_bill" id="total_pay_bill">
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
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create User')}}<i class="icon-arrow-right14 position-right"></i></button>
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