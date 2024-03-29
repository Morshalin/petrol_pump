@extends('layouts.app', ['title' => 'Setting', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> {{_lang('Home')}}</span>
                 <span class="breadcrumb-item active"><i class="icon-cog mr-2"></i> {{_lang('Setting')}}</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
   <div class="row">
   			<div class="col-md-12">
				<div class="card">
					<div class="card-header header-elements-inline">
						<h6 class="card-title">{{_lang('System Configuration')}}</h6>
						<div class="header-elements">
							<div class="list-icons">
		                		<a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a>
		                	</div>
	                	</div>
					</div>

					<div class="card-body">
						<ul class="nav nav-tabs nav-tabs-solid nav-justified bg-light">
							<li class="nav-item"><a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">{{_lang('General')}}</a></li>
							<li class="nav-item"><a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">{{_lang('Logo')}}</a></li>
						</ul>

						<div class="tab-content">
							<div class="tab-pane fade show active" id="solid-bordered-justified-tab1">
							{!! Form::open(['route' => 'admin.configuration', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
							<fieldset class="mb-3" id="form_field">
							<div class="row">
							<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('company_name', _lang('Company Name') , ['class' => 'col-form-label ']) }}
								{{ Form::text('company_name', get_option('company_name'), ['class' => 'form-control', 'placeholder' => _lang('Company Name')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('site_title', _lang('Title') , ['class' => 'col-form-label ']) }}
								{{ Form::text('site_title', get_option('site_title'), ['class' => 'form-control', 'placeholder' => _lang('Title')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('email', _lang('Email') , ['class' => 'col-form-label ']) }}
								{{ Form::text('email', get_option('email'), ['class' => 'form-control', 'placeholder' => _lang('Email')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label(_lang('phone'), 'Phone' , ['class' => 'col-form-label ']) }}
								{{ Form::text('phone',get_option('phone'), ['class' => 'form-control', 'placeholder' => _lang('Phone')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('alt_phone', _lang('Alernative Phone') , ['class' => 'col-form-label ']) }}
								{{ Form::text('alt_phone', get_option('alt_phone'), ['class' => 'form-control', 'placeholder' => _lang('Alernative Phone')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('start_date', _lang('Starting date') , ['class' => 'col-form-label ']) }}
								{{ Form::text('start_date', get_option('start_date'), ['class' => 'form-control pickadate-accessibility', 'placeholder' => _lang('Starting date')]) }}
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('currency', _lang('Currency') , ['class' => 'col-form-label']) }}
								<select name="currency" class="form-control select">
								@foreach (curency() as $key=> $element)
								<option {{get_option('currency')?get_option('currency') ==$key:''? 'selected' : ''}} value="{{$key}}">{!!$element!!}({{$key}})</option>
								@endforeach
								</select>
							</div>
						   </div>

						   <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('timezone', _lang('TimeZone') , ['class' => 'col-form-label ']) }}
								<select name="timezone" class="form-control select">
								@foreach (tz_list() as $key=> $time)
								<option  value="{{$time['zone']}}">{{ $time['diff_from_GMT'] . ' - ' . $time['zone']}}</option>
								@endforeach
								</select>
							</div>
						   </div>

						   </div>
						   <div class="row">
						   	<div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('language', _lang('Language') , ['class' => 'col-form-label ']) }}
								<select name="language" class="form-control select">
								{!! load_language( get_option('language') ) !!}
								</select>
							</div>
						   </div>

						    <div class="col-lg-6">
							<div class="form-group">
								{{ Form::label('land_mark', _lang('Land Mark') , ['class' => 'col-form-label']) }}
								{{ Form::text('land_mark', get_option('land_mark'), ['class' => 'form-control', 'placeholder' => 'Land Mark']) }}
							</div>
						   </div>

						   	<div class="col-lg-12">
							<div class="form-group">
								{{ Form::label('address', _lang('Address') , ['class' => 'col-form-label']) }}
								{{ Form::textarea('address', get_option('address'), ['class' => 'form-control', 'rows'=>3]) }}
							</div>
						   </div>
						   </div>

						    <div class="text-right">
		                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update Setting')}}<i class="icon-arrow-right14 position-right"></i></button>
		                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">Processing <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		                    </div>

							</fieldset>


							{!!Form::close()!!}
							</div>

							<div class="tab-pane fade" id="solid-bordered-justified-tab2">
							{!! Form::open(['route' => 'admin.logo', 'class' => 'ajax_submit','files' => true, 'method' => 'POST']) !!}
							 <fieldset class="mb-3" id="form_field">
								<div class="row">
								  
								<div class="col-md-6">
								<div class="form-group">
								{{ Form::label('logo', _lang('Logo') , ['class' => 'col-form-label']) }}
								  <input type="file" name="logo">
								   @if(get_option('logo'))
                                    <input type="hidden" name="oldLogo" value="{{get_option('logo')}}">
                                  @endif
								   
							     </div>
								 </div>

							     <div class="col-md-6">
									<div class="form-group">
									{{ Form::label('favicon', _lang('Favicon') , ['class' => 'col-form-label']) }}
									  <input type="file" name="favicon">
								   @if(get_option('favicon'))
                                    <input type="hidden" name="oldfavicon" value="{{get_option('favicon')}}">
                                   @endif
							        </div>
								  </div>
								</div>
						    <div class="text-right">
		                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update Setting')}}<i class="icon-arrow-right14 position-right"></i></button>
		                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">Processing <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>

		                    </div>
							</fieldset>	
							{!!Form::close()!!}
							</div>


						</div>
					</div>
				</div>
			</div>
    </div>
<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/setting.js') }}"></script>
<!-- /theme JS files -->
@endpush