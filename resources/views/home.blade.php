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
  
    <div class="row mt-3">
         <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-blue-400 has-bg-image">
                <div class="media">
                    <div class="media-body">
                        <h3 class="mb-0">{{$total_purchase}} TK</h3>
                        <span class="text-uppercase font-size-xs">Total Purchase </span>
                    </div>

                    <div class="ml-3 align-self-center">
                        <i class="icon-bubbles4 icon-3x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-danger-400 has-bg-image">
            <div class="media">
                <div class="media-body">
                    <h3 class="mb-0">{{$total_sale}} Tk</h3>
                    <span class="text-uppercase font-size-xs">Total Sale</span>
                </div>

                <div class="ml-3 align-self-center">
                    <i class="icon-bag icon-3x opacity-75"></i>
                </div>
            </div>
        </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card card-body bg-success-400 has-bg-image">
                <div class="media">
                    <div class="mr-3 align-self-center">
                        <i class="icon-pointer icon-3x opacity-75"></i>
                    </div>

                    <div class="media-body text-right">
                        <h3 class="mb-0">{{$total_purchase_due}} Tk</h3>
                        <span class="text-uppercase font-size-xs">Total Purchase Due</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
        <div class="card card-body bg-indigo-400 has-bg-image">
            <div class="media">
                <div class="mr-3 align-self-center">
                    <i class="icon-enter6 icon-3x opacity-75"></i>
                </div>

                <div class="media-body text-right">
                    <h3 class="mb-0">{{$total_sale_due}} Tk</h3>
                    <span class="text-uppercase font-size-xs">Total Sale Due</span>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="row">
         <div class="col-sm-6 col-xl-6">
            {!! $purhcase->html() !!}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-xl-6">
            {!! $sale->html() !!}
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $purhcase->script() !!}
{!! $sale->script() !!}
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