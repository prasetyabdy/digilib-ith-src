<?php

namespace App\Http\Controllers;

use App\Imports\LiteraturImport;
use App\Models\Fakultas;
use App\Models\FileLiteratur;
use App\Models\Jenis;
use App\Models\Literatur;
use App\Models\LiteraturKontributor;
use App\Models\Subject;
use App\Models\SubjectLiteratur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class LiteraturController extends Controller
{
    public function index(Request $request)
    {
        $daftarLiteratur =  Literatur::with('user', 'kontributor.user')
            ->orderBy('updated_at', 'desc');
        if ($request->search) {
            $daftarLiteratur->where('judul', 'LIKE', "%{$request->search}%")->orWhere('abstrak', 'LIKE', "%{$request->search}%");
        }

        if ($request->jenis_id) {
            $daftarLiteratur->where('jenis_id', $request->jenis_id);
        }
        if (auth()->user()->role !== "admin") {
            $daftarLiteratur->where('user_id', auth()->id());
        }

        if ($request->status) {
            $daftarLiteratur->where('status', $request->status);
        }

        $daftarLiteratur =  $daftarLiteratur->paginate(25);
        $daftarJenis = Jenis::all();
        return view('literatur.index', compact('daftarLiteratur', 'daftarJenis'));
    }

    public function show(Literatur $literatur)
    {
        return view('literatur.show', compact('literatur'));
    }

    public function create()
    {
        $users = User::where(function ($query) {
            $query->where('role', 'dosen')
                ->orWhere('role', 'mahasiswa');
        })->get();
        $daftarDosen = User::where('role', 'dosen')->get();

        $daftarJenis = Jenis::all();

        return view('literatur.create', compact('daftarDosen', 'users',  'daftarJenis'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'judul' => ['required', 'max:255'],
            'abstrak' => ['required'],
            'keyword' => ['required', 'max:255'],
            'kontributor' => ['required'],

            'penerbit' => ['required'],
            'file' => ['required', 'file', 'mimes:pdf'],
        ]);

        if (auth()->user()->role == 'admin') {
            $request->validate([
                'penulis' => ['required'],
                'jenis_koleksi' => ['required'],
            ]);
            $status = 'diterima';
        }



        $literatur = Literatur::create([
            'judul' => $request->judul,
            'abstrak' => $request->abstrak,
            'keyword' => $request->keyword,
            'user_id' => $request->penulis ?? auth()->id(),
            'penulis_kontributor' => $request->penulis_kontributor,
            'jenis_id' =>  $request->jenis_koleksi ?? 1,
            'penerbit' => $request->penerbit,
            'file' => $request->file('file')->store('file'),
            'status' => $status ?? 'proses'
        ]);

        $size =  $request->file('file')->getSize();
        $fileName = $request->file('file')->store('file');

        FileLiteratur::create([
            'literatur_id' => $literatur->id,
            'file_name' => $fileName,
            'file_size' => $size,
            'file_type' => 'pdf'
        ]);



        foreach ($request->kontributor as $kontributor) {
            LiteraturKontributor::create([
                'literatur_id' => $literatur->id,
                'user_id' => $kontributor
            ]);
        }

        Alert::success("Berhasil tambah literatur");
        return redirect('/dashboard/literatur');
    }

    public function edit(Literatur $literatur)
    {
        $users = User::where(function ($query) {
            $query->where('role', 'dosen')
                ->orWhere('role', 'mahasiswa');
        })->get();

        $daftarDosen = User::where('role', 'dosen')->get();
        $daftarJenis = Jenis::all();

        return view('literatur.edit', compact('literatur', 'users', 'daftarDosen', 'daftarJenis'));
    }

    public function update(Request $request, Literatur $literatur)
    {
        $request->validate([
            'judul' => ['required', 'max:255'],
            'abstrak' => ['required'],
            'keyword' => ['required', 'max:255'],
            'penulis' => ['required'],
            'kontributor' => ['required'],
            'jenis_koleksi' => ['required'],
            'penerbit' => ['required'],
        ]);

        $literatur->update([
            'judul' => $request->judul,
            'abstrak' => $request->abstrak,
            'keyword' => $request->keyword,
            'user_id' => $request->penulis,
            'jenis_id' =>  $request->jenis_koleksi,
            'penerbit' => $request->penerbit,
        ]);

        if ($request->file) {
            $literatur->update(['file' => $request->file('file')->store('file')]);
        }

        LiteraturKontributor::where('literatur_id', $literatur->id)->delete();
        foreach ($request->kontributor as $kontributor) {
            LiteraturKontributor::create([
                'literatur_id' => $literatur->id,
                'user_id' => $kontributor
            ]);
        }

        Alert::success("Berhasil update literatur");
        return redirect('/dashboard/literatur');
    }

    public function terima(Literatur $literatur)
    {
        $literatur->update(['status' => 'diterima']);
        Alert::success("Berhasil menerima literatur " . $literatur->judul);
        return back();
    }

    public function import(Request $request)
    {
        Excel::import(new LiteraturImport, "data.xlsx");

        return redirect('/')->with('success', 'All good!');
    }

    public function destroy(Literatur $literatur)
    {
        $file = FileLiteratur::where('literatur_id', $literatur->id)->first();

        @unlink("storage/$file->file_name");
        $literatur->delete();
        Alert::success("Berhasil hapus literatur");
        return back();
    }
}
