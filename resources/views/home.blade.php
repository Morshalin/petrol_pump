{{-- {{ dd(auth()->user()->getProfile()) }} --}}
@extends('layouts.app', ['title' => 'Dahsboard', 'modal' => false])
@section('page.header')
<div class="page-header page-header-light mb-2">
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> HOME</span>
            </div>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{$employer}}</h3>
                        <span class="text-uppercase font-size-xs">Total Employer</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-user-plus icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card card-body bg-info-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{$customer}}</h3>
                        <span class="text-uppercase font-size-xs">Total Customers</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-users icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
  

        @foreach ($product as $product_stoke)
            <div class="col-sm-4">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{$product_stoke->products->sum('oil_stack')}}</h3>
                        <span class="text-uppercase font-size-xs">Total {{$product_stoke->product_name}} Stock In Our Company</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-download icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @foreach ($sale_in_stock as $stock_porduct)
            <div class="col-sm-4">
            <div class="card card-body bg-danger-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{$stock_porduct->oil_stack}}</h3>
                        <span class="text-uppercase font-size-xs">Total {{$stock_porduct->productitem->product_name}} Stock In Present</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-cart-add2 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- @foreach ($sale_in_stock as $stock_porduct)
            <div class="col-sm-4">
            <div class="card card-body bg-indigo-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                    <h3 class="mb-0">{{$product_stoke->products->sum('oil_stack') -  $stock_porduct->oil_stack}}</h3>
                        <span class="text-uppercase font-size-xs">Total {{$stock_porduct->productitem->product_name}} Sale In Present</span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-cart-add2 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach --}}

    </div>
</div>
@stop
@section('content')
<!-- Basic initialization -->

<!-- /basic initialization -->
@stop
@push('admin.scripts')
<!-- Theme JS files -->
<script src="{{ asset('js/main.js') }}"></script>
<!-- /theme JS files -->
@endpush