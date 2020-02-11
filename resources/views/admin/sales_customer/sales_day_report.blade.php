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
    @foreach ($models as $item)
        <tr> 
            <td>{{$item->customer_name}}</td>
            <td>{{$item->productitem->product_name}}</td>
            <td>{{$item->vehicle_name}}</td>
            <td>{{$item->vehicle_number}}</td>
            <td>{{$item->oil_sale}}</td>
            <td>{{$item->oil_price}}</td>
            <td>{{$item->oil_total_price}}</td>
            <td>{{$item->sale_date}}</td>
        </tr>
    @endforeach
</table>
