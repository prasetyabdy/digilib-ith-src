@extends('guest')

@section('content')
    <div class="flex-grow-1 mt-6">
        <section id="fakultas-detail">
            <div class="heading text-white position-relative d-flex flex-column justify-content-end py-4">
                <div class="position-relative z-1 container">
                    <h1 class="mb-0">{{ $prodi->nama }}</h1>
                    <p class="mb-0 mt-2">Jumlah literatur : {{ $literaturs->count() }}</p>
                </div>
                <img class="position-absolute z-0 pe-none object-fit-cover w-100 h-100"
                    src="https://picsum.photos/id/74/1000/800" alt="Fakultas" />
            </div>
            <div class="container py-5">
                <h1 class="mb-4">Literatur Terkait</h1>
                <div class="row g-4">
                    <div class="col-lg-9 col-md-8 order-md-0 order-1">
                        <div class="vstack gap-4 mb-4">
                            @foreach ($literaturs as $literatur)
                                <article class="literature">
                                    <div class="mb-2 d-flex gap-2 align-items-center">

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
                                        <p class="mb-0">{{ $literatur->penerbit }} |
                                            {{ $literatur->created_at->format('Y') }}</p>
                                    </div>
                                    <a href="/literatur/{{ $literatur->id }}">
                                        <h5>
                                            {{ $literatur->judul }}

                                        </h5>
                                    </a>
                                    <p class="mb-0">
                                        <span
                                            class="fw-bold">{{ $literatur->user->nama ?? $literatur->penulis_kontributor }}</span>,
                                        @foreach ($literatur->kontributor as $kontributor)
                                            {{ $kontributor->user->nama ?? $kontributor->user_id }},
                                        @endforeach
                                        <i class="bi-info-circle ms-2" data-bs-toggle="tooltip" data-bs-html="true"
                                            data-bs-title="&lt;div class='text-start'&gt;
				&lt;b&gt;Penulis: &lt;/b&gt;{{ $literatur->user->nama ?? $literatur->penulis_kontributor }}&lt;br/&gt;
				&lt;b&gt;Kontributor: &lt;/b&gt; @foreach ($literatur->kontributor as $kontributor)
                                            {{ $kontributor->user->nama ?? $kontributor->user_id }}, @endforeach
			&lt;/div&gt;"></i>
                                    </p>
                                    <div class="content collapse" id="literature-content-19">
                                        <p class="my-2">

                                            {{ $literatur->abstrak }}

                                        </p>

                                        <p>
                                            Kata Kunci:
                                            <span class="fst-italic">Software Engineer</span>
                                        </p>
                                    </div>
                                    <button
                                        class="btn btn-link link-dark p-0 mt-2 d-flex align-items-center gap-2 text-start"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#literature-content-19"
                                        aria-expanded="false" aria-controls="literature-content-19">
                                        <span>Lihat lebih banyak</span><i class="bi-chevron-down"></i>
                                    </button>
                                </article>
                            @endforeach

                        </div>
                        <a href="#" class="btn btn-primary" for="search-bar" data-navbar-toggle="show">Cari literatur
                            lain</a>
                    </div>

                    <div class="col-lg-3 col-md-4 order-md-1 order-0" id="filter">
                        <div class="accordion-item accordion border-0 rounded-0">
                            <h6 class="mb-0 accordion-button collapsed border rounded" data-bs-toggle="collapse"
                                data-bs-target="#filter-content" aria-expanded="false" aria-controls="filter-content">
                                Filter
                            </h6>
                        </div>
                        <div class="accordion-collapse collapse" id="filter-content">
                            <form class="accordion-collapse collapse" id="filter-content" action="">
                                <p class="mb-2">Jenis</p>

                                <div class="filter-list">

                                    @foreach ($jenis as $j)
                                        @php

                                            if (request('jenis')) {
                                                $checked = array_filter(request('jenis'), function ($jenis) use ($j) {
                                                    return $jenis == $j->id;
                                                })
                                                    ? 'checked'
                                                    : '';
                                            } else {
                                                $checked = '';
                                            }

                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" id="{{ $j->nama }}" type="checkbox"
                                                value="{{ $j->id }}" name="jenis[]" {{ $checked }} /><label
                                                class="form-check-label"
                                                for="{{ $j->nama }}">{{ $j->nama }}<span
                                                    class="text-body-tertiary">
                                                    ({{ \App\Models\Literatur::where('status', 'diterima')->whereHas('user', function ($q) use ($prodi) {
                                                            return $q->where('prodi_id', $prodi->id);
                                                        })->where('jenis_id', $j->id)->count() }})
                                                </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-primary w-100" type="submit">
                                    Filter
                                </button>
                                <button
                                    class="btn btn-link link-dark p-0 mt-2 d-flex align-items-center gap-2 d-none text-start"
                                    type="button">
                                    <span>Lihat lebih banyak</span><i class="bi-chevron-down"></i>
                                </button>
                            </form>
                            <div>
                                <p class="mb-2">Program Studi</p>

                                <div class="filter-list">
                                    @foreach ($prodis as $prodi)
                                        @php
                                            if (request('prodi')) {
                                                $checked2 = array_filter(request('prodi'), function ($data) use (
                                                    $prodi,
                                                ) {
                                                    return $data == $prodi->id;
                                                })
                                                    ? 'checked'
                                                    : '';
                                            } else {
                                                $checked2 = '';
                                            }

                                        @endphp
                                        <div class="form-check">
                                            <a class="form-check-label text-decoration-none"
                                                href="/prodi/{{ $prodi->id }}"
                                                for="{{ $prodi->id }}">{{ $prodi->nama }}<span
                                                    class="text-body-tertiary">
                                                    ({{ \App\Models\Literatur::where('status', 'diterima')->whereHas('user', function ($query) use ($prodi) {
                                                            $query->where('prodi_id', $prodi->id);
                                                        })->count() }})
                                                </span></a>
                                        </div>
                                    @endforeach
                                </div>
                                <button
                                    class="btn btn-link link-dark p-0 mt-2 d-flex align-items-center gap-2 d-none text-start"
                                    type="button">
                                    <span>Lihat lebih banyak</span><i class="bi-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
