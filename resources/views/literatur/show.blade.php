@extends('layouts.authentication')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="/dashboard/literatur">Literatur</a>
            </li>
            <li class="breadcrumb-item active"><span>Detail</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4 mb-4">
            <h1 class="mb-4">Detail Literatur</h1>
            <!--
                                                                                                                                  Flags:
                                                                                                                                    isDetail - Show detail view instead of form
                                                                                                                                    data - Filled form with data
                                                                                                                                  
                                                                                                                                  -->
            <form>
                <div class="row g-3">
                    <div class="col-12">
                        <h6>Judul</h6>
                        <p class="mb-0">{{ $literatur->judul }}</p>
                    </div>
                    <div class="col-12">
                        <h6>Abstrak</h6>
                        <p class="mb-0">{{ $literatur->abstrak }}</p>
                    </div>
                    <div class="col-12">
                        <h6>Kata Kunci</h6>
                        <p class="mb-0 fst-italic">{{ $literatur->keyword }}</p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h6>Penulis</h6>
                        <p class="mb-0">{{ $literatur->user->nama }}</p>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h6>Kontributor</h6>
                        <p class="mb-0">
                            @foreach ($literatur->kontributor as $kontributor)
                                {{ $kontributor->user->nama ?? $kontributor->user_id }} ,
                            @endforeach
                        </p>
                    </div>
                    <div class="col-12">
                        <h6>Jenis</h6>
                        <p class="mb-0 text-capitalize">{{ $literatur->jenis->nama }}</p>
                    </div>
                    <div class="col-12">
                        <h6>Penerbit</h6>
                        <p class="mb-0">{{ $literatur->penerbit }}</p>
                    </div>

                    <div class="col-sm-6 col-12">
                        <h6>Program Studi</h6>
                        <p class="mb-0">{{ $literatur->user->prodi->nama }}</p>
                    </div>
                    <div class="col-12">
                        <h6>Berkas</h6><a class="icon-link" href="/storage/{{ $literatur->file->file_name ?? null }}" download
                            target="_blank">
                            <svg class="icon">
                                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
                            </svg>file.pdf</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
