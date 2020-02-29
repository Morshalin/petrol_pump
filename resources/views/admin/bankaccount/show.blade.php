@extends('layouts.app', ['title' => 'Bank Account Detalis', 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Bank Account Detalis</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="row">
	<div class="col-sm-2">
		<a class="btn btn-info" href="{{ route('admin.bankaccount.index') }}" >Back</a>
	</div>
	<div class="col-sm-1"></div>
	<div class="col-sm-7">
	</div>
</div>
	<div class="row">
		<div class="col-sm-2">
			<div class="text-center">
			</div>
		</div>	
		<div class="col-sm-1"></div>	
		<div class="col-sm-7">
			
			<div class="card">
				<table class="table table-bordered datatable-button-init-basic text-center">
					<tr>
						<td><span class="text-danger">Account Name:</span> {{$model->acc_name}}</td>
						<td><span class="text-danger">Account Number</span> : {{$model->acc_no}}</td>
						<td><span class="text-danger">Contact Person: </span>{{$model->contact_persion}}</td>
						<td><span class="text-danger">Opening Balance: </span>{{$model->opening_balance}} <span class="text-muted font-weight-bold">Tk</span></td>
					</tr>
					<tr>
						<td><span class="text-danger">Total Credit Transaction</span></td>
						<td colspan="3">{{$model->transaction->where('acc_type','Credit')->sum('amount')}} <span class="text-muted font-weight-bold">Tk</span></td>
					</tr>
					<tr>
						<td><span class="text-danger">Total Debit Transaction</span></td>
						<td colspan="3">{{$model->transaction->where('acc_type','Debit')->sum('amount')}} <span class="text-muted font-weight-bold">Tk</span></td>
					</tr>
					<tr>
						<td><span class="text-danger">Still Amount</span></td>
						<td colspan="3">{{$model->transaction->where('acc_type','Credit')->sum('amount') - $model->transaction->where('acc_type','Debit')->sum('amount')}} <span class="text-muted font-weight-bold">Tk</span></td>
					</tr>
					<tr>
						<td><span class="text-danger">Note: </span></td>
						<td colspan="3">{{$model->note}}</td>
					</tr>

	
				</table>
			</div>
		</div>
	</div>
	
			
<!-- /basic initialization -->
@stop
@push('scripts')

<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ asset('asset/global_assets/js/plugins/uploaders/fileinput/fileinput.min.js') }}"></script>
<script src="{{ asset('js/pages/user.js') }}"></script>
<script src="{{ asset('js/pages/table.js') }}"></script>
<!-- /tdeme JS files -->
@endpush