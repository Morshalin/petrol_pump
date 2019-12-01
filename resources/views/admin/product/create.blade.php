@extends('layouts.app', ['title' => _lang('Product')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Products manage')}}
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
		<form action="{{route('admin.product.store')}}" method="post" id="content_form">
			<div class="row">
				<div class="col-sm-4 mt-2 form-contrllor offset-4 form-control">
					<div class="form-group">
						<label for="payment_option">Chosse Payment</label>
						<select data-placeholder="Select One" name="payment_option" id="payment_option" class="form-control select">
							<option value="">Select One</option>
							<option value="investment">From Investment</option>
							<option value="savings">From savings</option>
						</select>
					</div>
				</div>
			</div>
			<div style="display:none" id="pay_option">
				@csrf
				<div class="row">

					<div class="col-md-6">
					<div class="form-group">
						<label for="product_item_id">Product Name<span class="text-danger">*</span></label>
						<select name="product_item_id" id="product_item_id" class="form-control select">
							<option value="0">Select One</option>
							@foreach($models as $data)
							<option value="{{$data->id}}">{{$data->product_name}}</option>
							@endforeach
						</select>
					</div>
					</div>

					<div class="col-md-6">
					<div class="form-group">
						<label for="company_id">Company Name<span class="text-danger">*</span></label>
						<select name="company_id" id="company_id" class="form-control select">
							<option value="">Select One</option>
							@foreach($company as $data)
							<option value="{{$data->id}}">{{$data->company_name}}</option>
							@endforeach
						</select>
					</div>
					</div>

					<input type="hidden" value="{{$user_id}}" name="user_id" id="user_id" >

					<div class="col-md-6">
					<div class="form-group">
						<label for="vehicle_name">Vehicle Name<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="vehicle_name" id="vehicle_name">
					</div>
					</div>

					<div class="col-md-6">
					<div class="form-group">
						<label for="vehicle_number">Vehicle Number<span class="text-danger">*</span></label>
						<input type="text" class="form-control" name="vehicle_number" id="vehicle_number">
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
						<label for="oil_stack">Oil Stock in Liter<span class="text-danger">*</span></label>
						<input type="number" min="0" step="0.01" class="form-control" name="oil_stack" id="oil_stack">
					</div>
					</div>

					<div class="col-md-6">
					<div class="form-group">
						<label for="oil_price">Per Liter Price<span class="text-danger">*</span></label>
						<input type="number" min="0" step="0.01"  class="form-control" name="oil_price" id="oil_price">
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
						<label for="oil_total_price">Total Price<span class="text-danger">*</span></label>
						<input type="text" readonly="" class="form-control" name="oil_total_price" id="oil_total_price">
					</div>
					</div>

					<div class="col-md-6">
					<div class="form-group">
						<label for="stack_date">Stack Date<span class="text-danger">*</span></label>
						<input type="date" class="form-control date" name="stack_date" id="stack_date">
					</div>
					</div>


					

					<div class="col-md-6">
					<div class="form-group">
						<label for="oil_description">Description</label>
						<textarea name="oil_description" id="oil_description" cols="3" rows="2" class="form-control"></textarea>
					</div>
					</div>

				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="form-check form-check-switchery form-check-inline">
							<label class="form-check-label">
								<input type="checkbox" name="status" id="status" class="form-check-status-switchery" checked data-fouc>
							</label>
						</div>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Product')}}<i class="icon-arrow-right14 position-right"></i></button>
					<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
				</div>
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

<script>
	$(document).ready(function(){
		
		$(document).on("keyup","#oil_stack, #oil_price",function(){
			var total_oil = $('#oil_stack').val();
			var per_price = $('#oil_price').val();
			var total_amount = total_oil*per_price;
			//console.log(total_amount);
			 $('#oil_total_price').val(total_amount);
			;
		});

	$(document).on("change","#payment_option",function(){
		$("#pay_option").show('slow');
	})
	});
</script>
<!-- /theme JS files -->
@endpush