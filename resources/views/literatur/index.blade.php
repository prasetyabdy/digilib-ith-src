@extends('layouts.authentication')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb my-0">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a>
            </li>
            <li class="breadcrumb-item active"><span>Literatur</span>
            </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container-lg px-4 mb-4">
        <div class="d-flex mb-4 justify-content-between align-items-end flex-wrap gap-3">
            <h1 class="mb-0">Literatur</h1><a class="btn btn-primary" href="/dashboard/literatur/create">
                <svg class="icon me-sm-2">
                    <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-plus"></use>
                </svg><span class="d-none d-sm-inline">Tambah Literatur</span></a>
        </div>
        <div class="card">
            <div class="card-header">
                <form action="" class="d-flex justify-content-between">
                    <div>
                        <select name="status" id="status" class="form-control-sm" onchange="this.form.submit()">
                            <option value="" @selected(request('status') == '')>Semua Literatur</option>
                            <option value="proses" @selected(request('status') == 'proses')>Proses</option>
                            <option value="diterima" @selected(request('status') == 'diterima')>Diterima</option>
                        </select>
                        @if (auth()->user()->role == 'admin')
                            <select name="jenis_id" id="jenis_id" class="form-control-sm" onchange="this.form.submit()">
                                <option value="">Semua jenis</option>
                                @foreach ($daftarJenis as $jenis)
                                    <option value="{{ $jenis->id }}" @selected(request('jenis_id') == $jenis->id)>{{ $jenis->nama }}
                                    </option>
                                @endforeach
                            </select>
                        @endif

                    </div>

                    <input type="search" placeholder="Cari literatur..." class="form-control-sm" name="search">
                </form>

            </div>
            <table class="table table-striped align-middle" style="width: 100%">
                <thead>
                    <tr>
                        <th data-priority="1">Judul</th>
                        <th>Penulis</th>
                        <th>Prodi</th>
                        <th data-priority="3">Jenis</th>
                        <th>Status</th>
                        <th data-priority="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarLiteratur as $literatur)
                        <tr>
                            <td>{{ $literatur->judul }}</td>
                            <td>{{ $literatur->user->nama ?? $literatur->penulis_kontributor }}</td>
                            <td>{{ $literatur->user->prodi->nama ?? null }}</td>
                            <td>
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
                            </td>
                            <td>
                                @if ($literatur->status == 'proses')
                                    <span class="badge text-white fw-normal text-bg-warning text-capitalize">proses</span>
                                @endif
                                @if ($literatur->status == 'diterima')
                                    <span
                                        class="badge text-white fw-normal text-bg-success text-capitalize">{{ $literatur->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group-action">
                                    @if (auth()->user()->role == 'admin')
                                        @if ($literatur->status == 'proses')
                                            <span data-coreui-toggle="tooltip" data-coreui-title="Approve literatur"><a
                                                    class="btn btn-link btn-sm link-body-emphasis"
                                                    href="/literatur/{{ $literatur->id }}/terima"
                                                    onclick="return confirm('Apakah anda yakin ?')"
                                                    aria-label="Approve literatur">
                                                    <svg class="icon icon-lg">
                                                        <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-check">
                                                        </use>
                                                    </svg></a>
                                            </span>
                                        @endif
                                    @endif
                                    <span data-coreui-toggle="tooltip" data-coreui-title="Detail literatur"><a
                                            class="btn btn-link btn-sm link-body-emphasis"
                                            href="/dashboard/literatur/{{ $literatur->id }}" aria-label="Detail literatur">
                                            <svg class="icon icon-lg">
                                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-search"></use>
                                            </svg></a></span><span data-coreui-toggle="tooltip"
                                        data-coreui-title="Ubah literatur"><a class="btn btn-link btn-sm link-body-emphasis"
                                            href="/dashboard/literatur/{{ $literatur->id }}/edit"
                                            aria-label="Ubah literatur">
                                            <svg class="icon icon-lg">
                                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                                            </svg></a></span>
                                    <span data-coreui-toggle="tooltip" data-coreui-title="Unduh literatur"><a
                                            class="btn btn-link btn-sm link-body-emphasis"
                                            href="/storage/{{ $literatur->file->file_name ?? null }}" target="_blank"
                                            aria-label="Unduh literatur">
                                            <svg class="icon icon-lg">
                                                <use
                                                    xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-data-transfer-down">
                                                </use>
                                            </svg></a></span><span data-coreui-toggle="tooltip"
                                        data-coreui-title="Hapus literatur">
                                        <btn class="btn btn-link btn-sm link-danger" aria-label="Hapus literatur"
                                            data-coreui-toggle="modal"
                                            data-coreui-target="#literatur-delete-modal{{ $literatur->id }}">
                                            <svg class="icon icon-lg">
                                                <use xlink:href="/vendors/@coreui/icons/svg/free.svg#cil-trash"></use>
                                            </svg>
                                        </btn>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $daftarLiteratur->links() }}
        </div>
        @foreach ($daftarLiteratur as $literatur)
            <div class="modal fade" id="literatur-delete-modal{{ $literatur->id }}" tabindex="-1"
                aria-labelledby="literatur-delete-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="/dashboard/literatur/{{ $literatur->id }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="literatur-delete-modal-label">Hapus literatur?</h5>
                                <button class="btn-close" type="button" data-coreui-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <p class="mb-0">
                                    Hapus literatur dengan judul
                                    <strong>{{ $literatur->judul }}</strong>?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button"
                                    data-coreui-dismiss="modal">Batal</button>
                                <button class="btn btn-danger" type="submit" data-coreui-dismiss="modal"
                                    data-toast-toggle="">Hapus
                                    literatur</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>
@endsection
