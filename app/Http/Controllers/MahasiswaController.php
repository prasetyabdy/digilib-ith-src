<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    public function index()
    {
        $daftarmahasiswa = User::with('prodi')->where('role', 'mahasiswa')->paginate(10);
        return view('admin.master-data.mahasiswa.index', compact('daftarmahasiswa'));
    }

    public function create()
    {
        $daftarProdi = Prodi::all();
        return view('admin.master-data.mahasiswa.create', compact('daftarProdi'));
    }

    public function store(Request $request)
    {

        User::create(['nama' => $request->nama, 'nim_nip' => $request->nim_nip, 'password' => bcrypt($request->password), 'prodi_id' => $request->prodi_id, 'role' => 'mahasiswa']);
        Alert::success("Berhasil tambah mahasiswa");
        return redirect('/master-data/mahasiswa');
    }

    public function show(User $mahasiswa)
    {
        return view('admin.master-data.mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(User $mahasiswa)
    {
        $daftarProdi = Prodi::all();
        return view('admin.master-data.mahasiswa.edit', compact('mahasiswa', 'daftarProdi'));
    }

    public function update(Request $request, User $mahasiswa)
    {
        $mahasiswa->update(['nama' => $request->nama, 'nim_nip' => $request->nim_nip, 'prodi_id' => $request->prodi_id]);
        if ($request->password) {
            $mahasiswa->update(["password" => bcrypt($request->password)]);
        }
        Alert::success("Berhasil update");
        return redirect('/master-data/mahasiswa');
    }

    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();
        Alert::success("Berhasil hapus");
        return redirect('/master-data/mahasiswa');
    }
}
