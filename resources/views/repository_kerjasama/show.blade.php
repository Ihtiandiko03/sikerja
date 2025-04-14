@extends('layouts/contentNavbarLayout')

@section('title', 'Detail Kerja Sama')

@section('page-style')
<style>
    .tab-content {
        border: none !important;
        box-shadow: none !important;
        background: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
    }
</style>
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

<div class="nav-align-top">
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-detail" aria-controls="navs-pills-top-detail" aria-selected="true"><i class='icon-base bx bx-search-alt-2 icon-sm me-2'></i> Detail</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-mitra" aria-controls="navs-pills-top-mitra" aria-selected="false" tabindex="-1"><i class='icon-base bx bx-briefcase icon-sm me-2'></i>Mitra</button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-unit" aria-controls="navs-pills-top-unit" aria-selected="false" tabindex="-1"><i class='icon-base bx bx-buildings icon-sm me-2'></i>Unit</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-pills-top-detail" role="tabpanel">
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="mb-0">Deskripsi Kerja Sama </h5>
                        </div>
                        <div class="card-body mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="unit_kerja_inisiator">Unit Kerja / Inisiator</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-group"></i></span>
                                    <input type="text" class="form-control" name="unit_kerja_inisiator" id="unit_kerja_inisiator" placeholder="Tulis Nama Unit Kerja" readonly value="{{$kerjasama->nama_unit}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-run"></i></span>
                                    <input type="text" class="form-control" name="bentuk_kegiatan" id="bentuk_kegiatan" readonly value="{{$kerjasama->bentuk_kegiatan_desc}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nomor_kerja_sama">Nomor Kerja Sama</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-run"></i></span>
                                    <input type="text" class="form-control" name="nomor_kerja_sama" id="nomor_kerja_sama" readonly value="{{$kerjasama->nomor_kerjasama}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
                                <div class="input-group input-group-merge">
                                    <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                                    <input type="text" class="form-control" name="jenis_kerja_sama" id="jenis_kerja_sama" readonly value="{{$kerjasama->jenis_kerjasama}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis_perjanjian">Jenis Perjanjian</label>
                                <div class="input-group input-group-merge">
                                    <span id="jenis_perjanjian2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                                    <input type="text" class="form-control" name="jenis_perjanjian" id="jenis_perjanjian" readonly value="{{$kerjasama->jenis_perjanjian}}" />
                                </div>
                            </div>
                
                            <div class="mb-3">
                                <label class="form-label" for="judul_kerja_sama">Judul Kerjasama</label>
                                <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                                <input type="text" class="form-control" name="judul_kerja_sama" id="judul_kerja_sama" placeholder="Tulis Judul Kerjasama" readonly value="{{$kerjasama->judul_kerjasama}}"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">TMT</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$kerjasama->masa_berlaku_tmt}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">TAT</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control" value="{{$kerjasama->masa_berlaku_tat}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Dokumen Kerja Sama</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-file-blank"></i></span>
                                    <a href="{{ Storage::url($kerjasama->dokumen_kerjasama) }}" target="_blank"
                                        class="form-control text-decoration-none text-primary bg-white"
                                        style="cursor: pointer; display: inline-block;">
                                        File Kerja Sama
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status Kerja Sama</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-check"></i></span>
                                    <input type="text" class="form-control" name="status_kerjasama" id="status_kerjasama" readonly value="{{$kerjasama->status_kerjasama}}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-mitra" role="tabpanel">
            <div class="row">
                @foreach ($mitra as $m)
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Mitra Kerja Sama</h5>
                            </div>
                            <div class="card-body">
                                
                                <div class="mb-3">
                                    <label class="form-label" for="klasifikasi_mitra">Klasifikasi Mitra</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-outline"></i></span>
                                    <input type="text" class="form-control" name="klasifikasi_mitra" id="klasifikasi_mitra" placeholder="Tulis Klasifikasi Mitra Kerja Sama" readonly value="{{$m->klasifikasi_mitra_desc}}"/>
                                    </div>
                                </div>
                            
                                <div class="mb-3">
                                    <label class="form-label" for="nama_instansi_mitra">Nama Instansi</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <input type="text" class="form-control" name="nama_instansi_mitra" id="nama_instansi_mitra" placeholder="Tulis Nama Instansi Mitra" readonly value="{{$m->nama_instansi_mitra}}" />
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label" for="alamat_instansi_mitra">Alamat Instansi</label>
                                    <div class="input-group input-group-merge">
                                        <textarea name="alamat_instansi_mitra" id="alamat_instansi_mitra" class="form-control" cols="10" rows="3" placeholder="Tulis Alamat Instansi" readonly>{{$m->alamat_instansi_mitra}}</textarea>
                                    </div>
                                </div>
                
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <label class="form-label" for="nama_mitra_penandatangan">Nama Pejabat Penandatangan</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" name="nama_mitra_penandatangan" id="nama_mitra_penandatangan" placeholder="Tulis Nama Pejabat yang menandatangani dokumen" readonly value="{{$m->penandatangan_nama_mitra}}" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="jabatan_penanda_tangan_mitra">Jabatan</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                            <input type="text" class="form-control" id="jabatan_penanda_tangan_mitra" readonly value="{{$m->jabatan_penandatangan_mitra}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_mitra_penanggungjawab">Nama Penanggungjawab</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-user"></i></span>
                                            <input type="text" class="form-control" name="nama_mitra_penanggungjawab" id="nama_mitra_penanggungjawab" placeholder="Tulis Nama Penanggung Jawab" readonly value="{{$m->penanggungjawab_nama_mitra}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label" for="jabatan_penanggungjawab_mitra">Jabatan</label>
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                            <input type="text" class="form-control" id="jabatan_penanggungjawab_mitra" readonly value="{{$m->jabatan_penanggungjawab_mitra}}"/>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-unit" role="tabpanel">
            <div class="row">
                @foreach ($unitKerja as $uk)
            
                <div class="col-lg-6 mb-3">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Unit Kerja</h5>
                        </div>
                        <div class="card-body">
                            
                            <div class="mb-3">
                                <label class="form-label" for="unit_kerja">Unit Kerja</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                    <input type="text" class="form-control"  readonly value="{{$uk->nama_unit}}"/>
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <label class="form-label" for="penandatangan_nama_unit_kerja">Nama Pejabat Penandatangan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$uk->penandatangan_nama_unit_kerja}}"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="jabatan_penandatangan_nama_unit_kerja">Jabatan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" class="form-control" value="{{$uk->jabatan_penandatangan_unit_kerja}}" readonly/>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <label class="form-label" for="penanggungjawab_nama_unit_kerja">Nama Penanggungjawab</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" readonly value="{{$uk->penanggungjawab_nama_unit_kerja}}" />
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="jabatan_penanggungjawab_nama_unit_kerja">Jabatan</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$uk->jabatan_penanggungjawab_unit_kerja}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
