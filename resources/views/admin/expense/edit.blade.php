@extends('layouts.app', ['title' => _lang('Expense manage')])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Expense</span>
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
		<a href="{{route('admin.expenseall.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Expense manage')}}
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
    	<form action="{{route('admin.expenseall.update', $model->id)}}" method="post" id="content_form">
		@csrf
		@method('PUT')
	     <div class="row">
	     	<div class="col-md-6">
	     	  <div class="form-group">
				   <label for="expense_category_id">Expense Category <span class="text-danger">*</span></label>
				   <select data-placeholder="Select One" name="expense_category_id" id="expense_category_id" class="form-control select">
					   <option value="">Select One</option>
						@foreach ($models as $item)
					   <option {{$model->expense_category_id==$item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
				   		@endforeach
				   </select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="amount">Amount <span class="text-danger">*</span></label>
	        	<input type="text" value="{{$model->amount}}" class="form-control" name="amount" id="amount">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="reson">Reson</label>
	        	<input type="text" value="{{$model->reson}}" class="form-control" name="reson" id="reson">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="date">Date</label>
	        	<input type="text" value="{{$model->date}}" class="form-control date" name="date" id="date">
	          </div>
			 </div>

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="note">Note</label>
	        	<textarea name="note" id="note" cols="3" rows="3" class="form-control">{{$model->note}}</textarea>
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