<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use App\Models\BentukKegiatan;
use App\Models\KerjasamaMitra;
use App\Models\KlasifikasiMitra;
use App\Models\KerjasamaUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class RepositoryKerjasamaController extends Controller
{
  public function index(Request $request)
  {
      if ($request->ajax()) {
          $data = Kerjasama::leftJoin('kerjasama_mitra as ksm', 'ksm.id_kerjasama', '=', 'kerjasama.id')
              ->leftJoin('klasifikasi_mitra as kmtr', 'kmtr.id', '=', 'ksm.klasifikasi_mitra')
              ->leftJoin('bentuk_kegiatan as bk', 'bk.id', '=', 'kerjasama.bentuk_kegiatan')
              ->select(
                  'kerjasama.*',
                  DB::raw("GROUP_CONCAT(ksm.nama_instansi_mitra ORDER BY ksm.id SEPARATOR ', ') as list_mitra"),
                  DB::raw("GROUP_CONCAT(kmtr.klasifikasi_mitra ORDER BY ksm.id SEPARATOR ', ') as list_klasifikasi_mitra"),
                  'bk.bentuk_kegiatan as bentuk_kegiatan_desc'
              );

          // Filter sesuai role
          if (Session::get('role_kerja') == 'user') {
              // $data->where('kerjasama.created_by', Session::get('id'));
              $data->where('kerjasama.unit_kerja_inisiator', Session::get('id_unit'));
          }

          // Filter tambahan
          if ($request->jenis_kerja_sama) {
              $data->where('kerjasama.jenis_kerjasama', $request->jenis_kerja_sama);
          }

          if ($request->jenis_perjanjian) {
              $data->where('kerjasama.jenis_perjanjian', $request->jenis_perjanjian);
          }

          if ($request->status_kerjasama) {
              $data->where('kerjasama.status_kerjasama', $request->status_kerjasama);
          }

          $data->groupBy('kerjasama.id', 'bk.bentuk_kegiatan');
          $data->orderBy('kerjasama.created_at', 'desc');

          return DataTables::of($data)
              ->addIndexColumn()
              // Tambah kolom nama_unit dari koneksi db_simpeg
              ->addColumn('nama_unit', function ($row) {
                  return DB::connection('db_simpeg')
                      ->table('tb_unit')
                      ->where('kd_unit', $row->unit_kerja_inisiator)
                      ->value('nama_unit') ?? '-';
              })
              ->addColumn('status', function ($row) {
                  if ($row->status_kerjasama === 'AKTIF') {
                      $bg_color = 'bg-label-success';
                  } elseif ($row->status_kerjasama === 'KADALUARSA') {
                      $bg_color = 'bg-label-danger';
                  } else {
                      $bg_color = 'bg-label-info';
                  }
                  return '<span class="badge ' . $bg_color . '">' . $row->status_kerjasama . '</span>';
              })
              ->addColumn('action', function ($row) {
                  $id = Crypt::encrypt($row->id);
                  return '
                      <a href="' . route('repository-kerja-sama.show', $id) . '" 
                        class="btn btn-sm btn-icon btn-outline-primary">
                        <span class="icon-base bx bx-show-alt icon-md"></span></a>
                      <a href="javascript:;" 
                        class="btn btn-sm btn-icon btn-outline-danger ms-2 btn-delete" 
                        data-id="' . $id . '" 
                        data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <span class="icon-base bx bx-trash-alt icon-md"></span></a>
                  ';
              })
              ->rawColumns(['action', 'status'])
              ->make(true);
      }

      return view('repository_kerjasama.index');
  }

  public function create()
  {
    $unit = DB::connection('db_simpeg')
          ->table('tb_unit')
          ->select('kd_unit', 'nama_unit')
          ->get();

    $klasifikasi_mitra = KlasifikasiMitra::all();
    $bentuk_kegiatan = BentukKegiatan::all();
    return view('repository_kerjasama.create', compact('unit', 'klasifikasi_mitra', 'bentuk_kegiatan'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'unit_kerja_inisiator' => 'required',
      'status_kerjasama' => 'required',
      'bentuk_kegiatan' => 'required',
      'nomor_kerjasama' => 'required',
      'jenis_kerja_sama' => 'required',
      'jenis_perjanjian' => 'required',
      'judul_kerja_sama' => 'required',
      'masa_berlaku_tmt' => 'required',
      'masa_berlaku_tat' => 'required',
      'dokumen_kerjasama' => 'required|file|mimes:pdf|max:10240',

      'klasifikasi_mitra' => 'required|array',
      'klasifikasi_mitra.*' => 'required|string',
      'nama_instansi_mitra' => 'required|array',
      'nama_instansi_mitra.*' => 'required|string',
      'alamat_instansi_mitra' => 'required|array',
      'alamat_instansi_mitra.*' => 'required|string',
      'penandatangan_nama_mitra' => 'required|array',
      'penandatangan_nama_mitra.*' => 'required|string',
      'penandatangan_jabatan_mitra' => 'required|array',
      'penandatangan_jabatan_mitra.*' => 'required|string',
      'penanggungjawab_nama_mitra' => 'required|array',
      'penanggungjawab_nama_mitra.*' => 'required|string',
      'penanggungjawab_jabatan_mitra' => 'required|array',
      'penanggungjawab_jabatan_mitra.*' => 'required|string',

      'unit_kerja' => 'required|array',
      'unit_kerja.*' => 'required|string',
      'penandatangan_nama_unit_kerja' => 'required|array',
      'penandatangan_nama_unit_kerja.*' => 'required|string',
      'jabatan_penandatangan_nama_unit_kerja' => 'required|array',
      'jabatan_penandatangan_nama_unit_kerja.*' => 'required|string',
      'penanggungjawab_nama_unit_kerja' => 'required|array',
      'penanggungjawab_nama_unit_kerja.*' => 'required|string',
      'jabatan_penanggungjawab_nama_unit_kerja' => 'required|array',
      'jabatan_penanggungjawab_nama_unit_kerja.*' => 'required|string',
    ]);

    DB::beginTransaction();

    try {
      // Simpan File
      $dokumenKerjasamaPath = $request->file('dokumen_kerjasama')->store('dokumen_kerjasama', 'public');

      $kerjasama = new Kerjasama();
      $kerjasama->unit_kerja_inisiator = $request->unit_kerja_inisiator;
      $kerjasama->bentuk_kegiatan = $request->bentuk_kegiatan;
      $kerjasama->nomor_kerjasama = $request->nomor_kerjasama;
      $kerjasama->jenis_kerjasama = $request->jenis_kerja_sama;
      $kerjasama->jenis_perjanjian = $request->jenis_perjanjian;
      $kerjasama->judul_kerjasama = $request->judul_kerja_sama;
      $kerjasama->masa_berlaku_tmt = $request->masa_berlaku_tmt;
      $kerjasama->masa_berlaku_tat = $request->masa_berlaku_tat;
      $kerjasama->status_kerjasama = $request->status_kerjasama;
      $kerjasama->dokumen_kerjasama = $dokumenKerjasamaPath;
      $kerjasama->created_by = Session::get('id');
      $kerjasama->save();

      foreach ($validated['klasifikasi_mitra'] as $index => $mitra) {
        KerjasamaMitra::create([
          'id_kerjasama' => $kerjasama->id,
          'klasifikasi_mitra' => $mitra,
          'nama_instansi_mitra' => $validated['nama_instansi_mitra'][$index],
          'alamat_instansi_mitra' => $validated['alamat_instansi_mitra'][$index],
          'penandatangan_nama_mitra' => $validated['penandatangan_nama_mitra'][$index],
          'jabatan_penandatangan_mitra' => $validated['penandatangan_jabatan_mitra'][$index],
          'penanggungjawab_nama_mitra' => $validated['penanggungjawab_nama_mitra'][$index],
          'jabatan_penanggungjawab_mitra' => $validated['penanggungjawab_jabatan_mitra'][$index],
        ]);
      }

      foreach ($validated['unit_kerja'] as $index => $unit_kerja) {
        KerjasamaUnitKerja::create([
          'id_kerjasama' => $kerjasama->id,
          'unit_kerja' => $unit_kerja,
          'penandatangan_nama_unit_kerja' => $validated['penandatangan_nama_unit_kerja'][$index],
          'jabatan_penandatangan_unit_kerja' => $validated['jabatan_penandatangan_nama_unit_kerja'][$index],
          'penanggungjawab_nama_unit_kerja' => $validated['penanggungjawab_nama_unit_kerja'][$index],
          'jabatan_penanggungjawab_unit_kerja' => $validated['jabatan_penanggungjawab_nama_unit_kerja'][$index],
        ]);
      }

      DB::commit();

      return redirect()
        ->route('repository-kerja-sama.index')
        ->with('success', 'Kerjasama berhasil ditambahkan');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->route('repository-kerja-sama.create')
        ->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function show($encryptedId)
  {
      $id = Crypt::decrypt($encryptedId);

      $query = Kerjasama::join('bentuk_kegiatan as bk', 'bk.id', '=', 'kerjasama.bentuk_kegiatan')
          ->selectRaw('kerjasama.*, bk.bentuk_kegiatan as bentuk_kegiatan_desc');

      if (Session::get('role_kerja') == 'admin') {
          $kerjasama = $query->findOrFail($id);
      } elseif (Session::get('role_kerja') == 'user') {
          $kerjasama = $query->where('kerjasama.unit_kerja_inisiator', Session::get('id_unit'))->findOrFail($id);
      } else {
          abort(403, 'Unauthorized page.');
      }

      $namaUnit = DB::connection('db_simpeg')
          ->table('tb_unit')
          ->where('kd_unit', $kerjasama->unit_kerja_inisiator)
          ->value('nama_unit');

      $kerjasama->nama_unit = $namaUnit ?? '-';

      $unitKerja = KerjasamaUnitKerja::where('id_kerjasama', $id)->get();

      $kd_units = $unitKerja->pluck('unit_kerja');

      $unitNames = DB::connection('db_simpeg')
          ->table('tb_unit')
          ->whereIn('kd_unit', $kd_units)
          ->pluck('nama_unit', 'kd_unit');

      $unitKerja->transform(function ($item) use ($unitNames) {
          $item->nama_unit = $unitNames[$item->unit_kerja] ?? '-';
          return $item;
      });

      $mitra = KerjasamaMitra::join('klasifikasi_mitra as km', 'km.id', '=', 'kerjasama_mitra.klasifikasi_mitra')
          ->selectRaw('kerjasama_mitra.*, km.klasifikasi_mitra as klasifikasi_mitra_desc')
          ->where('id_kerjasama', $id)
          ->get();

      return view('repository_kerjasama.show', compact('kerjasama', 'unitKerja', 'mitra'));
  }

  public function edit($encryptedId)
  {
  }

  public function update($encryptedId)
  {
  }

  public function delete($encryptedId)
  {
    $id = Crypt::decrypt($encryptedId);

    if (Session::get('role_kerja') == 'user') {
      $kerjasama = Kerjasama::where('created_by', Session::get('id'))->findOrFail($id);
      $kerjasama->delete();

      return redirect()
        ->route('repository-kerja-sama.index')
        ->with('success', 'Kerjasama berhasil dihapus');
    } elseif (Session::get('role_kerja') == 'admin') {
      $kerjasama = Kerjasama::findOrFail($id);
      $kerjasama->delete();

      return redirect()
        ->route('repository-kerja-sama.index')
        ->with('success', 'Kerjasama berhasil dihapus');
    } else {
      abort(403, 'Unauthorized page.');
    }
  }
}
