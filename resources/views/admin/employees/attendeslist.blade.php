<table class="table">
    <tr>
        <th>Nmae</th>
        <th>ID NO</th>
        <th>Number</th>
        <th>Present Date</th>
        <th>Attendes</th>
    </tr>
    @foreach ($models as $item)
        <tr>
            <td>{{$item->employee->employe_name}}</td>
            <td>{{$item->employe_id_no}}</td>
            <td>{{$item->employee->employe_number}}</td>
             <td>
                 @if ($item->present_date)
                    <span class="">{{$item->present_date}}</span>  
                @else
                   <span class="">{{$item->start_date}}</span> <strong> TO </strong>
                    <span class="">{{$item->end_date}}</span>
                @endif
            </td>
            <td>
                @if ($item->present_date)
                    <span class="badge badge-success">Present</span>  
                @else
                   <span class="badge badge-danger">Absent</span>   
                @endif
            </td> 
        </tr>
    @endforeach
</table>
