<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Literatur;
use App\Models\Prodi;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $jenis = Jenis::all();
        $prodis = Prodi::all();
        $literaturs = Literatur::search($request->term ?? null)->query(function ($query) {
            $query->where('status' , 'diterima'); 
            $query->join('users', 'literatur.user_id', 'users.id')
                ->select(['literatur.judul', 'literatur.id', 'users.id AS uid', 'users.prodi_id AS prodi', 'literatur.created_at', 'literatur.penulis_kontributor', 'literatur.jenis_id', 'literatur.keyword', 'literatur.penerbit', 'users.nama', 'literatur.abstrak']);
        });
      
     
        if ($request->jenis) {
            $literaturs->whereIn('jenis_id', $request->jenis);
        }

        if ($request->prodi) {
            $literaturs->whereIn('prodi_id', $request->prodi);
        }

        $literaturs = $literaturs->paginate(25);

        return view('search', compact('literaturs', 'jenis', 'prodis'));
    }
}
