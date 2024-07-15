<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JenisController;
use App\Http\Controllers\LiteraturController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubjectController;
use App\Models\FileLiteratur;
use App\Models\Jenis;
use App\Models\Literatur;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $daftarLiteratur =  Literatur::with('user', 'kontributor.user')->where('status', 'diterima')->get();
    return view('welcome', compact('daftarLiteratur'));
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/prodi', function () {
    $prodis = Prodi::all();
    return view('prodi', compact('prodis'));
});

Route::get('/prodi/{prodi_id}', function (Request $request, $prodi_id) {
    $prodis = Prodi::all();
    $prodi = Prodi::find($prodi_id);
    $literaturs = Literatur::where('status', 'diterima')->whereHas('user', function ($query) use ($prodi_id) {
        $query->where('prodi_id', $prodi_id);
    });
    $jenis = Jenis::all();
    if ($request->jenis) {
        $literaturs->whereIn('jenis_id', $request->jenis);
    }

    $literaturs = $literaturs->get();
    return view('prodi-literatur', compact('prodi', 'literaturs', 'prodis', 'jenis'));
});


Route::get('/search', SearchController::class);

Route::get('/literatur/{literatur}', function (Literatur $literatur) {
    $literatur->increment('view');
    return view('literatur-detail', compact('literatur'));
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/import', [LiteraturController::class, 'import']);

Route::post('/login', function (Request $request) {
    if (Auth::attempt(['nim_nip' => $request->username, 'password' => $request->password])) {
        // The user is being remembered...
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'superadmin') {
            return redirect()->intended('/admin/dashboard');
        }

        if (auth()->user()->role == 'mahasiswa') {
            return redirect()->intended('/mahasiswa/dashboard');
        }
        if (auth()->user()->role == 'dosen') {
            return redirect()->intended('/dosen/dashboard');
        }
        
    } else {
        Alert::error("Username / Password Salah");
        return back();
    }
});

Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect('/admin/dashboard');
    }
    if (auth()->user()->role == 'dosen') {
        return redirect('/dosen/dashboard');
    }

    return redirect('/mahasiswa/dashboard');
})->middleware('auth');

Route::get('/admin/dashboard', function () {
    $literatur = Literatur::count();
    $mahasiswa = User::where('role', 'mahasiswa')->count();
    $dosen = User::where('role', 'dosen')->count();
    return view('admin.dashboard', compact('literatur', 'mahasiswa', 'dosen'));
})->middleware('auth');

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/literatur', [LiteraturController::class, 'index']);
    Route::get('/dashboard/literatur/create', [LiteraturController::class, 'create']);
    Route::get('/dashboard/literatur/{literatur}', [LiteraturController::class, 'show']);
    Route::get('/literatur/{literatur}/terima', [LiteraturController::class, 'terima']);
    Route::get('/dashboard/literatur/{literatur}/edit', [LiteraturController::class, 'edit']);
    Route::put('/dashboard/literatur/{literatur}', [LiteraturController::class, 'update']);
    Route::post('/dashboard/literatur', [LiteraturController::class, 'store']);
    Route::delete('/dashboard/literatur/{literatur}', [LiteraturController::class, 'destroy']);

    Route::get('/master-data/jenis', [JenisController::class, 'index']);
    Route::get('/master-data/jenis/create', [JenisController::class, 'create']);
    Route::post('/master-data/jenis', [JenisController::class, 'store']);
    Route::get('/master-data/jenis/{jenis}/show', [JenisController::class, 'show']);
    Route::get('/master-data/jenis/{jenis}/edit', [JenisController::class, 'edit']);
    Route::put('/master-data/jenis/{jenis}/update', [JenisController::class, 'update']);
    Route::delete('/master-data/jenis/{jenis}', [JenisController::class, 'destroy']);

    Route::get('/master-data/prodi', [ProdiController::class, 'index']);
    Route::get('/master-data/prodi/create', [ProdiController::class, 'create']);
    Route::post('/master-data/prodi', [ProdiController::class, 'store']);
    Route::get('/master-data/prodi/{prodi}/show', [ProdiController::class, 'show']);
    Route::get('/master-data/prodi/{prodi}/edit', [ProdiController::class, 'edit']);
    Route::put('/master-data/prodi/{prodi}/update', [ProdiController::class, 'update']);
    Route::delete('/master-data/prodi/{prodi}', [ProdiController::class, 'destroy']);


    Route::get('/master-data/subject', [SubjectController::class, 'index']);
    Route::get('/master-data/subject/create', [SubjectController::class, 'create']);
    Route::post('/master-data/subject', [SubjectController::class, 'store']);
    Route::get('/master-data/subject/{subject}/show', [SubjectController::class, 'show']);
    Route::get('/master-data/subject/{subject}/edit', [SubjectController::class, 'edit']);
    Route::put('/master-data/subject/{subject}/update', [SubjectController::class, 'update']);
    Route::delete('/master-data/subject/{subject}', [SubjectController::class, 'destroy']);

    Route::get('/master-data/mahasiswa', [MahasiswaController::class, 'index']);
    Route::get('/master-data/mahasiswa/create', [MahasiswaController::class, 'create']);
    Route::post('/master-data/mahasiswa', [MahasiswaController::class, 'store']);
    Route::get('/master-data/mahasiswa/{mahasiswa}/show', [MahasiswaController::class, 'show']);
    Route::get('/master-data/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit']);
    Route::put('/master-data/mahasiswa/{mahasiswa}/update', [MahasiswaController::class, 'update']);
    Route::delete('/master-data/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);

    Route::get('/admin/users', [AdminController::class, 'index']);
    Route::get('/admin/users/create', [AdminController::class, 'create']);
    Route::post('/admin/users', [AdminController::class, 'store']);
    Route::get('/admin/users/{user}/show', [AdminController::class, 'show']);
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit']);
    Route::put('/admin/users/{user}/update', [AdminController::class, 'update']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy']);

    Route::get('/master-data/dosen', [DosenController::class, 'index']);
    Route::get('/master-data/dosen/create', [DosenController::class, 'create']);
    Route::post('/master-data/dosen', [DosenController::class, 'store']);
    Route::get('/master-data/dosen/{dosen}/show', [DosenController::class, 'show']);
    Route::get('/master-data/dosen/{dosen}/edit', [DosenController::class, 'edit']);
    Route::put('/master-data/dosen/{dosen}/update', [DosenController::class, 'update']);
    Route::delete('/master-data/dosen/{dosen}', [DosenController::class, 'destroy']);
});

Route::get('/my-literatur', function () {
    $literatur =  Literatur::with('user', 'kontributor.user')->where('user_id', auth()->id())->get();
    return  $literatur;
});

Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect('/login');
});
