<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProdiController extends Controller
{
    public function index()
    {
        $daftarprodi = Prodi::query()->paginate(10);
        return view('admin.master-data.prodi.index', compact('daftarprodi'));
    }

    public function create()
    {
        return view('admin.master-data.prodi.create');
    }

    public function store(Request $request)
    {

        if ($request->gambar) {
            $gambar  =  $request->file('gambar')->store('gambar_prodi');
        }

        Prodi::create(['nama' => $request->nama, "gambar" => $gambar ?? null]);
        Alert::success("Berhasil tambah prodi");
        return redirect('/master-data/prodi');
    }

    public function show(Prodi $prodi)
    {
        return view('admin.master-data.prodi.show', compact('prodi'));
    }

    public function edit(Prodi $prodi)
    {
        return view('admin.master-data.prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        if ($request->gambar) {
            $gambar  =  $request->file('gambar')->store('gambar_prodi');
            $prodi->update(["gambar" => $gambar]);
        }

        $prodi->update(['nama' => $request->nama]);
        Alert::success("Berhasil update");
        return redirect('/master-data/prodi');
    }

    public function destroy(Prodi $prodi)
    {
        @unlink("storage/" . $prodi->gambar);
        $prodi->delete();
        Alert::success("Berhasil hapus");
        return redirect('/master-data/prodi');
    }
}
