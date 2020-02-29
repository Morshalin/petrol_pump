<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h2 class="m-0">Sale Stock Report</h2>
            <p class="m-0"> {{ get_option('company_name') }}, {{  get_option('phone')}}</p>
            <p class="m-0">Report Date: {{$to_date}} <span class="bg-danger p-1 rounded-circle">TO</span> {{$form_date}}</p>
            @if ($product_id != 0)
            <p class="m-0">P.Name: {{$models[0]->item->product_name}}</p>
        @endif

        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="text-right">
            @php
                date_default_timezone_set("Asia/Dhaka");
            @endphp
            <p class="m-0">Printing Date: {{date('d M Y')}}</p>
            <p class="m-0">Time : {{date("h:i:sa")}}</p>
        </div>
    </div>
</div>
<table class="table">
    <tr>
        @if ($product_id == 0)
            <th>P.Nmae</th>
        @endif
        <th>Cus.Nmae</th>
        <th>Vehicle Name</th>
        <th>Present Stock</th>
        <th>Oil Price</th>
        <th>Sale Date</th>
        <th>Oil Sale</th>
        <th>Total Price</th>
    </tr>
    @foreach ($models as $sale_item)
        <tr> 
            @if($product_id == 0)
                <td>{{$sale_item->item->product_name}}</td>
            @endif
            <td>{{$sale_item->transaction->customer?$sale_item->transaction->customer->customer_name:'Walk-In Customer'}}</td>
            <td>{{$sale_item->vehicle_name}}</td>
            <td>{{$sale_item->vehicle_no}}</td>
            <td>{{$sale_item->unit_price}}</td>
            <td>{{$sale_item->transaction->transactions_date}}</td>
            <td>{{$sale_item->quantity}}</td>
            <td>{{$sale_item->total}}</td>
        </tr>
    @endforeach
        <hr>
        <tr>
            @if ($product_id == 0)
            <td colspan="5"></td>
        @else
            <td colspan="4"></td>
        @endif
            <td class="font-weight-bold">Sub Total</td>
            <td class="font-weight-bold">{{$models->sum('quantity')}}</td>
            <td class="font-weight-bold">{{$models->sum('total')}}</td>
        </tr>
</table>
<button type="button" class="btn btn-sm btn-info mb-2 float-right printMe print-btn d-print-none" onclick='printDiv();'> <span class="icon-printer"> Print</span> </button>
    </div>
</div>