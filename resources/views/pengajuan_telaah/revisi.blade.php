@extends('layouts/contentNavbarLayout')

@section('title', 'Revisi Telaah Kerjasama')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Telaah/</span> Revisi Telaah Kerjasama</h4>

<div class="row">
  <form method="POST" action="{{ route('telaah-kerja-sama.update', encrypt($telaah->id)) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Revisi Telaah Kerjasama</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label" for="unit_kerja_inisiator">Unit Kerja / Inisiator</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-group"></i></span>
              <input type="text" class="form-control" name="unit_kerja_inisiator" id="unit_kerja_inisiator" value="{{ $telaah->unit_kerja_inisiator }}" required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
            <div class="input-group input-group-merge">
              <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                <select name="jenis_kerja_sama" id="jenis_kerja_sama" class="form-select" required>
                    <option value="{{ $telaah->jenis_kerja_sama }}" selected>{{ $telaah->jenis_kerja_sama }}</option>
                    <option value="">Pilih Jenis Kegiatan</option>
                    <option value="Kerjasama Dalam Negeri">Kerjasama Dalam Negeri</option>
                    <option value="Kerjasama Luar Negeri">Kerjasama Luar Negeri</option>
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jenis_perjanjian">Jenis Perjanjian</label>
            <div class="input-group input-group-merge">
              <span id="jenis_perjanjian2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                <select name="jenis_perjanjian" id="jenis_perjanjian" class="form-select" required>
                    <option value="{{ $telaah->jenis_perjanjian }}" selected>{{ $telaah->jenis_perjanjian }}</option>
                    <option value="">Pilih Jenis Perjanjian</option>
                    <option value="Memorandum of Understanding (MOU)">Memorandum of Understanding (MOU)</option>
                    <option value="Agreement On Academic (MOA)">Agreement On Academic (MOA)</option>
                    <option value="Implementation of Arrangement (IA)">Implementation of Arrangement (IA)</option>
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="judul_kerja_sama">Judul Kerjasama</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
              <input type="text" class="form-control" name="judul_kerja_sama" id="judul_kerja_sama" value="{{ $telaah->judul_kerja_sama }}" required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="dokumen_pengantar">Dokumen Pengantar</label>
            <div class="input-group input-group-merge">
              <input type="file" class="form-control" name="dokumen_pengantar" id="dokumen_pengantar" accept=".pdf" />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="dokumen_telaah">Dokumen Telaah</label>
            <div class="input-group input-group-merge">
              <input type="file" class="form-control" name="dokumen_telaah" id="dokumen_telaah" accept=".doc,.docx,.pdf" />
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Mitra Kerja Sama</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label" for="klasifikasi_mitra">Klasifikasi Mitra</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-outline"></i></span>
              <input type="text" class="form-control" name="klasifikasi_mitra" id="klasifikasi_mitra" value="{{ $telaah->klasifikasi_mitra }}" required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nama_instansi_mitra">Nama Instansi</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-buildings"></i></span>
              <input type="text" class="form-control" name="nama_instansi_mitra" id="nama_instansi_mitra" value="{{ $telaah->nama_instansi_mitra }}" required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="alamat_instansi_mitra">Alamat Instansi</label>
            <div class="input-group input-group-merge">
              <textarea name="alamat_instansi_mitra" id="alamat_instansi_mitra" class="form-control" cols="10" rows="3" required>{{ $telaah->alamat_instansi_mitra }}</textarea>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nama_mitra_penandatangan">Nama Pejabat Penandatangan</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="text" class="form-control" name="nama_mitra_penandatangan" id="nama_mitra_penandatangan" value="{{ $telaah->nama_mitra_penandatangan }}" required />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="nama_mitra_penanggungjawab">Nama Penanggungjawab</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-user"></i></span>
              <input type="text" class="form-control" name="nama_mitra_penanggungjawab" id="nama_mitra_penanggungjawab" value="{{ $telaah->nama_mitra_penanggungjawab }}" required />
            </div>
          </div>
        </div>
      </div>
    </div>

    @foreach ($unitKerja as $uk)
      <div class="col-xl">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Unit Kerja</h5>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label class="form-label" for="unit_kerja">Unit Kerja</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                <input type="text" class="form-control" name="unit_kerja[]" value="{{ $uk->unit_kerja }}" required />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <label class="form-label" for="penandatangan_nama_unit_kerja">Nama Pejabat Penandatangan</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" class="form-control" name="penandatangan_nama_unit_kerja[]" value="{{ $uk->penandatangan_nama_unit_kerja }}" required />
                </div>
              </div>
              <div class="col-md-5">
                <label class="form-label" for="jabatan_penandatangan_nama_unit_kerja">Jabatan</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                  <input type="text" class="form-control" name="jabatan_penandatangan_nama_unit_kerja[]" value="{{ $uk->jabatan_penandatangan_nama_unit_kerja }}" required />
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <label class="form-label" for="penanggungjawab_nama_unit_kerja">Nama Penanggungjawab</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" class="form-control" name="penanggungjawab_nama_unit_kerja[]" value="{{ $uk->penanggungjawab_nama_unit_kerja }}" required />
                </div>
              </div>
              <div class="col-md-5">
                <label class="form-label" for="jabatan_penanggungjawab_nama_unit_kerja">Jabatan</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                  <input type="text" class="form-control" name="jabatan_penanggungjawab_nama_unit_kerja[]" value="{{ $uk->jabatan_penanggungjawab_nama_unit_kerja }}" required />
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-7">
                <label class="form-label" for="pic_nama_unit_kerja">Nama PIC</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                  <input type="text" class="form-control" name="pic_nama_unit_kerja[]" value="{{ $uk->pic_nama_unit_kerja }}" required />
                </div>
              </div>
              <div class="col-md-5">
                <label class="form-label" for="contact_person">Contact Person</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-phone-call"></i></span>
                  <input type="text" class="form-control" name="contact_person[]" value="{{ $uk->contact_person }}" required />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-xl text-center">
      <button type="submit" class="btn btn-primary">Simpan Revisi</button>
    </div>
  </form>
</div>
@endsection