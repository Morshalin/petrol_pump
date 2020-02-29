<div class="card">
    <div class="card-body">
<div class="row">
    <div class="col-sm-12">
        <div class="text-center">
            <h2 class="m-0">Employee Salary Report</h2>
            <p class="m-0"> {{ get_option('company_name') }}, {{  get_option('phone')}}</p>
            <p class="m-0"> {{ get_option('email') }}</p>
            <p class="m-0"> {{ get_option('address') }}</p>
            <p class="m-0">Report Date: {{$to_date}} <span class="bg-danger p-1 rounded-circle">TO</span> {{$form_date}}</p>
            

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
        <th>Employer Nmae</th>
        <th>ID NO</th>
        <th>Post</th>
         <th>Month</th>
        <th>Pay Date</th>
        <th>salary</th>
        <th>Payable Salary</th>
    </tr>
    @foreach ($models as $item)
        <tr>
            <td>{{$item->employe->employe_name}}</td>
            <td>{{$item->employe_id_no}}</td>
            <td>{{$item->post_name}}</td>
            <td>{{$item->salary_pay_month}}</td>
            <td>{{date("F d, Y",strtotime($item->pay_date)) }}</td>
            <td>{{$item->employe_sallary}} <span class="text-muted font-weight-bold">Taka</span></td>
            <td>{{$item->payable_salary}} <span class="text-muted font-weight-bold">Taka</span></td>
        </tr>
    @endforeach
    <tr class="mt-2">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="font-weight-bold">Total Salary: </td>
        <td class="font-weight-bold">{{$models->sum('payable_salary')}} <span class="text-muted font-weight-bold">Taka</span></td>
    </tr>
</table>
<button type="button" class="btn btn-sm btn-info mb-2 float-right printMe print-btn d-print-none" onclick='printDiv();'> <span class="icon-printer"> Print</span> </button>
    </div>
</div>