<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Telaah;
use Illuminate\Http\Request;
use App\Models\RiwayatTelaah;
use App\Models\TelaahUnitKerja;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class MonitoringTelaahKerjasamaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Telaah::selectRaw('telaah.*, u.nama_unit')
          ->join('db_simpeg.tb_unit as u', 'u.kd_unit', '=', 'telaah.unit_kerja_inisiator');
      
      if (Session::get('role_kerja') == 'user') {
        $data->where('telaah.created_by', Session::get('id'));
      }

      if ($request->jenis_kerja_sama) {
        $data->where('telaah.jenis_kerja_sama', $request->jenis_kerja_sama);
      }

      if ($request->jenis_perjanjian) {
        $data->where('telaah.jenis_perjanjian', $request->jenis_perjanjian);
      }

      if ($request->status_telaah) {
        $data->where('telaah.status_telaah', $request->status_telaah);
      }

      $data->orderBy('telaah.created_at', 'desc');

      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="'.route('monitoring-telaah-kerja-sama.show', Crypt::encrypt($row->id)).'" class="btn btn-sm btn-primary">Detail</a>';
            return $btn;
        })
        ->addColumn('status', function($row){
            if ($row->status_telaah === 'Selesai') {
              $bg_color = 'bg-label-success';
            } elseif ($row->status_telaah === 'Ditolak') {
              $bg_color = 'bg-label-danger';
            } else {
              $bg_color = 'bg-label-info';
            }
            $btn = '<span class="badge '.$bg_color.'">'.$row->status_telaah.'</span>';
            return $btn;
        })
        ->rawColumns(['action', 'status'])
        ->make(true);
    }

    return view('monitoring_telaah.index');
  }

  public function show($encryptedId)
  {
    $id = Crypt::decrypt($encryptedId);

    if (Session::get('role_kerja') == 'admin') {
      $telaah = Telaah::selectRaw('telaah.*, u.nama_unit, km.klasifikasi_mitra as klasifikasi_mitra_desc, bk.bentuk_kegiatan as bentuk_kegiatan_desc')
        ->join('db_simpeg.tb_unit as u', 'u.kd_unit', '=', 'telaah.unit_kerja_inisiator')
        ->join('klasifikasi_mitra as km', 'km.id', '=', 'telaah.klasifikasi_mitra')
        ->join('bentuk_kegiatan as bk', 'bk.id', '=', 'telaah.bentuk_kegiatan')
        ->findOrFail($id);
    } elseif(Session::get('role_kerja') == 'user') {
      $telaah = Telaah::selectRaw('telaah.*, u.nama_unit, km.klasifikasi_mitra as klasifikasi_mitra_desc, bk.bentuk_kegiatan as bentuk_kegiatan_desc')
        ->where('telaah.created_by', Session::get('id'))
        ->join('db_simpeg.tb_unit as u', 'u.kd_unit', '=', 'telaah.unit_kerja_inisiator')
        ->join('klasifikasi_mitra as km', 'km.id', '=', 'telaah.klasifikasi_mitra')
        ->join('bentuk_kegiatan as bk', 'bk.id', '=', 'telaah.bentuk_kegiatan')
        ->findOrFail($id);
    } else {
      abort(403, 'Unauthorized page.');
    }

    $unitKerja = TelaahUnitKerja::selectRaw('telaah_unit_kerja.*, u.nama_unit')      
      ->join('db_simpeg.tb_unit as u', 'u.kd_unit', '=', 'telaah_unit_kerja.unit_kerja')
      ->where('id_telaah', $id)
      ->get();

    $aktivitas = RiwayatTelaah::selectRaw('riwayat_telaah.*, p.nama_pegawai')
      ->join('db_simpeg.tb_pegawai as p', 'p.id_pegawai', '=', 'riwayat_telaah.created_by')
      ->where('telaah_id', $id)
      ->orderBy('riwayat_telaah.created_at', 'desc')
      ->get();

    return view('monitoring_telaah.show', compact('telaah', 'unitKerja', 'aktivitas'));
  }
}
