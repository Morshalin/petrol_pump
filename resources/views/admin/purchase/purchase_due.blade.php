<form action="{{route('admin.purchase.duePay', $model->id)}}" id="content_form" method="post" >
@csrf
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="sub_total">{{_lang('Subtotal')}}</label>
			<input readonly type="text" class="form-control" value="{{$model->sub_total}}" name="sub_total" id="sub_total">
		</div>
	</div>
	<input type="hidden" name="employe_id" value="{{{ $employe_id }}}">
	<div class="col-md-4">
		<div class="form-group">
			<label for="discount">{{_lang('Discount')}}</label>
			<input type="text" readonly class="form-control" value="{{$model->discount}}" name="discount" id="discount">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="net_total">{{_lang('Net Total')}}</label>
			<input type="text" readonly class="form-control" value="{{$model->net_total}}" name="net_total" id="net_total">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="paid">{{_lang('Paid')}}</label>
			<input type="hidden" readonly class="form-control" name="P_paid" value="{{$model->paid}}" id="P_paid">
			<input type="number" readonly  min="0" step="0.01" class="form-control" name="paid" value="{{$model->paid}}" id="paid">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="due">{{_lang('Due')}}</label>
			<input type="hidden" readonly class="form-control" name="pdue" value="{{$model->due
			}}" id="pdue">
			<input type="text" readonly class="form-control" name="due" value="{{number_format((float) $model->due, 2)}}" id="due">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="pay_due">{{_lang('Due Payment')}}</label>
			<input type="text" type="number"  min="0" step="0.01" class="form-control" name="pay_due" id="pay_due">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="pay_date">{{_lang('Payment Date')}}</label>
			<input type="text" class="form-control date" name="pay_date" id="pay_date">
		</div>
	</div> 

	<div class="col-md-6">
		<div class="form-group">
			<label for="pay_method">{{_lang('Payment Method')}}</label>
			<select data-placeholder="Select One" name="pay_method" id="pay_method" class="form-control select">
				<option value="">Select One</option>
				@foreach ($pay_method as $pay_method_item)
					<option value="{{$pay_method_item->payMethodName}}">{{$pay_method_item->payMethodName}}</option>   
				@endforeach
			</select>
		</div>
	</div>
</div>

 <div class="text-right mt-2">
  <button type="submit" class="btn btn-primary btn-lg"  id="submit">{{_lang('create')}}</button>
  <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px">
</button>

 </div>
</form>