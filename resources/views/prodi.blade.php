@extends('guest')
@section('content')
    <div class="flex-grow-1 container mt-6">
        <section class="py-5" id="fakultas-list">
            <h1 class="mb-4">Program Studi</h1>
            <div class="row g-4">
                @foreach ($prodis as $prodi)
                    <a class="col-lg-2 col-md-3 col-sm-4 col-6-shadow" href="/prodi/{{ $prodi->id }}">
                        @if ($prodi->gambar)
                            <img src="/storage/{{ $prodi->gambar }}" />
                        @else
                            <img src="assets/ith-ft.png" />
                        @endif

                        <h6>{{ $prodi->nama }}</h6>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
@endsection
