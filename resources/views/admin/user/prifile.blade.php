@extends('layouts.app', ['title' => _lang('User Profile')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Profile manage')}}
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
		<div class="col-sm-12">
			<div class="card-body form-control">
				<fieldset class="mb-3" id="form_field">
					@if (isset($models))
						<form action="{{route('admin.change.profile', $models->id)}}" method="post" id="content_form">
					@else
						<form action="{{route('admin.create.profile')}}" method="post" id="content_form">
					@endif
						@csrf
						<div class="row">
                            <div class="col-md-6">
								<div class="form-group">
									<label for="first_name">First Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control" value="{{ isset($models)?$models->first_name:'' }}" name="first_name" id="first_name">
								</div>
                            </div>
                            <input type="hidden" name="user_id" value="{{$user_id}}">
                            <div class="col-md-6">
								<div class="form-group">
									<label for="last_name">Last Name <span class="text-danger">*</span></label>
									<input type="text" class="form-control" value="{{ isset($models)?$models->last_name:'' }}" name="last_name" id="last_name">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="contact_number">Contact Number</label>
									<input type="text" class="form-control" value="{{ isset($models)?$models->contact_number:'' }}" name="contact_number" id="contact_number">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" value="{{ isset($models)?$models->email:'' }}" name="email" id="email">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="photo">Photo</label>
									<input type="file" class="form-control" name="photo" id="photo">
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