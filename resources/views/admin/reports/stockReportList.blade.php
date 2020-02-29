<style>
    @media print {
    .table thead{
        background: blue;
    }
}
</style>
@push('admin.css')
    <link href="{{ asset('asset/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="print" />
@endpush
<div class="card">
    <div class="card-body">
        <div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h2 class="m-0">Product Stock Report</h2>
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
    <thead>
        <tr>
            @if ($product_id == 0)
                <th>Nmae</th>
            @endif
            <th>Company</th>
            <th>Vehicle Name</th>
            <th>V-Number</th>
            <th>Oil Price</th>
            <th>Stack Date</th>
            <th>Oil Stack</th>
            <th>Total Price</th>
        </tr>
    </thead>
    @foreach ($models as $stock_item)
        <tr>
           @if($product_id == 0)
                <td>{{$stock_item->item->product_name}}</td>
           @endif
            <td>{{$stock_item->transaction->company->company_name}}</td>
            <td>{{$stock_item->vehicle_name}}</td>
            <td>{{$stock_item->vehicle_no}}</td>
            <td>{{$stock_item->unit_price}}</td>
            <td>{{$stock_item->transaction->transactions_date}}</td>
            <td>{{$stock_item->quantity}}<span class="text-muted font-weight-bold"> Liter</span></td>
            <td>{{$stock_item->total}}<span class="text-muted font-weight-bold"> Tk</span></td>
        </tr>
    @endforeach
    <tr>
        @if ($product_id == 0)
            <td colspan="5"></td>
        @else
            <td colspan="4"></td>
        @endif
        <td class="font-weight-bold">Sub Total</td>
        <td class="font-weight-bold">{{$models->sum('quantity')}} <span class="text-muted font-weight-bold">Liter</span></td>
        <td class="font-weight-bold">{{$models->sum('total')}} <span class="text-muted font-weight-bold">Tk</span></td>
    </tr>
</table>
<button type="button" class="btn btn-sm btn-info mb-2 float-right printMe print-btn d-print-none" onclick='printDiv();'> <span class="icon-printer"> Print</span> </button>
    </div>
</div>
