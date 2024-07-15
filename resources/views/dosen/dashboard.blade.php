@extends('layouts.authentication')
@section('breadcrumb')
@endsection

@section('content')
    <div class="container-lg px-4 mb-4">
        <h1 class="mb-4">Selamat Datang, {{ auth()->user()->nama }}</h1>
    </div>
@endsection