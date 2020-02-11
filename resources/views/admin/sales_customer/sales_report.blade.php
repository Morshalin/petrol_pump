<table class="table">
    <tr>
        <th>Nmae</th>
        <th>Product Name</th>
        <th>Vehicle Name</th>
        <th>Present Stock</th>
        <th>Oil Sale</th>
        <th>Oil Price</th>
        <th>Total Price</th>
        <th>Sale Date</th>
    </tr>
    @foreach ($models as $sale_item)
        <tr> 
            <td>{{$sale_item->transaction->customer->customer_name}}</td>
            <td>{{$sale_item->item->product_name}}</td>
            <td>{{$sale_item->vehicle_name}}</td>
            <td>{{$sale_item->vehicle_no}}</td>
            <td>{{$sale_item->quantity}}</td>
            <td>{{$sale_item->unit_price}}</td>
            <td>{{$sale_item->total}}</td>
            <td>{{$sale_item->transaction->transactions_date}}</td>
        </tr>
    @endforeach
</table>
