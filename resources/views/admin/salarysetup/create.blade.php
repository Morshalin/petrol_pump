@extends('layouts.app', ['title' => _lang('Salary Setup manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Salary Setup manage')}}
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
    <form action="{{route('admin.salarysetup.store')}}" method="post" id="content_form">
		@csrf
	     <div class="row">
			 <div class="col-md-6">
	     	  <div class="form-group">
	     	  	<label for="employe_name">Employe Name <span class="text-danger">*</span></label>
				   <select data-placeholder="Select One" name="employe_name" id="employe_name" class="form-controller select">
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
				   <select data-placeholder="Select One" name="employe_id_no" id="employe_id_no" class="form-controller select">
					   <option value="">Select One</option>
					   @foreach ($employ_info as $data)
				   		<option value="{{$data->employe_id_no}}">{{$data->employe_id_no}}</option>
					   @endforeach
				   </select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="post_name">Employe Post <span class="text-danger">*</span></label>
	        	<select data-placeholder="Select One" name="post_name" id="post_name" class="form-control select">
	        		<option value="">Select One</option>
	        		@foreach($models as $data)
	        		<option value="{{$data->id}}">{{$data->post_name}}</option>
	        		@endforeach
	        	</select>
	          </div>
	     	</div>

	     	<div class="col-md-6">
	     	  <div class="form-group">
	        	<label for="employe_sallary">Employe Sallary<span class="text-danger">*</span></label>
	        	<input type="text" class="form-control" name="employe_sallary" id="employe_sallary">
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
	    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create User')}}<i class="icon-arrow-right14 position-right"></i></button>
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

<!-- Custom Js for employer salary -->

<script>
	$(document).ready(function(){
		$(document).on('change','#employe_name', function(){
			var employer_name = $(this).val();
			$.ajax({
				url:'app/controlloer/admin/SalarySetupController.php'
				type:'text',
				dataType:'get',
				data:{employer_name:employer_name},
				success:function(data){
					console.log(data);
				}
			});
		});
	});
</script>
<!-- /Custom Js for employer salary -->

@endpush