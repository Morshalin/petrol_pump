@extends('layouts.app', ['title' => _lang('Month Report')])

@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300 d-print-none" >
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

	<div class="container d-print-none mt-2">
		<div class="row">
			<div class="col-sm-4 form-control offset-4 mb-3">
				<div class="col-sm-12">
					<div class="form-group">
						<label class="form-check-label">Select Month</label>
						<input type="text" class="form-control month" name="select_month" id="select_month" placeholder="Select Month" readonly autocomplete="off">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label class="form-check-label">Select Product</label>
						<select name="product_id" data-placeholder="Select One" id="product_id" class="form-control select">
							<option value="">Select One</option>
							@foreach ($product as $item)
								<option value="{{$item->id}}">{{$item->product_name}}</option>
							@endforeach
						</select>
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
window.onscroll = function() {myFunction()};
var header = document.getElementById("myHeader");
var sticky = header.offsetTop;
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>
<script>
	$(document).ready(function(){

		$(document).on('click','#submit',function(){
			var select_month = $("#select_month").val();
			var product_id = $("#product_id").val();
			$.ajax({
				url:"{{route('admin.daybydayreportlist')}}",
				data:{select_month:select_month,product_id:product_id},
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