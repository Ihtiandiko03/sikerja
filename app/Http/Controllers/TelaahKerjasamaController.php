<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Telaah;
use App\Models\TelaahUnitKerja;

class TelaahKerjasamaController extends Controller
{
  public function index()
  {
    $pengajuan = Telaah::all();

    return view('pengajuan_telaah.index', compact('pengajuan'));
  }

  public function create()
  {
    return view('pengajuan_telaah.create');
  }

  public function store(Request $request)
  {
    // Validasi Input
    $validated = $request->validate([
      'unit_kerja_inisiator' => 'required',
      'bentuk_kegiatan' => 'required',
      'jenis_kerja_sama' => 'required',
      'jenis_perjanjian' => 'required',
      'judul_kerja_sama' => 'required',
      'dokumen_pengantar' => 'required|file|mimes:pdf',
      'dokumen_telaah' => 'required|file|mimes:doc,dok,docx,pdf',

      'klasifikasi_mitra' => 'required',
      'nama_instansi_mitra' => 'required',
      'alamat_instansi_mitra' => 'required',
      'nama_mitra_penandatangan' => 'required',
      'nama_mitra_penanggungjawab' => 'required',

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
      'pic_nama_unit_kerja' => 'required|array',
      'pic_nama_unit_kerja.*' => 'required|string',
      'contact_person' => 'required|array',
      'contact_person.*' => 'required|string',
    ]);

    DB::beginTransaction();

    try {
      // Simpan File
      $dokumenPengantarPath = $request->file('dokumen_pengantar')->store('dokumen_pengantar', 'public');
      $dokumenTelaahPath = $request->file('dokumen_telaah')->store('dokumen_telaah', 'public');

      // Simpan Data Utama ke Tabel Telaah
      $upload = Telaah::create([
        'unit_kerja_inisiator' => $validated['unit_kerja_inisiator'],
        'bentuk_kegiatan' => $validated['bentuk_kegiatan'],
        'jenis_kerja_sama' => $validated['jenis_kerja_sama'],
        'jenis_perjanjian' => $validated['jenis_perjanjian'],
        'judul_kerja_sama' => $validated['judul_kerja_sama'],
        'dokumen_pengantar' => $dokumenPengantarPath,
        'dokumen_telaah' => $dokumenTelaahPath,
        'klasifikasi_mitra' => $validated['klasifikasi_mitra'],
        'nama_instansi_mitra' => $validated['nama_instansi_mitra'],
        'alamat_instansi_mitra' => $validated['alamat_instansi_mitra'],
        'nama_mitra_penandatangan' => $validated['nama_mitra_penandatangan'],
        'nama_mitra_penanggungjawab' => $validated['nama_mitra_penanggungjawab'],
        'tanggal_masuk_bkmp' => now(),
      ]);

      // Jika Data Telaah Berhasil Disimpan
      if ($upload) {
        foreach ($validated['unit_kerja'] as $index => $unitKerja) {
          TelaahUnitKerja::create([
            'id_telaah' => $upload->id,
            'unit_kerja' => $unitKerja,
            'penandatangan_nama_unit_kerja' => $validated['penandatangan_nama_unit_kerja'][$index],
            'jabatan_penandatangan_nama_unit_kerja' => $validated['jabatan_penandatangan_nama_unit_kerja'][$index],
            'penanggungjawab_nama_unit_kerja' => $validated['penanggungjawab_nama_unit_kerja'][$index],
            'jabatan_penanggungjawab_nama_unit_kerja' => $validated['jabatan_penanggungjawab_nama_unit_kerja'][$index],
            'pic_nama_unit_kerja' => $validated['pic_nama_unit_kerja'][$index],
            'contact_person' => $validated['contact_person'][$index],
          ]);
        }

        DB::commit();

        return redirect()
          ->route('telaah-kerja-sama')
          ->with('success', 'Pengajuan Telaah berhasil ditambahkan.');
      }

      throw new \Exception('Gagal menyimpan data telaah.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->route('telaah-kerja-sama')
        ->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function edit($id)
  {
    $telaah = Telaah::find(decrypt($id));
    $unitKerja = TelaahUnitKerja::where('id_telaah', $telaah->id)->get();

    return view('pengajuan_telaah.revisi', compact('telaah', 'unitKerja'));
  }

  public function update(Request $request, $id)
  {
    DB::beginTransaction();

    try {
      $telaah = Telaah::find(decrypt($id));

      if ($request->hasFile('dokumen_pengantar')) {
        $dokumenPengantarPath = $request->file('dokumen_pengantar')->store('dokumen_pengantar', 'public');
        $telaah->dokumen_pengantar = $dokumenPengantarPath;
      }

      if ($request->hasFile('dokumen_telaah')) {
        $dokumenTelaahPath = $request->file('dokumen_telaah')->store('dokumen_telaah', 'public');
        $telaah->dokumen_telaah = $dokumenTelaahPath;
      }

      $telaah->unit_kerja_inisiator = $validated['unit_kerja_inisiator'];
      $telaah->bentuk_kegiatan = $validated['bentuk_kegiatan'];
      $telaah->jenis_kerja_sama = $validated['jenis_kerja_sama'];
      $telaah->jenis_perjanjian = $validated['jenis_perjanjian'];
      $telaah->judul_kerja_sama = $validated['judul_kerja_sama'];
      $telaah->klasifikasi_mitra = $validated['klasifikasi_mitra'];
      $telaah->nama_instansi_mitra = $validated['nama_instansi_mitra'];
      $telaah->alamat_instansi_mitra = $validated['alamat_instansi_mitra'];
      $telaah->nama_mitra_penandatangan = $validated['nama_mitra_penandatangan'];
      $telaah->nama_mitra_penanggungjawab = $validated['nama_mitra_penanggungjawab'];
      $telaah->status_telaah = 'Diajukan';

      dd($telaah->unit_kerja_inisiator);

      $telaah->save();

      TelaahUnitKerja::where('id_telaah', $telaah->id)->delete();

      foreach ($validated['unit_kerja'] as $index => $unitKerja) {
        TelaahUnitKerja::create([
          'id_telaah' => $telaah->id,
          'unit_kerja' => $unitKerja,
          'penandatangan_nama_unit_kerja' => $validated['penandatangan_nama_unit_kerja'][$index],
          'jabatan_penandatangan_nama_unit_kerja' => $validated['jabatan_penandatangan_nama_unit_kerja'][$index],
          'penanggungjawab_nama_unit_kerja' => $validated['penanggungjawab_nama_unit_kerja'][$index],
          'jabatan_penanggungjawab_nama_unit_kerja' => $validated['jabatan_penanggungjawab_nama_unit_kerja'][$index],
          'pic_nama_unit_kerja' => $validated['pic_nama_unit_kerja'][$index],
          'contact_person' => $validated['contact_person'][$index],
        ]);
      }

      DB::commit();

      return redirect()
        ->route('telaah-kerja-sama')
        ->with('success', 'Revisi Telaah berhasil disimpan.');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()
        ->route('telaah-kerja-sama')
        ->withErrors(['error' => $e->getMessage()]);
    }
  }
}
