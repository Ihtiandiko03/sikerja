<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kerjasama;
use App\Models\KerjasamaMitra;
use App\Models\KerjasamaUnitKerja;

class RepositoryKerjasamaController extends Controller
{
  public function index()
  {
    $kerjasama = Kerjasama::leftJoin('kerjasama_mitra', 'kerjasama.id', '=', 'kerjasama_mitra.id_kerjasama')
      ->select('kerjasama.*', 'kerjasama_mitra.*')
      ->get();

    return view('repository_kerjasama.index', compact('kerjasama'));
  }

  public function create()
  {
    return view('repository_kerjasama.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'unit_kerja_inisiator' => 'required',
      'bentuk_kegiatan' => 'required',
      'nomor_kerjasama' => 'required',
      'jenis_kerja_sama' => 'required',
      'jenis_perjanjian' => 'required',
      'judul_kerja_sama' => 'required',
      'masa_berlaku_tmt' => 'required',
      'masa_berlaku_tat' => 'required',
      'dokumen_kerjasama' => 'required',

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
      $kerjasama->dokumen_kerjasama = $dokumenKerjasamaPath;
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
}
