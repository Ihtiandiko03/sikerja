@extends('layouts/contentNavbarLayout')

@section('title', 'Revisi Telaah Kerjasama')

@section('page-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<span class="badge bg-label-primary mb-4 p-3 d-flex align-items-center"><i class="icon-base bx bx-file icon-sm me-2"></i> Form Revisi Telaah Kerja Sama</span>

<div class="row">
  <form method="POST" action="{{ route('telaah-kerja-sama.revisi', request()->segment(2)) }}" enctype="multipart/form-data">
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
              <select name="unit_kerja_inisiator" id="unit_kerja_inisiator" class="form-select select2" required>
                <option value="" selected disabled>Pilih Unit</option>
                @foreach ($unit as $u)
                    <option value="{{ $u->kd_unit }}" @selected($telaah->unit_kerja_inisiator == $u->kd_unit)>{{ $u->nama_unit }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
            <div class="input-group input-group-merge">
              <span id="bentuk_kegiatan2" class="input-group-text"><i class="bx bx-run"></i></span>
                <select name="bentuk_kegiatan" id="bentuk_kegiatan" class="form-select" required>
                  <option value="" disabled>Pilih Bentuk Kegiatan</option>
                  @foreach ($bentuk_kegiatan as $b)
                    <option value="{{ $b->id }}" @selected($telaah->bentuk_kegiatan == $b->id)>{{ $b->bentuk_kegiatan }}</option>
                  @endforeach
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
            <div class="input-group input-group-merge">
              <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                <select name="jenis_kerja_sama" id="jenis_kerja_sama" class="form-select" required>
                    <option value="">Pilih Jenis Kerja Sama</option>
                    <option value="Kerjasama Dalam Negeri" @selected($telaah->jenis_kerja_sama == 'Kerjasama Dalam Negeri')>Kerjasama Dalam Negeri</option>
                    <option value="Kerjasama Luar Negeri" @selected($telaah->jenis_kerja_sama == 'Kerjasama Luar Negeri')>Kerjasama Luar Negeri</option>
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jenis_perjanjian">Jenis Perjanjian</label>
            <div class="input-group input-group-merge">
              <span id="jenis_perjanjian2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                <select name="jenis_perjanjian" id="jenis_perjanjian" class="form-select" required>
                    <option value="">Pilih Jenis Perjanjian</option>
                    <option value="Memorandum of Understanding (MOU)" @selected($telaah->jenis_perjanjian == 'Memorandum of Understanding (MOU)')>Memorandum of Understanding (MOU)</option>
                    <option value="Memorandum of Agreement (MOA)" @selected($telaah->jenis_perjanjian == 'Memorandum of Agreement (MOA)')>Memorandum of Agreement (MOA)</option>
                    <option value="Implementation Arrangement (IA)" @selected($telaah->jenis_perjanjian == 'Implementation Arrangement (IA)')>Implementation Arrangement (IA)</option>
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
            <label class="form-label" for="dokumen_pengantar">Dokumen Pengantar (Jika ingin diganti) <a href="{{ Storage::url($telaah->dokumen_pengantar) }}" target="_blank">File Lama</a></label>
            <div class="input-group input-group-merge">
              <input type="file" class="form-control" name="dokumen_pengantar" id="dokumen_pengantar" accept=".pdf" />
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="dokumen_telaah">Dokumen Telaah (Jika ingin diganti) <a href="{{ Storage::url($telaah->dokumen_telaah) }}" target="_blank">File Lama</a></label>
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
              <select name="klasifikasi_mitra" id="klasifikasi_mitra" class="form-select" required>
                <option value="" disabled>Pilih Bentuk Kegiatan</option>
                @foreach ($klasifikasi_mitra as $k)
                  <option value="{{ $k->id }}" @selected($telaah->klasifikasi_mitra == $k->id)>{{ $k->klasifikasi_mitra }}</option>
                @endforeach
              </select>
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

    <div id="containerFormUnit">
      @foreach ($unitKerja as $uk)
        <div class="col-xl unitKerjaContainer">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Unit Kerja</h5>
              <button type="button" class="btn btn-sm btn-danger remove-btn">
                Hapus
              </button>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <label class="form-label" for="unit_kerja">Unit Kerja</label>
                <div class="input-group input-group-merge">
                  <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                  <select name="unit_kerja[]" class="form-select select2" required>
                    <option value="" selected disabled>Pilih Unit</option>
                    @foreach ($unit as $u)
                      <option value="{{ $u->kd_unit }}" @selected($uk->unit_kerja == $u->kd_unit)>{{ $u->nama_unit }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-7">
                  <label class="form-label" for="penandatangan_nama_unit_kerja">Nama Pejabat Penandatangan</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input type="text" class="form-control" name="penandatangan_nama_unit_kerja[]" placeholder="Tulis Pejabat Penandatangan"  value="{{ $uk->penandatangan_nama_unit_kerja }}" required />
                  </div>
                </div>
                <div class="col-md-5">
                  <label class="form-label" for="jabatan_penandatangan_nama_unit_kerja">Jabatan</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input type="text" class="form-control" name="jabatan_penandatangan_nama_unit_kerja[]" placeholder="Tulis Jabatan Penandatangan"  value="{{ $uk->jabatan_penandatangan_nama_unit_kerja }}" required />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-7">
                  <label class="form-label" for="penanggungjawab_nama_unit_kerja">Nama Penanggungjawab</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input type="text" class="form-control" name="penanggungjawab_nama_unit_kerja[]" placeholder="Tulis Nama Penanggung Jawab"  value="{{ $uk->penanggungjawab_nama_unit_kerja }}" required />
                  </div>
                </div>
                <div class="col-md-5">
                  <label class="form-label" for="jabatan_penanggungjawab_nama_unit_kerja">Jabatan</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                    <input type="text" class="form-control" name="jabatan_penanggungjawab_nama_unit_kerja[]" placeholder="Tulis Nama Penanggung Jawab"  value="{{ $uk->jabatan_penanggungjawab_nama_unit_kerja }}" required />
                  </div>
                </div>
              </div>
              <div class="row mb-3">
                <div class="col-md-7">
                  <label class="form-label" for="pic_nama_unit_kerja">Nama PIC</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                    <input type="text" class="form-control" name="pic_nama_unit_kerja[]" placeholder="Tulis Nama PIC"  value="{{ $uk->pic_nama_unit_kerja }}" required />
                  </div>
                </div>
                <div class="col-md-5">
                  <label class="form-label" for="contact_person">Contact Person</label>
                  <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-phone-call"></i></span>
                    <input type="text" class="form-control" name="contact_person[]" placeholder="Tulis Contact Person"  value="{{ $uk->contact_person }}" required />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="col-xl mb-5">
      <button type="button" id="tambahData" class="btn btn-secondary btn-sm">Tambah Unit</button>
    </div>

    <div class="col-xl text-center">
      <button type="submit" class="btn btn-primary">Simpan Revisi</button>
    </div>
  </form>
</div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });

        let formIndex = 1;
        $('#tambahData').click(function () {
            let newForm = $('.unitKerjaContainer').first().clone();
            newForm.find('input').val('');
            newForm.find('select').val('').change();
            newForm.find('.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').removeAttr('aria-hidden');

            newForm.find('.select2').next('.select2-container').remove(); 

            $('#containerFormUnit').append(newForm);
            newForm.find('.select2').select2({
              theme: 'bootstrap-5',
            });
        });

        $(document).on('click', '.remove-btn', function () {
          $(this).closest('.unitKerjaContainer').remove();
        });
    });
</script>
@endsection