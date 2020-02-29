@extends('layouts.app', ['title' => _lang('Post manage')])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Post</span>
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
		<a href="{{route('admin.post.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Post manage')}}
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
		<div class="col-sm-6 offset-3">
			<div class="card-body form-control m-2">
				<fieldset class="mb-3" id="form_field">
					<form action="{{route('admin.post.store')}}" method="post" id="content_form">
					@csrf
					<div class="row">
						<div class="col-md-12">
						<div class="form-group">
							<label for="post_name">Post Name <span class="text-danger">*</span></label>
							<input type="text" class="form-control" name="post_name" id="post_name">
						</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="form-check form-check-switchery form-check-inline">
								<label class="form-check-label">Status
									<input type="checkbox" name="status" value="1" id="status" class="form-check-status-switchery" checked data-fouc>
									Status
								</label>
							</div>
						</div>
					</div>
					<div class="text-right">
					<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Add Post')}}<i class="icon-arrow-right14 position-right"></i></button>
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