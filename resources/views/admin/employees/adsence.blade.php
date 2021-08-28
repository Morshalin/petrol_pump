@extends('layouts.app', ['title' => _lang('Adsence manage')])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Absence</span>
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
		<a href="{{route('admin.employees.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
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
    <fieldset class="mb-3" id="form_field">
    	<form action="{{route('admin.adsence.insertAdsence')}}" method="post" id="content_form">
		@csrf
		@if (is_countable($model) && count($model) > 1)
			<div class="row">
			<input type="hidden">
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_id">Employe Name<span class="text-danger">*</span></label>
				   <select name="employe_id" id="employe_id" class="form-control select">
					   <option value="0">Select One</option>
					@foreach ($model as $item)
					   <option value="{{$item->employe_id}}">{{$item->employe_name}}</option>
				   	@endforeach
				   </select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_id_no">Employe ID NO. <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="" name="employe_id_no" id="employe_id_no" readonly="">
	          </div>
	     	</div>

			
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="shift_time">Shift Time<span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="" name="shift_time" id="shift_time" readonly="">
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

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="description">Description</label>
	        	<textarea name="description" id="description" cols="3" rows="2" class="form-control"></textarea>
	          </div>
	     	</div>

	     </div>
		@elseif(isset($model) && !empty($model))
		 @foreach ($model as $model)
			 
			<div class="row">
	     	<div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_id">Employe Name. <span class="text-danger">*</span></label>
	     	  	<input type="text" class="form-control" value="{{$model->employe_name}}" name="employe_id" id="employe_id" readonly="">
	          </div>
	     	</div>

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

	     	<div class="col-md-12">
	     	  <div class="form-group">
	        	<label for="description">Description</label>
	        	<textarea name="description" id="description" cols="3" rows="2" class="form-control"></textarea>
	          </div>
	     	</div>

	     </div>
		 @endforeach
		@endif
	     

	     <div class="row" style="display:none">
	     	<div class="col-md-4">
	     		<div class="form-check form-check-switchery form-check-inline">
					<label class="form-check-label">Status
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