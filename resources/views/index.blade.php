@extends('layouts.master')
@section('title')
Welcome
@endsection
@section('username')
{{ Auth::user()->name }}
@endsection
@section('judul')
<h1>Welcome</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Forms</a></div>
    <div class="breadcrumb-item">Advanced Forms</div>
</div>
@endsection
@section('section-header')
Welcome
@endsection
@section('content')
<h2 class="section-title">Autokool Apps</h2>
<p class="section-lead">Estimator System</p>

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div class="text-center">
            {{-- <img src="../assets/img/logo.png" alt="" width="400" height="200" srcset=""> --}}
            <hr>
            <h1>Autokool <span class="badge badge-primary">Estimator Apps</span></h1>
        </div>
        <div class="card-footer bg-whitesmoke text-center">
            <b>2021</b>
        </div>
    </div>
</div>
@endsection
@push('script')
{{-- <script>alert("Hello\nHow are you?");</script> --}}
@endpush
