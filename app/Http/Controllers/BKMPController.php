<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Telaah;

class BKMPController extends Controller
{
  public function validasiTelaah()
  {
    // dd('BKMP');
    $statuses = ['Diajukan', 'Dalam Proses', 'Selesai', 'Ditolak'];
    $pengajuan = Telaah::all();
    return view('bkmp.validasitelaah', compact('pengajuan', 'statuses'));
  }

  public function storeValidasiTelaah(Request $request)
  {
    DB::beginTransaction();

    try {
      $telaah = Telaah::find(decrypt($request->id));

      if ($request->status == '1') {
        $telaah->status_telaah = 'Diterima';
        $telaah->tanggal_keluar_bkmp = date('Y-m-d');
      } else {
        $telaah->status_telaah = 'Ditolak';
      }

      $telaah->ctt_bkmp = $request->catatan;

      $telaah->save();

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->route('bkmp.validasitelaah')
        ->withErrors(['error' => $e->getMessage()]);
    }

    return redirect()->route('bkmp.validasitelaah');
  }
}
