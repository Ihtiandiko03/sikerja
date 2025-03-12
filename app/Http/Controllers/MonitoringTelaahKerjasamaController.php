<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Telaah;
use App\Models\TelaahUnitKerja;
use Illuminate\Support\Facades\Crypt;

class MonitoringTelaahKerjasamaController extends Controller
{
  public function index()
  {
    $pengajuan = Telaah::all();

    return view('monitoring_telaah.index', compact('pengajuan'));
  }

  public function show($encryptedId)
  {
    $id = Crypt::decrypt($encryptedId);
    $telaah = Telaah::find($id);
    $unitKerja = TelaahUnitKerja::where('id_telaah', $id)->get();

    return view('monitoring_telaah.show', compact('telaah', 'unitKerja'));

    dd($telaah, $unitKerja);
  }
}
