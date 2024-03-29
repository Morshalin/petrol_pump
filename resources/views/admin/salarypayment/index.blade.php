@extends('layouts.app', ['title' => _lang('Salary Setup manage')])
@section('page.header')
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Salary Payment</span>
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

	
	<div class="card-body">
		<div style="" id="pay_advance">
			<fieldset class="mb-3" id="form_field">
				<form action="{{route('admin.salarypayment.store')}}" method="post" id="content_form">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="salary_pay_month">Pay Month<span class="text-danger">*</span></label>
								<input type="text" class="form-control month clear1" name="salary_pay_month" id="salary_pay_month" readonly>
								{{-- <input id="NoIconDemo" type="text" /> --}}
							</div>
						</div>
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
								<label for="payable_salary">Payable Salary<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control clear1" name="payable_salary" id="payable_salary">
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="pay_date">Pay Salary Date<span class="text-danger">*</span></label>
								<input type="text" class="form-control date clear1" name="pay_date" id="pay_date">
							</div>
						</div>
					</div>

					<div class="text-right">
						@can('salary.pay')
						<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Salary Pay ')}}<i class="icon-paypal position-right"></i></button>
						<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
						@endcan
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
		$(document).on('change','#employesse_id, #advance_date', function(){
			var employer_name = $("#employesse_id").val();
			var paymonth = $("#advance_date").val();
			$.ajax({
				url:"{{route('admin.salarysetups')}}",
				type:'get',
				dataType:'json',
				data:{employer_name:employer_name,paymonth:paymonth},
				success:function(data){
					$("#employe_id_no").val(data.model.employe_id_no);
					$("#post_name").val(data.model.post.post_name);
					$("#employe_sallary").val(data.model.employe_sallary);
					if (data.advance) {
					if(data.advance.advance_pay){
						$("#advance_pay").val(data.advance.advance_pay);
						$("#payable_salary").val(data.advance.payable_salary);						
						//$("#date").val(data.advance.advance_date);						
					}
					}else{
						$("#advance_pay").val(0);
						$("#payable_salary").val(data.model.employe_sallary);
						//$("#date").val("");
					}
				}
			});
		});


		$(document).on('change','#salary_pay_month, #employesse_id_pay', function(){
			var employer_name = $("#employesse_id_pay").val();
			var paymonth = $("#salary_pay_month").val();
			$.ajax({
				url:"{{route('admin.salarysetups')}}",
				type:'get',
				dataType:'json',
				data:{employer_name:employer_name,paymonth:paymonth},
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
				$("#pay_salary").show('slow');
				$.ajax({
					
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