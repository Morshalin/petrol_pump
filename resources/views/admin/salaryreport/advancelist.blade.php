<table class="table">
    <tr>
        <th>Employer Nmae</th>
        <th>ID NO</th>
        <th>Post</th>
        <th>salary</th>
        <th>Advance</th>
        <th>Month</th>
        <th>Pay Date</th>
    </tr>
    @foreach ($models as $item)
        <tr>
            <td>{{$item->employe->employe_name}}</td>
            <td>{{$item->employe_id_no}}</td>
            <td>{{$item->post_name}}</td>
            <td>{{$item->employe_sallary}} <span class="text-muted font-weight-bold">Taka</span></td>
            <td>{{$item->advance_pay}} <span class="text-muted font-weight-bold">Taka</span></td>
            <td>{{$item->advance_date}}</td>
            <td>{{$item->pay_date}}</td>
        </tr>
    @endforeach
</table>
