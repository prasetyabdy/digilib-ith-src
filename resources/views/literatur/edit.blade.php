@extends('layouts.authentication')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="/dashboard/literatur">Literatur</a>
            </li>
            <li class="breadcrumb-item active"><span>Edit</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4 mb-4">
            <h1 class="mb-4">Edit Literatur</h1>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                </div>
            @endif
            <form action="/dashboard/literatur/{{ $literatur->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="judul">Judul</label>
                        <input class="form-control" id="judul" value="{{ $literatur->judul }}"
                            placeholder="Strategi Pengelolaan Limbah Industri untuk Lingkungan Bersih" name="judul">
                    </div>


                    <div class="col-12">
                        <label class="form-label" for="abstrak">Abstrak</label>
                        <textarea class="form-control" id="abstrak" name="abstrak" rows="4"
                            placeholder="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aut earum, fuga impedit perferendis placeat ut. Alias aperiam blanditiis cupiditate enim harum, mollitia nemo!">{{ $literatur->abstrak }}</textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="kata-kunci">Kata Kunci</label>
                        <input class="form-control" id="kata-kunci" name="keyword"
                            placeholder="Lingkungan, Bersih, Limbah Industri" value="{{ $literatur->keyword }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" id="jenis-label" for="jenis">Jenis Koleksi</label>
                        <select class="form-select" id="jenis" name="jenis_koleksi" aria-labelledby="jenis-label">
                            @foreach ($daftarJenis as $jenis)
                                <option @selected($jenis->id == $literatur->jenis_id) value="{{ $jenis->id }}">{{ $jenis->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label" id="penulis-label" for="penulis">Penulis</label>
                        <select class="form-select" id="penulis" name="penulis" aria-labelledby="penulis-label">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected($user->id == $literatur->user_id)>{{ $user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label" id="kontributor-label" for="kontributor">Kontributor</label>
                        <select class="form-select" name="kontributor[]" id="kontributor" multiple="multiple"
                            aria-labelledby="kontributor-label">
                            @foreach ($daftarDosen as $dosen)
                                <option value="{{ $dosen->id }}"
                                    @php
foreach ($literatur->kontributor as $kontributor) {
                                        if($kontributor->user_id == $dosen->id) {
                                            echo "selected";
                                        }
                                    } @endphp>
                                    {{ $dosen->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="penerbit">Penerbit</label>
                        <input class="form-control" value="{{ $literatur->penerbit }}" id="penerbit" name="penerbit"
                            placeholder="Ilmu Maju Publishers">
                    </div>
                    {{-- <div class="col-sm-6 col-12">
                        <label class="form-label" id="fakultas-label" for="fakultas">Fakultas</label>
                        <select class="form-select" id="fakultas" name="fakultas" aria-labelledby="fakultas-label">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($daftarFakultas as $fakultas)
                                <option value="{{ $fakultas }}">{{ $fakultas->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-12">
                        <label class="form-label" id="program-studi-label" for="program-studi">Program Studi</label>
                        <select class="form-select" id="program-studi" name="program_studi"
                            aria-labelledby="program-studi-label">

                        </select>
                    </div> --}}
                    <div class="col-12">
                        <label class="form-label" for="file">Berkas</label>
                        <input class="form-control" id="file" name="file" type="file" accept="application/pdf"
                            value="test">
                        <div class="form-text">
                            File yang telah terunggah:
                            <a target="_blank" href="/storage/{{ $literatur->file }}">literatur.pdf</a>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center gap-3 mt-4">
                    <button class="btn btn-outline-secondary" type="button" onclick="history.back()">Kembali</button>
                    <button class="btn btn-primary" type="submit">Edit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#kontributor').select2({
                tags: true,
                theme: 'bootstrap-5'
            });

            $('#penulis').select2({
                theme: 'bootstrap-5',

            });

            // $('#fakultas').on('change', function() {
            //     const value = $(this).val()
            //     if (value) {
            //         var html = `<option value="">Pilih Prodi</option>`
            //         var fakultas = JSON.parse(value)
            //         console.log(fakultas.prodi)
            //         fakultas.prodi.forEach(element => {
            //             html += `<option value="${element.id}">${element.nama}</option>`
            //         });
            //         $('#program-studi').html(html)
            //     }
            // })
        })
    </script>
@endsection
