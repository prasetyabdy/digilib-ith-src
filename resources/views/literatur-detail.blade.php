@extends('guest')

@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="literature-detail">
           
                @if ($literatur->jenis_id == 1)
                    <span class="badge text-white fw-normal text-bg-danger text-capitalize">
                        {{ $literatur->jenis->nama }}
                    </span>
                @endif
                @if ($literatur->jenis_id == 2)
                    <span class="badge text-white fw-normal text-bg-success text-capitalize">
                        {{ $literatur->jenis->nama }}
                    </span>
                @endif
                @if ($literatur->jenis_id == 3)
                    <span class="badge text-white fw-normal text-bg-info text-capitalize">
                        {{ $literatur->jenis->nama }}
                    </span>
                @endif
                @if ($literatur->jenis_id > 3)
                    <span class="badge text-white fw-normal text-bg-secondary text-capitalize">
                        {{ $literatur->jenis->nama }}
                    </span>
                @endif
            
            <h1 class="mt-2">
                {{ $literatur->judul }}
            </h1>
            <p class="mb-0">
                <span class="fw-bold">{{ $literatur->user->nama ?? $literatur->penulis_kontributor }}</span>,
                @foreach ($literatur->kontributor as $kontributor)
                    {{ $kontributor->user?->nama }},
                @endforeach

            </p>
            <div class="py-1 my-4 border-top border-bottom d-flex align-items-center justify-content-between">
                <div class="hstack gap-2 align-items-center">
                    <i class="bi-eye fs-5"></i>{{ $literatur->view }}
                </div>
                <div class="hstack gap-1">
                    @auth
                        <a href="/storage/{{ $literatur->file->file_name ?? null }}" download=""
                            class="btn btn-icon link-dark"><i class="bi-download"></i></a>
                    @endauth
                    <btn class="btn btn-icon link-dark"><i class="bi-share"></i></btn>
                </div>
            </div>
            <div id="literature-detail-content">
                <div>
                    <h6>Abstrak:</h6>
                    <p>
                        {{ $literatur->abstrak }}
                    </p>
                </div>
                <div>
                    <h6 class="d-inline">Kata Kunci:</h6>
                    <p class="fst-italic d-inline">{{ $literatur->keyword }}</p>
                </div>
                <div>
                    <h6 class="d-inline">Penerbit:</h6>
                    <p class="d-inline">{{ $literatur->penerbit }}</p>
                </div>
                <div>
                    <h6 class="d-inline">Program Studi:</h6>
                    <p class="d-inline">{{ $literatur->user?->prodi?->nama }}</p>
                </div>
                {{-- <div>
                <h6 class="d-inline">Staff yang Input/Edit:</h6>
                <p class="d-inline">Ethelyn Guilliland</p>
            </div> --}}
            </div>
        </section>
    </div>
@endsection
