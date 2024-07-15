@extends('layouts.authentication')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="/master-data/mahasiswa">mahasiswa</a>
            </li>
            <li class="breadcrumb-item active"><span>Edit</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="body flex-grow-1">
        <div class="container-lg px-4 mb-4">
            <h1 class="mb-4">Edit mahasiswa</h1>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                </div>
            @endif
            <form action="/master-data/mahasiswa/{{ $mahasiswa->id }}/update" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label" for="nama">Nama mahasiswa</label>
                        <input class="form-control" id="nama" placeholder="Masukkan Nama" required name="nama"
                            value="{{ $mahasiswa->nama }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="prodi_id">Prodi</label>
                        <select required name="prodi_id" id="prodi_id" class="form-select">
                            @foreach ($daftarProdi as $prodi)
                                <option value="{{ $prodi->id }}" @selected($mahasiswa->prodi_id == $prodi->id)>{{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label" for="nim_nip">NIM</label>
                        <input class="form-control" id="nim_nip" placeholder="Masukkan NIM" required name="nim_nip"
                            value="{{ $mahasiswa->nim_nip }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" placeholder="Masukkan Password" name="password" type="password">
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
