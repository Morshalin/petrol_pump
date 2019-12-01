@extends('layouts.app', ['title' => _lang('Owner manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Owner manage')}}
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
    <fieldset class="mb-3" id="form_field">
    	<form action="{{route('admin.investment.store')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
			 <div class="col-sm-6 form-control mt-2 offset-3">
	     	<div class="col-md-12">
	     	  <div class="form-group">
	     	  	<label for="customer_name">Owner Name <span class="text-danger">*</span></label>
	     	  	<select data-placeholder="Select One" class="form-control select" name="investowner_id" id="investowner_id">
					   <option value="">Select One</option>
					   @foreach ($models as $item)
				   <option value="{{$item->id}}">{{$item->owner_name}}</option>
					   @endforeach
				   </select>
	          </div>
	     	</div>

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="amount">Invest Amount <span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="amount" id="amount">
	          </div>
	     	</div>


	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="invest_date">Invest Date</label>
	        	<input type="text" class="form-control date" name="invest_date" id="invest_date">
	          </div>
			 </div>
			 </div>
	     </div>


		<div class="text-right">
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Invest')}}<i class="icon-arrow-right14 position-right"></i></button>
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