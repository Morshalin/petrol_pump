<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SATT IT Invoice</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('asset/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('asset/assets/css/invoice.css')}}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->
</head>

<body>


   <!-- Main navbar -->
   
    <!-- /main navbar -->


    <!-- Page content -->
    <div class="page-content">


        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
           
            <!-- /page header -->


            <!-- Content area -->
            <section class="star mt-4">
                <div class="container">
                   <div class="row">
                       <div class="col-md-3">
                           <img class="w-50" src="assets/img/Logo.png" alt="">
                       </div>
                       <div class="col-md-6 text-center">
                           <p class="mb-0 h1 text-uppercase company-title">SATT IT </p>
                       </div>
                   </div>
                    <div class="text-center">
                    
                    <p class="mb-0"><span>524, Manik Mia Road, Talaimari, Rajshahi.</span></p>
                    <p class="mb-0"><span>Phone :01700653799, 01850054500 </span></p>
                    <p class="mb-0"> www.sattit.com, www.satthost.com, www.sattacademy.com</p>
                    <p class="d-inline-block float-left">  Email : sattitbd@gmail.com </p>
                    <p class="d-inline-block float-right">  Email : info@sattit.com </p>
                    <p class="h5 font-weight-bold mt-5">Invoice / Bill</p>
                    </div>
              
                <div class="row" style="overflow: hidden;">
                    <div class="col-md-9 border-box">
                    <pre style="border:none"><p><span class="font-weight-bold">Cutomer Name:</span>{{$cus_info->customer_name}}</p><p><span class="font-weight-bold">Mobile Number:</span>{{$cus_info->customer_number}}</p><p><span class="font-weight-bold">Vehicle Name :</span>{{$cus_info->vehicle_name}}</p><p><span class="font-weight-bold">Vehicle Number :</span>{{$cus_info->vehicle_number}}</p>
                        </pre>
                    </div>
                    <div class="col-md-3 border-box">
                    <pre style="border:none"><p><span class="font-weight-bold">Date</span>{{$cus_info->sale_date}}</p><p><span class="font-weight-bold">Sold By : </span>{{$cus_info->user->username}}</p><p><span class="font-weight-bold">Email : </span>{{$cus_info->user->email}}</p>
                        </pre>
                    </div>
                      </div>
                </div>
            </section>


             <section>
                 <div class="container">
                    <div style="padding:15px;overflow: hidden;">
                      <div class="row">
                    
                         <div class="col-md-1 border-box">
                            
                             <p class="font-weight-bold text-center bordered">Sl. No.</p>
                             <div class="height-border">
                               <p class="text-center"><span>1</span></p>  
                             </div>
                             
                         </div>
                         <div class="col-md-5 border-box">
                             <p class="font-weight-bold bordered2 pl-2">Product Name</p>
                             <div class="height-border2">
                             <p class="h6 font-weight-bold pl-2">{{$cus_info->productitem->product_name}}</p>
                             </div>
                         </div>
                         <div class="col-md-2 border-box">
                             <p class="font-weight-bold text-center bordered2">
                                 Quantity
                             </p>
                             <div class="height-border2">
                                 <p class="text-center"><span>{{$cus_info->oil_sale}} &nbsp;Liter</span></p> 
                             </div>
                            
                         </div>
                            <div class="col-md-2 border-box">
                             <p class="font-weight-bold text-center bordered2">
                                 Unit Price
                             </p>
                             <div class="height-border2">
                             <p class="text-center"><span>{{$cus_info->oil_price}}</span></p>  
                             </div>
                             
                         </div>
                            <div class="col-md-2 border-box">
                             <p class="font-weight-bold text-center bordered2">
                                 Total
                             </p>
                             <div class="height-border2">
                                <p class="text-right mr-2"><span>{{$cus_info->oil_total_price}}</span></p> 
                             </div>
                             
                         </div>
                         
                         <div class="col-md-8"></div>
                         
                         <div class="col-md-2">
                             <p class="text-center">Total Amount</p>
                         </div>
                         <div class="col-md-2">
                             <p class="text-right">{{$cus_info->oil_total_price}}</p>
                         </div>
                         
                         
                         
                         <div class="col-md-12"></div>
                         
                         <div class="col-md-2 border-box mt-5 ">
                             <div style="font-weight: bold;">
                                <hr class="hrr">
                                 <p class="" style="font-weight: bold;">Receiver's Signature</p>
                             </div>
                         </div>
                         
                         <div class="col-md-8"></div>
                         <div class="col-md-2 mt-5 border-box">
                              <div style="font-weight: bold;text-align: right;">
                                <hr class="hrr2">
                                 <p class="mr-2" style="font-weight: bold;">Manager Signature</p>
                             </div>
                         </div>
                         <div class="col-md-12 border-box" style="border-top:solid 1px;">
                             <div class="row pt-4">
                                 <div class="col-md-4">
                                     <div style="display: flex;justify-content: space-between;">
                                     <p>Printing Date : &nbsp;{{$date}}</p>
                                     <p>Print Time : &nbsp;{{$time}}</p>
                                     </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="text-right">
                                      <p> Develop by : Satt IT- 018500-54 500</p>  
                                    </div>
                                    <div class="text-right mt-2">
                                         <button  onclick="myFunction()">Print Invoice</button>
                                    </div>
                                   
                                 </div>
                             </div>
                             
                         </div>
                     </div> 
               
                    </div>
                     
                 </div>
             </section>
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
<script>
function myFunction() {
  window.print();
}
</script>
</body></html>
