@extends('layouts.app', ['title' => _lang('Attendees management')])
@section('page.header')
<div class="page-header page-header-light d-print-none">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Attendees</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
@stop
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300 d-print-none" >
		
		<h5 class="card-title">{{_lang('Attendees management')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>
	<div class="row d-print-none">
		<div class="col-sm-7 form-control m-2 ml-3">
			<div class="card-body">
				<fieldset class="mb-3" id="form_field">
					<p class="text-center text-info h5">Take Employe Attendees</p>
					<form action="{{route('admin.take.attendees')}}" method="post" id="content_form">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<label for="employe_id">Employe Name <span class="text-danger">*</span></label>
								<select data-url="{{route('admin.employe.present')}}" name="employe_id" id="employe_id" class="form-control select">
									<option value="0">Select One</option>
									@foreach($models as $data)
									<option value="{{$data->id}}">{{$data->employe_name}}</option>
									@endforeach
								</select>
							</div>

							<div class="col-md-6">
								<label for="employe_id_no">Employe ID No<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control" name="employe_id_no" id="employe_id_no">
							</div>
							
							<div class="col-md-6">
								<label for="shift_time">Shift Time<span class="text-danger">*</span></label>
								<input type="text" readonly="" class="form-control" name="shift_time" id="shift_time">
							</div>

							<div class="col-md-6">
								<label for="present_date">Present Date<span class="text-danger">*</span></label>
								<input type="date" name="present_date" id="present_date" class="form-control date">
							</div>

						</div>

						<div class="row">
							<div class="col-md-4">
								<div class="form-check form-check-switchery form-check-inline">
									<label class="form-check-label">
										
									</label>
								</div>
							</div>
						</div>
						<div class="text-right">
							@can('employeAttendees.create')
							<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Submit')}}<i class="icon-arrow-right14 position-right"></i></button>
							<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
							@endcan
						</div>
					</form>
					</fieldset id="form_field">
				</div>
			</div>
			
			<div class="col-sm-4 form-control m-2">
				<p class="text-info text-center h5">Attendees List</p>
				<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-check-label">To Date</label>
						<input type="date" class="form-control date" name="to_date" id="to_date">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label class="form-check-label">From Date</label>
						<input type="date" class="form-control date" name="form_date" id="form_date">
					</div> 
				</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="form-check-label">Employer Name</label>
						<select name="attendens_id" id="attendens_id" class="form-control select">
							<option value="">All Employer</option>
							@foreach($models as $emp_data)
								<option value="{{$emp_data->id}}">{{$emp_data->employe_name}}</option>
							@endforeach
						</select>
					</div> 
				</div>
				<div class="text-right">
					@can('employeAttendees.view')
					<button type="submit" id="atten_submit" class="btn btn-success">{{_lang('Submit')}}<i class="icon-arrow-right14 position-right"></i></button>
					<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
					@endcan
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="attendenstable"></div>
				</div>
			</div>
		</div>
		

</div>

<!-- /basic initialization -->
@stop
@push('scripts')
<!-- Theme JS files -->
<script>
	$(document).ready(function(){
		$(document).on("change","#employe_id", function(){
			var id = $(this).val();
			var url = $(this).data('url');
			$.ajax({
				url:url,
				type:'POST',
				data:{id:id},
				success:function(data){
					console.log(data);
					$("#employe_id_no").val(data.employe_id_no);
					$("#shift_time").val(data.shift.shift_time);
				}
			});
		});

		$(document).on('click','#atten_submit',function(){
			var to_date = $("#to_date").val();
			var form_date = $("#form_date").val();
			var attendens_id = $("#attendens_id").val();
			$.ajax({
				url:"{{route('admin.attendens.list')}}",
				data:{to_date:to_date, form_date:form_date,attendens_id:attendens_id},
				dataType:'html',
				type:'post',
				success:function(data){
					$("#attendenstable").html(data);
				}
			});
		});
	});
</script>
<script>
function printDiv() {
	window.print();
}
</script>

<script src="{{ asset('js/pages/user.js') }}"></script>
<script>
	$(document).ready(function(){
		_componentStatusSwitchery();
	});
</script>
<!-- /theme JS files -->
@endpush