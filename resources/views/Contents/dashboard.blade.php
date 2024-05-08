@extends('Component.app')

@section('Dashboard')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <div class="col-xl-6">
            @include('Contents.bar-chart')
        </div>
    <div class="col-xl-4 col-lg-5"></div>
    
    </div>
@endsection