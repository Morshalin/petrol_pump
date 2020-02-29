@extends('layouts.app', ['title' => _lang('Product Sale')])
@section('content')
<div class="card">
<!-- Content area -->
<div class="content">

<!-- Invoice template -->
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-6">
				<div class="mb-4">
					<ul  class="list list-unstyled mb-0">
						<li>{{ get_option('company_name') }}</li>
						<li>{{  get_option('email') }}</li>
						<li>{{  get_option('phone')}}</li>
						<li>{{ get_option('address') }}</li>
					</ul>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="mb-4">
					<div class="text-sm-right">
						<ul class="list list-unstyled mb-0">
							<li>Date: <span class="font-weight-semibold">{{date("F d, Y",strtotime($model->transactions_date)) }}</span></li>
							<li>{{ $model->customer?$model->customer->customer_name:'Walk-In Customer'}}</li>
							<li>{{ $model->customer?$model->customer->customer_email:''}}</li>
							<li>{{ $model->customer?$model->customer->customer_number:''}}</li>
							<li>{{ $model->customer?$model->customer->customer_address:''}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-lg">
			<thead>
				<tr>
					<th>{{_lang('Si.')}}</th>
					<th>{{_lang('Product Name')}}</th>
					<th>{{_lang('Vehicle Name')}}</th>
					<th>{{_lang('Vehicle No.')}}</th>
					<th>{{_lang('Quantity')}}</th>
					<th>{{_lang('Unit Price')}}</th>
					<th>{{_lang('Total')}}</th>
				</tr>
			</thead>
			<tbody>
				 @foreach ($model->saleLine as $key=> $element)
				<tr>
					<td>{{$key+1}}</td>
					<td>{{$element->item->product_name}}</td>
					<td>{{$element->vehicle_name}}</td>
					<td>{{$element->vehicle_no}}</td>
					<td>{{$element->quantity}}</td>
					<td>{{$element->unit_price}}<span class="text-muted font-weight-bold"> Tk</span></td>
					<td>{{$element->total}}<span class="text-muted font-weight-bold"> Tk</span></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="card-body mt-5">
		<div class="d-md-flex flex-md-wrap">
			<div class="col-md-7 pt-2 mb-3">
				<div class="table-responsive">
					<table class="table table-lg">
						<thead>
							<tr>
								<th>#</th>
								<th>{{_lang('Date')}}</th>
								<th>{{_lang('Payment Method')}}</th>
								<th>{{_lang('Amount')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($model->transaction_payment as $key => $pay_element)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{date("F d, Y",strtotime($pay_element->pay_date))}}</td>
								<td>{{$pay_element->pay_method}}</td>
								<td>{{$pay_element->amount}}  <span class="text-muted font-weight-bold"> Tk</span></td> 
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>	
			</div>

			<div class="col-md-5 pt-2 ml-auto">
				<h6>Account</h6>
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Subtotal:</th>
								<td class="text-right">{{$model->sub_total}} <span class="text-muted font-weight-bold"> Tk</span></td>
							</tr>
							<tr>
								<th>Discount: </th>
								<td class="text-right">{{$model->discount}} <span class="text-muted font-weight-bold"> Tk</span></td>
							</tr>
							<tr>
								<th>Net Total:</th>
								<td class="text-right">{{$model->net_total}} <span class="text-muted font-weight-bold"> Tk</span></td>
							</tr>
							<tr>
								<th>Total Paid:</th>
								<td class="text-right">{{$model->paid}} <span class="text-muted font-weight-bold"> Tk</span></td>
							</tr>
							<tr>
								<th>Total Due:</th>
								<td class="text-right">{{$model->due}} <span class="text-muted font-weight-bold"> Tk</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /invoice template -->
</div>
</div>
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