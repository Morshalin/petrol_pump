<div class="card">
    <div class="card-body">
         <div class="row">
             <div class="col-sm-12">
        <div class="text-center">
            <h2 class="m-0">{{ get_option('company_name') }}</h2>
            <p class="m-0">Day by day stock and Sale Report</p>
            <p class="m-0"> {{  get_option('Email')}}</p>
            <p class="m-0"> {{  get_option('phone')}}</p>
        </div>
    </div>
         </div>
         <div class="row mt-2">
             <div class="col-sm-4">
                 @php
                      $pro_name = App\TransactionPurchaseLine::where('product_item_id',$product)->first();
                 @endphp
                 <p class="font-weight-bold">Product: {{$pro_name->item->product_name}}</p>
             </div>
             <div class="col-sm-4">
                 <p class="text-center font-weight-bold">Month:
                     @php
                            $dateObj   = DateTime::createFromFormat('!m', $report_month);
                            $monthName = $dateObj->format('F'); 
                            echo $monthName.',';
                     @endphp
                    {{$report_year}} </p>
             </div>
             <div class="col-sm-4">
                 <p class="text-right font-weight-bold">Amount: Litter</p>
             </div>
         </div>
<table class="table table-bordered table-fixed">
    <thead class="header" id="myHeader">
        <tr>
            <th class="col-xs-1">Date</th>
            <th class="col-xs-2">Prevoius</th>
            <th class="col-xs-2">Purchase</th>
            <th class="col-xs-2">Total Qty</th>
            <th class="col-xs-2">Sale</th>
            <th class="col-xs-2">Sale After</th>
            <th class="col-xs-1">Somapony</th>
        </tr>
    </thead>
<tbody class="m-0">
    @php
        $total_mojud =0 ;
        $kromosoncito =0 ;
        $finishing_mojud = 0;
        $start_mojud= 0;
    @endphp
       @for ($i = 1; $i <=$day ; $i++)

       @php
       $date =Carbon\Carbon::createFromDate($report_year, $report_month, $i);
          $date = $date->format('Y-m-d');
           $start_mojud = $i == 1 ? $previous_total : $finishing_mojud;
           $purchase = App\TransactionPurchaseLine::where('product_item_id',$product)->whereDate('created_at',$date)->sum('quantity');
           $total_mojud =  $start_mojud + $purchase;
           $sale = App\TransactionSaleLine::where('product_item_id',$product)->whereDate('created_at',$date)->sum('quantity');;
           $kromosoncito +=  $sale;
           $finishing_mojud = $total_mojud - $sale;
       @endphp
        
          <tr>
              <td>{{$date}}</td>
                <td>{{$start_mojud ? number_format($start_mojud, 2) : '---'}}</td>
                <td>{{$purchase ? number_format($purchase, 2) : '---'}}</td>
                <td>{{$total_mojud ? number_format($total_mojud, 2) : '---'}}</td>
                <td>{{$sale ? number_format($sale, 2) : '---'}}</td>
                <td>{{$kromosoncito ? number_format($kromosoncito, 2) : '---'}}</td>
                <td>{{$finishing_mojud ? number_format($finishing_mojud, 2) : '---'}}</td>
          </tr>
          
   @endfor 
</tbody>      
</table>
<button type="button" class="btn btn-sm btn-info mb-2 float-right printMe d-print-none" onclick='printDiv();'> <span class="icon-printer"> Print</span> </button>
</div>
</div>