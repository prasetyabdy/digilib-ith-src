<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class DosenController extends Controller
{
    public function index()
    {
        $daftardosen = User::with('prodi')->where('role', 'dosen')->paginate(10);
        return view('admin.master-data.dosen.index', compact('daftardosen'));
    }

    public function create()
    {
        $daftarProdi = Prodi::all();
        return view('admin.master-data.dosen.create', compact('daftarProdi'));
    }

    public function store(Request $request)
    {

        User::create(['nama' => $request->nama, 'nim_nip' => $request->nim_nip, 'password' => bcrypt($request->password), 'prodi_id' => $request->prodi_id, 'role' => 'dosen']);
        Alert::success("Berhasil tambah dosen");
        return redirect('/master-data/dosen');
    }

    public function show(User $dosen)
    {
        return view('admin.master-data.dosen.show', compact('dosen'));
    }

    public function edit(User $dosen)
    {
        $daftarProdi = Prodi::all();
        return view('admin.master-data.dosen.edit', compact('dosen', 'daftarProdi'));
    }

    public function update(Request $request, User $dosen)
    {
        $dosen->update(['nama' => $request->nama, 'nim_nip' => $request->nim_nip, 'prodi_id' => $request->prodi_id]);
        if ($request->password) {
            $dosen->update(["password" => bcrypt($request->password)]);
        }
        Alert::success("Berhasil update");
        return redirect('/master-data/dosen');
    }

    public function destroy(User $dosen)
    {
        $dosen->delete();
        Alert::success("Berhasil hapus");
        return redirect('/master-data/dosen');
    }
}
