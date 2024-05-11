@extends('Component.app')

@section('Dashboard')

@section('contents')
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h2 class="mb-0">Dashboard</h2>
            
        </div>
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                @include('Contents.bar-chart')
            </div>
            <div class="col-xl-4 col-lg-5">
                @include('Contents.pie-chart')
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                @include('Contents.SPK.index')
            </div>
        </div>
@endsection