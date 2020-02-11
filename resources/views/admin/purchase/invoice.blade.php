<!DOCTYPE html>
<html lang="en">
<head>
  <title>Purchase Invoice</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/colors.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/MonthPicker.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('asset/assets/css/examples.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{asset('asset/global_assets/css/extras/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{asset('/css/parsley.css')}}">
</head>
<body>


  
<div class="container">

<!-- Content area -->
<div class="content">

<!-- Invoice template -->
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4">
                <h4 class="mb-2 mt-md-2">Company Information</h4>
				<div class="mb-4">
					<ul  class="list list-unstyled mb-0">
						<li><span class="font-weight-bold">Name: </span>{{ get_option('company_name') }}</li>
						<li><span class="font-weight-bold">Email: </span>{{  get_option('email') }}</li>
						<li><span class="font-weight-bold">Number: </span>{{  get_option('phone')}}</li>
						<li><span class="font-weight-bold">Address: </span>{{ get_option('address') }}</li>
					</ul>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="mb-4">
					<div class="text-sm-center">
                        <h4 class="text-primary mb-2 mt-md-2">Invoice #{{ $model->invoice_no}}</h4>
						<ul class="list list-unstyled mb-0">
                            <li>Date: <span class="font-weight-semibold">{{date("F d, Y",strtotime($model->transactions_date)) }}</span></li>
						</ul>
					</div>
				</div>
            </div>
            
            <div class="col-sm-4">
                <div class="mb-4">
                    <div class="text-sm-right">
                        <h4 class="mb-2 mt-md-2">Employer Information</h4>
						<ul class="list list-unstyled mb-0">
							<li><span class="font-weight-bold">Name: </span>{{ $model->employess->employe_name}}</li>
							<li><span class="font-weight-bold">Number: </span>{{ $model->employess->employe_number}}</li>
                            <li><span class="font-weight-bold">Email: </span>{{ $model->employess->employe_email}}</li>
							<li><span class="font-weight-bold">Address: </span>{{ $model->employess->employe_address}}</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive">
		<table class="table table-sm">
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
				 @foreach ($model->purchase_line as $key=> $element)
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

	<div class="card-body mt-1">
		<div class="d-md-flex flex-md-wrap">
			<div class="col-md-7 pt-2 mb-3">
				<div class="table-responsive">
					<table class="table table-sm">
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
				<div class="table-responsive">
					<table class="table table-sm">
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
    <div class="card-footer">
        <span class="text-muted">Copyright © 2020 || Designed And Developed By <strong class="text-info">SATT IT</strong></span>
    </div>
</div>
<!-- /invoice template -->
</div>
</div>
</body>
</html>
