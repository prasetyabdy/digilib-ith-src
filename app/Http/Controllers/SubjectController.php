<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    public function index()
    {
        $daftarsubject = Subject::query()->paginate(10);
        return view('admin.master-data.subject.index', compact('daftarsubject'));
    }

    public function create()
    {
        return view('admin.master-data.subject.create');
    }

    public function store(Request $request)
    {
        Subject::create(['nama' => $request->nama]);
        Alert::success("Berhasil tambah subject");
        return redirect('/master-data/subject');
    }

    public function show(Subject $subject)
    {
        return view('admin.master-data.subject.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('admin.master-data.subject.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update(['nama' => $request->nama]);
        Alert::success("Berhasil update");
        return redirect('/master-data/subject');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        Alert::success("Berhasil hapus");
        return redirect('/master-data/subject');
    }
}
