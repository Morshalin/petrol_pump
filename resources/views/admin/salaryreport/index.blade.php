@extends('layouts.app', ['title' => _lang('Attendees management')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300  d-print-none" >
		<h5 class="card-title">{{_lang('Salary Report')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>

	<div class="container  d-print-none mt-2">
		<div class="row">
			<div class="col-sm-4 form-control offset-4 mb-3">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="form-check-label">To Date</label>
						<input type="text" class="form-control month" name="to_date" id="to_date" placeholder="Select Month" readonly autocomplete="off">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="form-check-label">From Date</label>
						<input type="text" class="form-control month" name="form_date" id="form_date" placeholder="Select Month" readonly autocomplete="off">
					</div> 
				</div>
				<div class="col-sm-12">
					<button class="btn btn-success btn-sm" id="submit">Submit</button>
				</div>
			</div>
		</div>
	</div>
	<div class="container" id="outprint">
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
				type:'get',
				data:{id:id},
				success:function(data){
					console.log(data);
					$("#employe_id_no").val(data.employe_id_no);
					$("#shift_time").val(data.shift.shift_time);
				}
			});
		});

		$(document).on('click','#submit',function(){
			var to_date = $("#to_date").val();
			var form_date = $("#form_date").val();
			var salary_report = $('#salary_report').val();
			$.ajax({
				url:"{{route('admin.repostlist')}}",
				data:{to_date:to_date, form_date:form_date, salary_report:salary_report},
				dataType:'html',
				type:'get',
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