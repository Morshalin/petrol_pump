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
    @foreach ($models as $item)
        <tr>
            <td>{{$item->productitem->product_name}}</td>
            <td>{{$item->companyinfo->company_name}}</td>
            <td>{{$item->vehicle_name}}</td>
            <td>{{$item->vehicle_number}}</td>
            <td>{{$item->oil_stack}}</td>
            <td>{{$item->oil_price}}</td>
            <td>{{$item->oil_total_price}}</td>
            <td>{{$item->stack_date}}</td>
        </tr>
    @endforeach
</table>
