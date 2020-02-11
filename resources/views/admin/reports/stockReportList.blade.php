<table class="table">
    <tr>
        <th>Nmae</th>
        <th>Company</th>
        <th>Vehicle Name</th>
        <th>V-Number</th>
        <th>Oil Stack</th>
        <th>Oil Price</th>
        <th>Total Price</th>
        <th>Stack Date</th>
    </tr>
    @foreach ($models as $stock_item)
        <tr>
            <td>{{$stock_item->item->product_name}}</td>
            <td>{{$stock_item->transaction->company->company_name}}</td>
            <td>{{$stock_item->vehicle_name}}</td>
            <td>{{$stock_item->vehicle_no}}</td>
            <td>{{$stock_item->quantity}}</td>
            <td>{{$stock_item->unit_price}}</td>
            <td>{{$stock_item->total}}</td>
            <td>{{$stock_item->transaction->transactions_date}}</td>
        </tr>
    @endforeach
</table>