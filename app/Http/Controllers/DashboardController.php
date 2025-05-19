<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BentukKegiatan;
use App\Models\KerjasamaMitra;
use App\Models\KlasifikasiMitra;
use App\Models\KerjasamaUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        
        $total_kerjasama_mou = DB::table('kerjasama')
            ->select(DB::raw('count(*) as total'))
            ->where('jenis_perjanjian', 'Memorandum of Understanding (MOU)')
            ->first();
        $total_kerjasama_moa = DB::table('kerjasama')
            ->select(DB::raw('count(*) as total'))
            ->where('jenis_perjanjian', 'Memorandum of Agreement (MOA)')
            ->first();
        $total_kerjasama_ia = DB::table('kerjasama')
            ->select(DB::raw('count(*) as total'))
            ->where('jenis_perjanjian', 'Implementation Arrangement (IA)')
            ->first();

        return view('dashboard.index', compact('total_kerjasama_mou', 'total_kerjasama_moa', 'total_kerjasama_ia'));
    }
}
