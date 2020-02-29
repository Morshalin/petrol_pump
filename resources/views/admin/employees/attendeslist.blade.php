<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h2 class="m-0">Employe Attendees List</h2>
            <p class="m-0"> {{ get_option('company_name') }}, {{  get_option('phone')}}</p>
            <p class="m-0">Report Date: {{$to_date}} <span class="bg-danger p-1 rounded-circle">TO</span> {{$form_date}}</p>
            @if ($attendens_id != 0)
            <p class="m-0">Employe Name: {{$models[0]->employee->employe_name}}</p>
            <p class="m-0">Employe ID: {{$models[0]->employee->employe_id_no}}</p>
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
        <th>#</th>
        @if ($attendens_id == null)
             <th>Nmae</th>
        @endif
        @if ($attendens_id == null)
             <th>ID NO</th>
        @endif
        <th>Number </th>
        <th>Present Date</th>
        <th>Attendes</th>
    </tr>
    @if (isset($models) && !empty($models))
    @foreach ($models as $key => $item)
        <tr>
            <td>{{ $key+1 }}</td>
            @if ($attendens_id == null)
                <td>{{$item->employee->employe_name}}</td>
            @endif
            @if ($attendens_id == null)
                <td>{{$item->employe_id_no}}</td>
            @endif
           
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
    @endif
</table>
<button type="button" class="btn btn-sm btn-info mb-2 float-right printMe d-print-none" onclick='printDiv();'> <span class="icon-printer"> Print</span> </button>
    </div>
</div>
