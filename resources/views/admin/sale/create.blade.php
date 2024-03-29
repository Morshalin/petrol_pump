@extends('layouts.app', ['title' => _lang('Product Sale'), 'modal' => true])
@section('page.header')
<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i>Sale Management</span>
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
        <a href="{{route('admin.sale.index')}}" class="btn btn-info btn-sm" ><i class="icon-arrow-left7"></i> Back</a>
		<h5 class="card-title">{{_lang('Products Sale')}}
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
		<form action="{{route('admin.sale.store')}}" method="post" id="content_form">
			@csrf
			<div id="pay_option">
				<div class="row">
                    <input type="hidden" value="0"  id="row" >
                    <input type="hidden" value="{{$user_id}}"  id="user_id" name="user_id">
                    <div class="col-md-4">
						<div class="form-group">
							<label for="customer_id">{{_lang('Customer Name')}}<span class="text-danger">*</span> <a href="{{route('admin.customer.create')}}"> <span class="badge badge-success">Add Customer</span> </a> </label>
							<select name="customer_id" id="customer_id" class="form-control select">
                                <option value="">Walk-In Customer</option>
								@foreach($customer as $data)
								<option value="{{$data->id}}">{{$data->customer_name}}</option>
								@endforeach
							</select>
						</div>
                    </div>
                    <div class="col-md-4">
						<div class="form-group">
							<label for="transactions_date">{{_lang('Transactions Date')}}<span class="text-danger">*</span></label>
							<input type="text" class="form-control date" name="transactions_date" id="transactions_date">
						</div>
                    </div>
                    <div class="col-md-4">
						<div class="form-group">
							<label for="invoice_no">{{_lang('Invoice Number')}}<span class="text-danger">*</span></label>
							<input type="text" value="{{$invoice_no}}" class="form-control" name="invoice_no" id="invoice_no">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="product_item_id">{{_lang('Product Name ')}}<span class="text-danger">*</span><a href="{{route('admin.items.create')}}"><span class="badge badge-success">Add Product</span></a></label>
							<select name="" id="product_item_id" class="form-control select">
								<option value="0">Select One</option>
								@foreach($models as $data)
								<option value="{{$data->id}}">{{$data->product_name}}</option>
								@endforeach
							</select>
						</div>
					</div>
                </div>
                 <hr>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <td>{{_lang('Product Name')}}</td>
                                <td>{{_lang('Vehicle No')}}</td>
                                <td>{{_lang('Vehicle Name')}}</td>
                                <td>{{_lang('Qty')}}</td>
                                <td>{{_lang('price')}}</td>
                                <td>{{_lang('Total')}}</td>
                                <td>{{_lang('Action')}}</td>
                                </tr>
                            </thead>
                            <tbody id="item"></tbody>
                        </table>
                    </div>
                </div>
               
                <hr>
                 <div class="form-control">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Account Section</h3>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="sub_total">{{_lang('Sub Total')}}</label>
                                <input type="text" readonly class="form-control"  id="sub_total" name="sub_total">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount_type">{{_lang('Discount Type')}}</label>
                                <select name="discount_type" id="discount_type" class="form-control select">
                                    <option value="" selected="selected">None</option>
                                    <option value="fixed">Fixed</option>
                                    {{-- <option value="percentage">Percentage</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount_amount">{{_lang('Discount Amount')}}</label>
                                <input type="text" disabled="disabled" class="form-control"  id="discount_amount" name="discount_amount">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="discount">{{_lang('Discount')}}</label>
                                <input type="text" readonly class="form-control"  id="discount" name="discount">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="net_total">{{_lang('Net Total')}}</label>
                                <input readonly type="text" class="form-control"  id="net_total" name="net_total">
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pay_type">{{_lang('Payment Type')}}</label>
                                <select data-placeholder="Select One" name="pay_type" id="pay_type" class="form-control select">
                                    <option value="">Select One</option>
                                    <option value="paid">Paid</option>
                                    <option value="due">Due</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pay_method">{{_lang('Payment Method')}} <span class="ml-1"> <button type="button" class="btn btn-info btn-sm" style="padding: 1px 8px" data-url="{{route('admin.paymethod.create')}}" id="content_managment"><i class="icon-plus-circle2"></i></button> </span></label>
                                <select data-placeholder="Select One" name="pay_method" id="pay_method" class="form-control select">
                                    <option value="">Select One</option>
                                    @foreach ($pay_method as $pay_method_item)
                                     <option value="{{$pay_method_item->payMethodName}}">{{$pay_method_item->payMethodName}}</option>   
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="TrxID">{{_lang('TrxID')}}</label>
                                <input type="text" class="form-control"  id="TrxID" name="TrxID"> 
                            </div>
                        </div>


                        <input type="hidden" name="transaction_status" value="sale" >
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="paid">{{_lang('Paid Amount')}}</label>
                                <input type="number" min="0" class="form-control"  id="paid" name="paid">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="due">{{_lang('Due Amount')}}</label>
                                <input readonly type="text" class="form-control"  id="due" name="due">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="additional_notes">Additional Notes</label>
                            <div class="form-group">
                                <textarea class="form-control" name="additional_notes" id="additional_notes" cols="2" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
					<div class="col-md-4">
						<div class="form-check form-check-switchery form-check-inline">
							<label class="form-check-label">
								<input type="checkbox" name="status" id="status" class="form-check-status-switchery" checked data-fouc>
							</label>
						</div>
					</div>
				</div>

				<div class="text-right">
					<button type="submit" class="btn btn-primary"  id="submit">{{_lang('Sale Product ')}}<i class="icon-arrow-right14 position-right"></i></button>
					<button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
				</div>
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
<script src="{{ asset('js/sweetalert.js') }}"></script>
<script>
	$(document).ready(function(){
		_componentStatusSwitchery();
	});
</script>

<script>
    $(document).ready(function(){
        
    $(document).on('change','#product_item_id',function(){
        var product_id = $(this).val();
        var quantity =1;
        $.ajax({
            url:"{{route('admin.sale.item')}}",
            method:'get',
            dataType:'json',
            data:{product_id:product_id},
            success:function(data){
                item(data,product_id,quantity);
            }
        });
    });

function item(item, product,quantity) {
    var tr = $("#item").parent().parent();
    var a = tr.find('.code');
    if (a.length == 0) {
        var row = parseInt($("#row").val());
        $.ajax({
            type: 'GET',
            url:  "/admin/sales/sale/append",
            data: {
                product: product,
                row: row,
                quantity: quantity,
            },
            dateType: 'html',
            success: function(data) {
                $("#item").append(data);
                $('#row').val(row + 1);
                calculation();

            }

        });
    } else {
        var found = true;
        $(".code").each(function() {
            if ($(this).val() == item.id) {
                console.log($(this).val());
                var id = $(this).data('id');
                var qty = parseFloat($('#qty_' + id).val());
                parseFloat($('#qty_' + id).val(qty + quantity));
                var nwqty = parseFloat($('#qty_' + id).val());
                var amt = nwqty * parseFloat(item.cost_price);
                $("#amt_" + id).html(amt);
                  calculation();
   
                found = false;
                return false;
                
            }
        })
        if (found) {
            var row = parseInt($("#row").val());
            $.ajax({
                type: 'GET',
                url:  "/admin/sales/sale/append",
                data: {
                    product: product,
                    row: row,
                    quantity: quantity,
                },
                dateType: 'html',
                success: function(data) {
                    $("#item").append(data);
                    $('#row').val(row + 1);
                    calculation()

                }

            });
        }
    }
}

$("#item").on('click', '.remove', function() {
    $(this).closest('tr').remove();
    calculation();
    $("#discount_amount").val("");
    $("#discount").val("");
    $("#paid").val("");
});
$("#item").on('keyup change', '.qty,.price', function() {
var tr = $(this).parent().parent();
var qty =tr.find('.qty').val();
var price= tr.find('.price').val();
var total =qty*price;
tr.find('.amt').html(total);
tr.find('.total').val(total);
 calculation()
});


function calculation() {
    var sub_total = 0;
    $('.amt').each(function(){
        sub_total = sub_total+($(this).html()*1);
    });

    $('#sub_total').val(sub_total);
    $('#net_total').val(sub_total);
    $('#due').val(sub_total);

    $(document).on('change','#discount_type',function(){
    var discount_type = $(this).val();
    var discount_amount = $('#discount_amount').val();
    var sub_total = $('#sub_total').val();
    if (discount_type == 'fixed') {
        $("#discount_amount").prop('disabled', false);
        var discount = sub_total-discount_amount;
        $("#discount").val(discount_amount);
        $('#net_total').val(discount);
        $('#due').val(discount);
    }else if(discount_type == 'percentage'){
        $("#discount_amount").prop('disabled', false);
        var discount = (sub_total*discount_amount)/100;
        var total = sub_total - discount;
        $("#discount").val(discount);
        $('#net_total').val(total);
        $('#due').val(total);
    }else{
        $("#discount").val('');
        $("#discount_amount").val('');
        $("#discount_amount").prop('disabled', true);
        $('#net_total').val(sub_total);
        $('#due').val(sub_total);
        prop('disabled', true);
    }
});

$(document).on('keyup change','#discount_amount',function(){
    var discount_type = $('#discount_type').val();
    var discount_amount = $(this).val();
    var sub_total = $('#sub_total').val();

    if (discount_type == 'fixed') {
        var discount = sub_total-discount_amount;
        $("#discount").val(discount_amount);
        $('#net_total').val(discount);
        $('#due').val(discount);
    }else{
        var discount = (sub_total*discount_amount)/100;
        var total = sub_total - discount;
        $("#discount").val(discount);

        $('#net_total').val(total);
        $('#due').val(total);
    }
});

$(document).on('keyup change','#paid',function(){
    var paid = parseFloat($(this).val());
    var net_total = parseFloat($("#net_total").val());
    var amount = net_total - paid;
    if(paid > net_total){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong! Paid Amount must be less than or equail net total.',
        })
    }else{
        $("#due").val(checkValue(amount));
    }
});

};
}); 

function checkValue(s){
    if (isNaN(s) || !s ) {
        return 0;
    }
    return s;
 }
</script>
<!-- /theme JS files -->
@endpush