@extends('layouts.app', ['title' => _lang('Profit Or Loss Report')])
@section('content')
<!-- Basic initialization -->
<div class="card border-top-success rounded-top-0" id="table_card">
	<div class="card-header header-elements-inline bg-light border-grey-300" >
		<h5 class="card-title">{{_lang('Profit Or Loss Report')}}
		</h5>
		<div class="header-elements">
			<div class="list-icons">
				<a class="list-icons-item" data-action="fullscreen" title="{{ _lang('fullscreen') }}" data-popup="tooltip" data-placement="bottom"></a>
				<a class="list-icons-item" data-action id="reload" title="{{ _lang('reload') }}" data-popup="tooltip" data-placement="bottom"><i class="icon-reload-alt"></i></a>
				<a class="list-icons-item" data-action="collapse" title="{{ _lang('collapse') }}" data-popup="tooltip" data-placement="bottom"></a>
			</div>
		</div>
	</div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <p class="text-center text-info h4">Profit Or Loss Report</p>
            </div>
            <div class="col-sm-12 form-control mb-3">
                <div class="row">
                    <div class="col-sm-5 m-auto">
                        <table class="table table-sm table-striped">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Purchase Sub-total : ')}}</td>
                                    <td>{{$purchase->sum('sub_total')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Total Sale Discount: ')}}</td>
                                    <td>{{$sale->sum('discount')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Purchase Net Total: ')}}</td>
                                     <td>{{$purchase->sum('net_total')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Total Expense : ')}}</td>
                                     <td>{{$expence}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-5 m-auto">
                        <table class="table table-sm table-striped">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Sales Sub-total: ')}}</td>
                                    <td>{{$sale->sum('sub_total')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Total Purchase Discount: ')}}</td>
                                    <td>{{$purchase->sum('discount')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Sales Net Total: ')}}</td>
                                     <td>{{$sale->sum('net_total')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{_lang('Total Income : ')}}</td>
                                     <td>{{$income}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 mt-5 ml-2">
						<div class="card card-body bg-success-400 has-bg-image">
							<div class="media">
								<div class="media-body">
									<h3 class="mb-0">{{$sale->sum('net_total') - $purchase->sum('net_total')}} <small class="text-muted font-weight-bold">{{get_option('currency')}}</small></h3>
									<span class="text-uppercase font-size-xs">Total Profite</span>
								</div>

								<div class="ml-3 align-self-center">
									<i class="icon-bag icon-3x opacity-75"></i>
								</div>
                            </div>
						</div>
                    </div>
                </div>
                
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
		$(document).on('click','#submit',function(){
			var to_date = $("#to_date").val();
			var form_date = $("#form_date").val();
			var customer_id = $("#customer_id").val();
			var product_id = $("#product_id").val();
			$.ajax({
				url:"{{route('admin.cutomerReport.result')}}",
				data:{to_date:to_date, form_date:form_date,customer_id:customer_id,product_id:product_id},
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
  var divToPrint=document.getElementById('outprint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);

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