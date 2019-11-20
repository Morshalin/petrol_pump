@extends('layouts.app', ['title' => _lang('Adsence manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Adsence manage')}}
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
    	<form action="{{route('admin.adsence.insertAdsence')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
	     	<input type="hidden" class="form-control" value="{{$model->id}}" name="employe_id" id="employe_id">

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_id_no">Employe ID NO. <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="{{$model->employe_id_no}}" name="employe_id_no" id="employe_id_no" readonly="">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="shift_time">Shift Time<span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="{{$model->shift->shift_time}}" name="shift_time" id="shift_time" readonly="">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="resion">Absence Reason <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" name="resion" id="resion">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="start_date">Absence Start Date <span class="text-danger">*</span></label>
	     	  	<input type="date" class="form-control date" name="start_date" id="start_date">
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="end_date">Absence End Date <span class="text-danger">*</span></label>
	     	  	<input type="date" class="form-control date" name="end_date" id="end_date">
	          </div>
	     	</div>



	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="description">Absence Description</label>
	        	<textarea name="description" id="description" cols="3" rows="2" class="form-control"></textarea>
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