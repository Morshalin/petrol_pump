@extends('layouts.app', ['title' => _lang('Employer manage')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Employer manage')}}
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
		<div class="col-sm-6 offset-3 p-3">
			<div class="card-body form-control">
				<fieldset class="mb-3" id="form_field">
					<form action="{{route('admin.absence.update', $model->id)}}" method="post" id="content_form">
						@csrf
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="start_date">Start Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date" name="start_date" id="start_date" value="{{$model->start_date}}">
								</div>
                            </div>
                            
                            <div class="col-md-12">
								<div class="form-group">
									<label for="end_date">End Date<span class="text-danger">*</span></label>
                                <input type="text" class="form-control date" name="end_date" id="end_date" value="{{$model->end_date}}">
								</div>
							</div>

						</div>

						<div class="row" style="display:none">
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