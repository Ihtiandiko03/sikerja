<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Telaah;
use Illuminate\Http\Request;
use App\Models\RiwayatTelaah;
use App\Models\TelaahUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class MonitoringTelaahKerjasamaController extends Controller
{
  public function index(Request $request)
  {
    if ($request->ajax()) {
      $data = Telaah::query();

      if (Session::get('role_kerja') == 'user') {
        // $data->where('kerjasama.created_by', Session::get('id'));
        $data->where('telaah.unit_kerja_inisiator', Session::get('id_unit'));
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

      $units = DB::connection('db_simpeg')
        ->table('tb_unit')
        ->pluck('nama_unit', 'kd_unit');

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('nama_unit', function ($row) use ($units) {
          return $units[$row->unit_kerja_inisiator] ?? '-';
        })
        ->addColumn('action', function ($row) {
          $btn =
            '<a href="' .
            route('monitoring-telaah-kerja-sama.show', Crypt::encrypt($row->id)) .
            '" class="btn btn-sm btn-primary">Detail</a>';
          return $btn;
        })
        ->addColumn('status', function ($row) {
          if ($row->status_telaah === 'Selesai') {
            $bg_color = 'bg-label-success';
          } elseif ($row->status_telaah === 'Ditolak') {
            $bg_color = 'bg-label-danger';
          } else {
            $bg_color = 'bg-label-info';
          }
          return '<span class="badge ' . $bg_color . '">' . $row->status_telaah . '</span>';
        })
        ->rawColumns(['action', 'status'])
        ->make(true);
    }

    return view('monitoring_telaah.index');
  }

  public function show($encryptedId)
  {
    $id = Crypt::decrypt($encryptedId);

    $query = Telaah::query()
      ->join('klasifikasi_mitra as km', 'km.id', '=', 'telaah.klasifikasi_mitra')
      ->join('bentuk_kegiatan as bk', 'bk.id', '=', 'telaah.bentuk_kegiatan')
      ->selectRaw('telaah.*, km.klasifikasi_mitra as klasifikasi_mitra_desc, bk.bentuk_kegiatan as bentuk_kegiatan_desc');

    if (Session::get('role_kerja') == 'admin') {
      $telaah = $query->findOrFail($id);
    } elseif (Session::get('role_kerja') == 'user') {
      $telaah = $query
        ->where('telaah.unit_kerja_inisiator', Session::get('id_unit'))
        ->findOrFail($id);
    } else {
      abort(403, 'Unauthorized page.');
    }

    $unit = DB::connection('db_simpeg')
      ->table('tb_unit')
      ->where('kd_unit', $telaah->unit_kerja_inisiator)
      ->value('nama_unit');
    $telaah->nama_unit = $unit ?? '-';

    $unitKerja = TelaahUnitKerja::where('id_telaah', $id)->get();
    $kd_units = $unitKerja->pluck('unit_kerja');
    $nama_units = DB::connection('db_simpeg')
      ->table('tb_unit')
      ->whereIn('kd_unit', $kd_units)
      ->pluck('nama_unit', 'kd_unit');
    $unitKerja->transform(function ($item) use ($nama_units) {
      $item->nama_unit = $nama_units[$item->unit_kerja] ?? '-';
      return $item;
    });

    $aktivitas = RiwayatTelaah::where('telaah_id', $id)
      ->orderBy('riwayat_telaah.created_at', 'desc')
      ->get();

    $pegawai_ids = $aktivitas->pluck('created_by');
    $pegawai_nama = DB::connection('db_simpeg')
      ->table('tb_pegawai')
      ->whereIn('id_pegawai', $pegawai_ids)
      ->pluck('nama_pegawai', 'id_pegawai');

    $aktivitas->transform(function ($item) use ($pegawai_nama) {
      $item->nama_pegawai = $pegawai_nama[$item->created_by] ?? '-';
      return $item;
    });

    return view('monitoring_telaah.show', compact('telaah', 'unitKerja', 'aktivitas'));
  }
}
