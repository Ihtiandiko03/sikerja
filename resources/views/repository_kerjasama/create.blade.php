@extends('layouts/contentNavbarLayout')

@section('title', 'Pengajuan Telaah')

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

<span class="badge bg-label-primary mb-4 p-3 d-flex align-items-center"><i class="icon-base bx bx-file icon-sm me-2"></i> Form Tambah Kerja Sama</span>

<div class="row">
  <form method="POST" action="{{ route('repository-kerja-sama.store') }}" id="form-create" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Buat Kerjasama</h5>
            </div>
            <div class="card-body">
                
                <div class="mb-3">
                    <label class="form-label" for="unit_kerja_inisiator">Unit Kerja / Inisiator</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-group"></i></span>
                        <select name="unit_kerja_inisiator" id="unit_kerja_inisiator" class="form-select select2" required>
                            <option value="" selected disabled>Pilih Unit</option>
                            @foreach ($unit as $u)
                                <option value="{{ $u->kd_unit }}">{{ $u->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-run"></i></span>
                        <select name="bentuk_kegiatan" class="form-select select2" required>
                            <option value="" selected disabled>Pilih Bentuk Kegiatan</option>
                            @foreach ($bentuk_kegiatan as $b)
                                <option value="{{ $b->id }}">{{ $b->bentuk_kegiatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="nomor_kerjasama">Nomor Kerja Sama</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-file"></i></span>
                    <input type="text" class="form-control" name="nomor_kerjasama" id="nomor_kerjasama" placeholder="Tulis Nomor Kerjasama" required />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
                    <div class="input-group input-group-merge">
                        <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                        <select name="jenis_kerja_sama" id="jenis_kerja_sama" class="form-select" required>
                            <option value="" selected disabled>Pilih Jenis Kerja Sama</option>
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
                            <option value="" selected disabled>Pilih Jenis Perjanjian</option>
                            <option value="Memorandum of Understanding (MOU)">Memorandum of Understanding (MOU)</option>
                            <option value="Memorandum of Agreement (MOA)">Memorandum of Agreement (MOA)</option>
                            <option value="Implementation Arrangement (IA)">Implementation Arrangement (IA)</option>
                        </select>
                    </div>
                </div>
    
                <div class="mb-3">
                    <label class="form-label" for="judul_kerja_sama">Judul Kerjasama</label>
                    <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                    <input type="text" class="form-control" name="judul_kerja_sama" id="judul_kerja_sama" placeholder="Tulis Judul Kerjasama" required />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="form-label" class="mb-2">Masa Berlaku</label><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="masa_berlaku_tmt">TMT</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar-alt"></i></span>
                                <input type="date" class="form-control" name="masa_berlaku_tmt" id="masa_berlaku_tmt" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="masa_berlaku_tat">TAT</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-calendar-alt"></i></span>
                                <input type="date" class="form-control" name="masa_berlaku_tat" id="masa_berlaku_tat" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status_kerjasama">Status Kerja Sama</label>
                    <div class="input-group input-group-merge">
                        <span id="status_kerjasama2" class="input-group-text"><i class='bx bxs-book-content'></i></span>
                        <select name="status_kerjasama" id="status_kerjasama" class="form-select" required>
                            <option value="" selected disabled>Pilih Status Kerja Sama</option>
                            <option value="AKTIF">Aktif</option>
                            <option value="KADALUARSA">Kadaluarsa</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="dokumen_kerjasama">Dokumen Kerjasama (.pdf Max 10MB)</label>
                    <div class="input-group input-group-merge">
                    <input type="file" class="form-control" name="dokumen_kerjasama" id="dokumen_kerjasama" accept=".pdf" required/>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div id="containerFormMitra">
                <div class="card mb-4 mitraContainer">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 form-title-mitra">Mitra Kerja Sama #1</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label class="form-label" for="klasifikasi_mitra">Klasifikasi Mitra</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-outline"></i></span>
                                <select name="klasifikasi_mitra[]" class="form-select select2" required>
                                    <option value="" selected disabled>Pilih Klasifikasi Mitra</option>
                                    @foreach ($klasifikasi_mitra as $k)
                                        <option value="{{ $k->id }}">{{ $k->klasifikasi_mitra }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="mb-3">
                            <label class="form-label" for="nama_instansi_mitra">Nama Instansi</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                            <input type="text" class="form-control" name="nama_instansi_mitra[]" placeholder="Tulis Nama Instansi Mitra" required />
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="alamat_instansi_mitra">Alamat Instansi</label>
                            <div class="input-group input-group-merge">
                                <textarea name="alamat_instansi_mitra[]"  class="form-control" cols="10" rows="3" placeholder="Tulis Alamat Instansi" required></textarea>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label class="form-label mb-2">Penandatangan</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="penandatangan_nama_mitra">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" name="penandatangan_nama_mitra[]"  placeholder="Tulis Nama Penandatangan" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="penandatangan_jabatan_mitra">Jabatan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" class="form-control" name="penandatangan_jabatan_mitra[]"  placeholder="Tulis Jabatan Penandatangan" required />
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="mb-3">
                            <label class="form-label mb-2">Penanggung Jawab</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="penanggungjawab_nama_mitra">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" name="penanggungjawab_nama_mitra[]"  placeholder="Tulis Nama Penanggung Jawab" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="penanggungjawab_jabatan_mitra">Jabatan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" class="form-control" name="penanggungjawab_jabatan_mitra[]"  placeholder="Tulis Jabatan Penanggung Jawab" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- Tombol Tambah Data -->
            <div class="col-xl mb-5">
                <button type="button" id="tambahDataMitra" class="btn btn-secondary btn-sm">Tambah Mitra</button>
            </div>
        </div>

        <div class="col-xl-6">
            <div id="containerFormUnit">
                <div class="card mb-4 unitKerjaContainer">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 form-title">Unit Kerja #1</h5>
                    </div>
                    <div class="card-body">
                        
                        <div class="mb-3">
                            <label class="form-label" for="unit_kerja">Unit Kerja</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <select name="unit_kerja[]" class="form-select select2" required>
                                    <option value="" selected disabled>Pilih Unit</option>
                                    @foreach ($unit as $u)
                                        <option value="{{ $u->kd_unit }}">{{ $u->nama_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <label class="form-label" for="penandatangan_nama_unit_kerja">Nama Pejabat Penandatangan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="penandatangan_nama_unit_kerja[]"  placeholder="Tulis Nama Pejabat yang menandatangani dokumen" required />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="jabatan_penandatangan_nama_unit_kerja">Jabatan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                    <input type="text" class="form-control" name="jabatan_penandatangan_nama_unit_kerja[]"  placeholder="Tulis Jabatan" required/>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <label class="form-label" for="penanggungjawab_nama_unit_kerja">Nama Penanggungjawab</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" name="penanggungjawab_nama_unit_kerja[]"  placeholder="Tulis Nama Pejabat yang menandatangani dokumen" required/>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label" for="jabatan_penanggungjawab_nama_unit_kerja">Jabatan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                    <input type="text" class="form-control" name="jabatan_penanggungjawab_nama_unit_kerja[]"  placeholder="Tulis Jabatan" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah Data -->
            <div class="col-xl mb-5">
                <button type="button" id="tambahDataUnitKerja" class="btn btn-secondary btn-sm">Tambah Unit</button>
            </div>
        </div>
    </div>

    <!-- Tombol Submit -->
    <div class="col-xl text-center">
        <button type="submit" class="btn btn-primary btn-simpan"><span class="icon-base bx bx-paper-plane icon-sm me-2"></span> Simpan Pengajuan</button>
    </div>
  </form>
</div>
@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });

        let formIndex = 1;
        $('#tambahDataUnitKerja').click(function () {
            let newForm = $('.unitKerjaContainer').first().clone();
            newForm.find('input').val('');
            newForm.find('.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').removeAttr('aria-hidden');

            newForm.find('.select2').next('.select2-container').remove(); 
            formIndex++;
            newForm.find('.form-title').text('Unit Kerja #' + formIndex);
            if (newForm.find('.remove-btn').length === 0) {
                newForm.find('.card-header').append(`
                    <button type="button" class="btn btn-sm btn-danger remove-btn">
                        Hapus
                    </button>
                `);
            }

            $('#containerFormUnit').append(newForm);
            newForm.find('.select2').select2({
                theme: 'bootstrap-5',
            });
        });

        let formIndexMitra = 1;
        $('#tambahDataMitra').click(function () {
            let newForm = $('.mitraContainer').first().clone();
            newForm.find('input').val('');
            newForm.find('textarea').val('');
            newForm.find('.select2').removeClass('select2-hidden-accessible').removeAttr('data-select2-id').removeAttr('aria-hidden');

            newForm.find('.select2').next('.select2-container').remove(); 
            formIndexMitra++;
            newForm.find('.form-title').text('Mitra #' + formIndexMitra);
            if (newForm.find('.remove-btn-mitra').length === 0) {
                newForm.find('.card-header').append(`
                    <button type="button" class="btn btn-sm btn-danger remove-btn-mitra">
                        Hapus
                    </button>
                `);
            }

            $('#containerFormMitra').append(newForm);
            newForm.find('.select2').select2({
                theme: 'bootstrap-5',
            });
        });

        $(document).on('click', '.remove-btn', function () {
            if ($('.unitKerjaContainer').length > 1) {
                $(this).closest('.unitKerjaContainer').remove();
            }
        });

        $(document).on('click', '.remove-btn-mitra', function () {
            if ($('.mitraContainer').length > 1) {
                $(this).closest('.mitraContainer').remove();
            }
        });

        $("#form-create").validate({
            errorClass: "text-danger",
            errorPlacement: function(error, element) {
                if (element.closest('.input-group').length) {
                    error.insertAfter(element.closest('.input-group'));
                } else {
                    error.insertAfter(element); 
                }
            },
            submitHandler: function(form) {
                form.submit();
                $('.btn-simpan').addClass('disabled');
                $('.btn-simpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            }
        });
    });
</script>
@endsection