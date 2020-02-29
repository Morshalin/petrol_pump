@extends('layouts.app', ['title' => _lang('Company Purchase Report')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300 d-print-none" >
		<h5 class="card-title">{{_lang('Company Purchase Report')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>

    <div class="container d-print-none">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center text-info h4">Company Purchase Report</p>
            </div>
            <div class="col-sm-8 form-control offset-2 mb-3">
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
                <div class="row">
                

                <div class="col-sm-6">
                    <div class="form-group">
						<label for="product_id" class="form-check-label">Product Name</label>
						<select name="product_id" id="product_id" class="form-control select">
							<option value="0">All Product</option>
							@foreach ($product as $pro_item)
								<option value="{{$pro_item->id}}">{{$pro_item->product_name}}</option>
							@endforeach
						</select>
                    </div> 
                </div>

				<div class="col-sm-6">
                    <div class="form-group">
						<label for="company_id" class="form-check-label">Company Name</label>
						<select name="company_id" id="company_id" class="form-control select">
							<option value="">All Company</option>
							@foreach ($models as $item)
								<option value="{{$item->id}}">{{$item->company_name}}</option>
							@endforeach
						</select>
                    </div> 
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
		$(document).on('click','#submit',function(){
			var to_date = $("#to_date").val();
			var form_date = $("#form_date").val();
			var company_id = $("#company_id").val();
			var product_id = $("#product_id").val();
			$.ajax({
				url:"{{route('admin.comapanyReport.result')}}",
				data:{to_date:to_date, form_date:form_date,company_id:company_id,product_id:product_id},
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