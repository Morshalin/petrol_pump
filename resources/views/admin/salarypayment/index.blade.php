@extends('layouts.app', ['title' => _lang('Salary Setup manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Salary Payment')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-sm-6 offset-3">
			<form action="" class="form-control mb-2">
				<div class="form-group">
					<label for="pay_type">Chose One</label>
					<select data-placeholder="Select One" name="pay_type" id="pay_type" class="form-control select">
						<option value="">Select One</option>
						<option value="advance_pay">Advance Pay</option>
						<option value="salary_pay">Salary Pay</option>
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

	<div class="card-body">
		<div style="display:none" id="pay_advance">
			<fieldset class="mb-3" id="form_field">
				<form action="{{route('admin.salarypayment.store')}}" method="post" id="content_form">
					@csrf
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="employesse_id">Employe Name <span class="text-danger">*</span></label>
								<select data-placeholder="Select One" required name="employesse_id" id="employesse_id" class="form-controller select clear1">
									<option value="">Select One</option>
									@foreach ($employ_info as $data)
										<option value="{{$data->id}}">{{$data->employe_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="employe_id_no">Employe ID NO. <span class="text-danger">*</span></label>
								<input type="text" readonly="" name="employe_id_no" id="employe_id_no" class="form-control clear1">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="post_name">Employe Post <span class="text-danger">*</span></label>
								<input type="text" required readonly="" name="post_name" id="post_name" class="form-control clear1">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="employe_sallary">Employe Sallary<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control clear1" name="employe_sallary" id="employe_sallary">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="advance_pay">Advance Pay salary<span class="text-danger">*</span></label>
								<input type="number" min="0" class="form-control clear1" name="advance_pay" id="advance_pay">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="payable_salary">Payable Salary<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control clear1" name="payable_salary" id="payable_salary">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="advance_date">Advance Pay Month<span class="text-danger">*</span></label>
								<input type="text" class="form-control month clear1" name="advance_date" id="date" readonly>
								{{-- <input id="NoIconDemo" type="text" /> --}}
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="pay_date">Advance Pay Salary Date<span class="text-danger">*</span></label>
								<input type="text" class="form-control date clear1" name="pay_date" id="pay_date">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="advance_resion">Advance Reasion</label>
								<textarea name="advance_resion" id="advance_resion" cols="3" rows="3" class="form-control clear1"></textarea>
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
						<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Pay Advance')}}<i class="icon-arrow-right14 position-right"></i></button>
						<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
				</div>
				</form>
     		<fieldset class="mb-3" id="form_field">
		</div>

		<div style="display:none" id="pay_salary">
			<fieldset class="mb-3" id="form_field">
				<form action="{{route('admin.salarypayments.insert')}}" method="post" id="content_form1">
					@csrf
					<div class="row">

						<div class="col-md-6">
							<div class="form-group">
								<label for="employesse_id_pay">Employe Name <span class="text-danger">*</span></label>
								<select data-placeholder="Select One" required name="employesse_id" id="employesse_id_pay" class="form-controller select clear">
									<option value="">Select One</option>
									@foreach ($employ_info as $data)
										<option value="{{$data->id}}">{{$data->employe_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="employe_id_no_pay">Employe ID NO. <span class="text-danger">*</span></label>
								<input type="text" readonly="" name="employe_id_no" id="employe_id_no_pay" class="form-control clear">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="post_name_pay">Employe Post <span class="text-danger">*</span></label>
								<input type="text" required readonly="" name="post_name" id="post_name_pay" class="form-control clear">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="employe_sallary_pay">Employe Sallary<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control clear" name="employe_sallary" id="employe_sallary_pay">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="advance_pay_pay">Advance Pay salary<span class="text-danger">*</span></label>
								<input type="text"  class="form-control clear" name="advance_pay" id="advance_pay_pay">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="payable_salary_pay">Payable Salary<span class="text-danger">*</span></label>
								<input type="text" class="form-control clear" name="payable_salary" id="payable_salary_pay">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="salary_pay_month">Salary Pay Month<span class="text-danger">*</span></label>
								<input type="text" class="form-control month clear" name="salary_pay_month" id="date" readonly>
								{{-- <input id="NoIconDemo" type="text" /> --}}
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label for="pay_date_pay">Pay Salary Date<span class="text-danger">*</span></label>
								<input type="text" class="form-control date clear" name="pay_date" id="pay_date_pay">
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
						<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Setup')}}<i class="icon-arrow-right14 position-right"></i></button>
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
	_formValidation1();
	$(document).ready(function(){
		_componentStatusSwitchery();
	});
</script>
<!-- /theme JS files -->

<!-- Custom Js for employer salary -->

<script>
	$(document).ready(function(){
		$(document).on('change','#employesse_id', function(){
			var employer_name = $(this).val();
			// console.log(employer_name);
			$.ajax({
				url:"{{route('admin.setup')}}",
				type:'get',
				dataType:'json',
				data:{employer_name:employer_name},
				success:function(data){
					$("#employe_id_no").val(data.model.employe_id_no);
					$("#post_name").val(data.model.post.post_name);
					$("#employe_sallary").val(data.model.employe_sallary);
					if (data.advance) {
					if(data.advance.advance_pay){
						$("#advance_pay").val(data.advance.advance_pay);
						$("#payable_salary").val(data.advance.payable_salary);						
						$("#date").val(data.advance.advance_date);						
					}
					}else{
						$("#advance_pay").val(0);
						$("#payable_salary").val(data.model.employe_sallary);
						$("#date").val("");
					}
				}
			});
		});


		$(document).on('change','#employesse_id_pay', function(){
			var employer_name = $(this).val();
			$.ajax({
				url:"{{route('admin.setup')}}",
				type:'get',
				dataType:'json',
				data:{employer_name:employer_name},
				success:function(data){
					$("#employe_id_no_pay").val(data.model.employe_id_no);
					$("#post_name_pay").val(data.model.post.post_name);
					$("#employe_sallary_pay").val(data.model.employe_sallary);
					if (data.advance) {
					if(data.advance.advance_pay){
						$("#advance_pay_pay").val(data.advance.advance_pay);
						$("#payable_salary_pay").val(data.advance.payable_salary);						
					}
					}else{
						$("#advance_pay_pay").val(0);
						$("#payable_salary_pay").val(data.model.employe_sallary);
					}	
				}
			});
		});

		$(document).on("keyup","#advance_pay", function(){
			var advance_pay = parseInt($(this).val());
			var employe_sallary = parseInt($("#employe_sallary").val());

			if (advance_pay > employe_sallary) {
				alert('The advance payment can not be greater than the employee salary');
				$("#advance_pay").val('');
			}else{
				var salary = (employe_sallary-advance_pay);
				$("#payable_salary").val(salary);
			}
			
		});
	});
</script>


<script>
	$(document).ready(function(){

		$(document).on("select2:select", "#pay_type", function(){
			var option = $(this).val();
			if (option =='advance_pay') {
				$("#pay_advance").show('slow');
				$("#pay_salary").hide('slow');
				$(".clear").val('');
			}else if(option=='salary_pay'){
				$(".clear1").val('');
				$("#pay_advance").hide('slow');
				$("#pay_salary").show("slow");
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