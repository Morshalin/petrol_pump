@extends('layouts.app', ['title' => _lang('Customer')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Customers manage')}}
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

		<div class="row">
			<div class="col-sm-6 offset-3">
				<form action="" class="form-control mb-2">
					<div class="form-group">
						<label for="our_customer">Select Customers</label>
						<select data-placeholder="Select One" name="our_customer" id="our_customer" class="form-control select">
							<option value="">Select One</option>
							<option value="new_customers">New Customers</option>
							<option value="existing_customers">Existing Customers</option>
						</select>
					</div>
					<div id="customert_type" style="display:none">
						<div class="form-group">
							<label for="existing_cus">Our Customers</label>
							<select data-placeholder="Select One" name="existing_cus" id="existing_cus" class="form-control select">
								
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>

	<div id="customer" style="display:none">
    <fieldset class="mb-3" id="form_field">
    	<form action="{{route('admin.salescustomers.store')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
			 <input type="hidden" value="{{$user_id}}" name="user_id" id="user_id" >
			 <input type="hidden" name="customer_id" id="customer_id" >

			<div class="col-md-6">
	     	  <div class="form-group">
				<label for="customer_name">Customer Name<span class="text-danger">*</span></label>
				<input type="text" name="customer_name" id="customer_name" class="form-control clear" value="">
	          </div>
			 </div>
			 
			<div class="col-md-6">
	     	  <div class="form-group">
				<label for="customer_number">Customer Number<span class="text-danger">*</span></label>
				<input type="text" name="customer_number" id="customer_number" class="form-control clear" value="">
	          </div>
	     	</div>
	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="product_id">Product Name<span class="text-danger">*</span></label>
	        	<select name="product_id" id="product_id" class="form-control select">
					<option value="">Select One</option>
					@foreach ($oil_name as $item)
						<option value="{{$item->id}}">{{$item->product_name}}</option>
					@endforeach
	        	</select>
	          </div>
	     	</div>

			<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="vehicle_name">Vehicle Name</label>
	        	<input type="text" class="form-control clear" name="vehicle_name" id="vehicle_name">
	          </div>
	     	</div>

			 <div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="vehicle_number">Vehicle Number</label>
	        	<input type="text" class="form-control clear" name="vehicle_number" id="vehicle_number">
	          </div>
	     	</div>
	     	
	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="oil_sale">Oil Sale<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control clear" name="oil_sale" id="oil_sale">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="oil_price">Per Litter Price<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control clear" name="oil_price" id="oil_price">
	          </div>
	     	</div>
	     	
			 <div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="oil_total_price">Total Price<span class="text-danger">*</span></label>
	        	<input type="text" readonly="" class="form-control clear" name="oil_total_price" id="oil_total_price">
	          </div>
	     	</div>

			 <div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="sale_date">Sale Date<span class="text-danger">*</span></label>
	        	<input type="date" class="form-control date clear" name="sale_date" id="sale_date">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="cus_description">Description</label>
	        	<textarea name="cus_description" id="cus_description" cols="3" rows="2" class="form-control clear"></textarea>
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
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Submit')}}<i class="icon-arrow-right14 position-right"></i></button>
	    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

	 </div>
	</form>
     <fieldset class="mb-3" id="form_field">
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

<script>
	$(document).ready(function(){
		$(document).on("keyup","#oil_sale, #oil_price",function(){
			var total_oil = $('#oil_sale').val();
			var per_price = $('#oil_price').val();
			var total_amount = total_oil*per_price;
			 $('#oil_total_price').val(total_amount);
			;
		});


		$(document).on("select2:select", "#our_customer", function(){
			var option = $(this).val();
			if (option=='new_customers') {
				$("#customer").show('slow');
				$("#customert_type").hide("slow");
				$('input[type=text]').val("");
			}else if(option=='existing_customers'){
				$("#customer").hide('slow');
				$("#customert_type").show("slow");
				$.ajax({
					url:"{{route('admin.ourcustomer')}}",
					method:'get',
					dataType:'html',
					success:function(data){
						$("#existing_cus").html(data);
						$("#existing_cus").trigger('change')
					}
				});
			}
		});

		$(document).on("change", "#existing_cus", function(){
			var customer_id = $(this).val();
			if (customer_id) {
				$("#customer").show('slow');
				$.ajax({
					url:"{{route('admin.customertype')}}",
					method:'get',
					data:{customer_id:customer_id},
					dataType:'json',
					success:function(data){
						var id = $('#customer_id').val(customer_id);
						$("#customer_name").val(data.model.customer_name);
						$("#customer_number").val(data.model.customer_number);
						$("#vehicle_name").val(data.model.vehicle_name);
						$("#vehicle_name").val(data.model.vehicle_name);
						$("#vehicle_number").val(data.model.vehicle_number);
						
					}
				});
			}
		});
	});
</script>
<!-- /theme JS files -->
@endpush