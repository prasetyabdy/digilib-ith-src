@extends('layouts.authentication')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0">
            <li class="breadcrumb-item active"><span>Home</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container-lg px-4 mb-4">
        <h1 class="mb-4">Selamat Datang, {{ auth()->user()->name }}</h1>
        @if (auth()->user()->role === 'admin')
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-body-secondary float-end clearfix">
                            <svg class="icon icon-xxl">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-book"></use>
                            </svg>
                        </div>
                        <p class="mb-0 text-body-secondary text-truncate">Literatur</p>
                        <h2 class="mb-4">{{ $literatur }}</h2><a class="icon-link link-body-emphasis"
                            href="/dashboard/literatur"><span>Lihat
                                semua data</span>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-body-secondary float-end clearfix">
                            <svg class="icon icon-xxl">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                            </svg>
                        </div>
                        <p class="mb-0 text-body-secondary text-truncate">Mahasiswa</p>
                        <h2 class="mb-4">{{ $mahasiswa }}</h2><a class="icon-link link-body-emphasis"
                            href="/master-data/mahasiswa"><span>Lihat semua data</span>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-body-secondary float-end clearfix">
                            <svg class="icon icon-xxl">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-school"></use>
                            </svg>
                        </div>
                        <p class="mb-0 text-body-secondary text-truncate">Dosen</p>
                        <h2 class="mb-4">{{ $dosen }}</h2><a class="icon-link link-body-emphasis"
                            href="/master-data/dosen/"><span>Lihat semua data</span>
                            <svg class="icon">
                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-arrow-right"></use>
                            </svg></a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
