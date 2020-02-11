@extends('layouts.app', ['title' => _lang('items  manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('items  manage')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-10 offset-1">
			<div class="card-body form-control">
				<fieldset class="mb-3" id="form_field">
					<form action="{{route('admin.items.update', $model->id)}}" method="post" id="content_form">
						@csrf
						@method('PUT');
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="product_name">Product Name<span class="text-danger">*</span></label>
									<input type="text" class="form-control" value="{{$model->product_name}}" name="product_name" id="product_name">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="opening_qty">Opening Quantity<span class="text-danger">*</span></label>
									<input type="text" class="form-control"  value="{{$model->opening_qty}}" name="opening_qty" id="opening_qty">
								</div>
							</div>
							<input type="hidden" value="opening" name="stock_type">
							<div class="col-md-4">
								<div class="form-group">
									<label for="stock">Stock Quantity<span class="text-danger">*</span></label>
									<input type="text"  value="{{$model->stock}}" class="form-control" name="stock" id="stock">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="cost_price">Cost Price<span class="text-danger">*</span></label>
									<input type="text"  value="{{$model->cost_price}}" class="form-control" name="cost_price" id="cost_price">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="sale_price">Sale Price<span class="text-danger">*</span></label>
									<input type="text"  value="{{$model->sale_price}}" class="form-control" name="sale_price" id="sale_price">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="stock_date">Stock Date<span class="text-danger">*</span></label>
									<input type="text" class="form-control date" value="{{$model->stock_date}}" name="stock_date" id="stock_date">
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
							<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
							<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
						</div>
					</form>
				<fieldset class="mb-3" id="form_field">
			</div>
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
<!-- /theme JS files -->
@endpush