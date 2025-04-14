@extends('layouts/contentNavbarLayout')

@section('title', 'Pengajuan Telaah')

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
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-history" aria-controls="navs-pills-top-history" aria-selected="false" tabindex="-1"><i class='icon-base bx bx-history icon-sm me-2'></i>Aktivitas</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="navs-pills-top-detail" role="tabpanel">
            @if ($telaah->status_telaah === 'Dalam Proses' && Session::get('role_kerja') == 'admin')
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <h5 class="mb-0">Form Validasi Pengajuan</h5>
                            </div>
                            <div class="card-body mt-2">
                                <form action="{{route('telaah-kerja-sama.validasi', request()->segment(3))}}" method="POST" class="mt-2">
                                    @csrf
                                    @method('put')
                                    <label class="form-label">Validasi Pengajuan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statustelaah1" value="TERIMA" required>
                                        <label class="form-check-label" for="statustelaah1">
                                            Terima Pengajuan
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="statustelaah2" value="TOLAK" required>
                                        <label class="form-check-label" for="statustelaah2">
                                            Tolak Pengajuan
                                        </label>
                                    </div>
                
                                    <div class="mt-2 mb-3">
                                        <label class="form-label" for="catatan">Catatan (Jika ditolak)</label>
                                        <textarea name="catatan" id="catatan" class="form-control" cols="10" rows="3" placeholder="Tulis Catatan"></textarea>
                                    </div>
                
                                    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($telaah->status_telaah === 'Ditolak' && Session::get('role_kerja') == 'user')
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <h5 class="mb-0">Pengajuanmu ditolak</h5>
                            </div>
                            <div class="card-body mt-2">
                                <div class="alert alert-danger"><span class="fw-bold">Catatan: </span> {{ $aktivitas->where('aksi', 'VALIDASI')->where('validasi', 'TOLAK')->first()->catatan ?? '-' }}</div>
                                <a href="{{ route('telaah-kerja-sama.edit', request()->segment(3)) }}" class="btn rounded-pill btn-outline-primary text-primary"><span class="icon-base bx bx-message-square-edit icon-sm me-2"></span>Ajukan Revisi</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-xl">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            @php
                                $label_status_color = 'info';
                                if ($telaah->status_telaah == 'Selesai') $label_status_color = 'success';
                                elseif($telaah->status_telaah == 'Ditolak') $label_status_color = 'danger';
                            @endphp
                            <h5 class="mb-0">Deskripsi Pengajuan <span class="badge rounded-pill ms-2 bg-label-{{ $label_status_color }}">{{ $telaah->status_telaah }}</span></h5>
                        </div>
                        <div class="card-body mt-2">
                            <div class="mb-3">
                                <label class="form-label" for="unit_kerja_inisiator">Unit Kerja / Inisiator</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-group"></i></span>
                                <input type="text" class="form-control" name="unit_kerja_inisiator" id="unit_kerja_inisiator" placeholder="Tulis Nama Unit Kerja" readonly value="{{$telaah->nama_unit}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-run"></i></span>
                                <input type="text" class="form-control" name="bentuk_kegiatan" id="bentuk_kegiatan" placeholder="Tulis Bentuk Kegiatan" readonly value="{{$telaah->bentuk_kegiatan_desc}}" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
                                <div class="input-group input-group-merge">
                                    <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                                    <input type="text" class="form-control" name="jenis_kerja_sama" id="jenis_kerja_sama" placeholder="Tulis Bentuk Kegiatan" readonly value="{{$telaah->jenis_kerja_sama}}" />
            
                                </div>
                            </div>
                
                            <div class="mb-3">
                                <label class="form-label" for="jenis_perjanjian">Jenis Perjanjian</label>
                                <div class="input-group input-group-merge">
                                    <span id="jenis_perjanjian2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                                    <input type="text" class="form-control" name="jenis_perjanjian" id="jenis_perjanjian" placeholder="Tulis Bentuk Kegiatan" readonly value="{{$telaah->jenis_perjanjian}}" />
                                </div>
                            </div>
                
                            <div class="mb-3">
                                <label class="form-label" for="judul_kerja_sama">Judul Kerjasama</label>
                                <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-message-alt-detail"></i></span>
                                <input type="text" class="form-control" name="judul_kerja_sama" id="judul_kerja_sama" placeholder="Tulis Judul Kerjasama" readonly value="{{$telaah->judul_kerja_sama}}"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Masuk BKMP</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$telaah->tanggal_masuk_bkmp ? $telaah->tanggal_masuk_bkmp : '-'}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Keluar BKMP</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control" value="{{$telaah->tanggal_keluar_bkmp? $telaah->tanggal_keluar_bkmp : '-'}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Masuk Hukum</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$telaah->tanggal_masuk_hukum?$telaah->tanggal_masuk_hukum:'-'}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Keluar Hukum</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control" value="{{$telaah->tanggal_keluar_hukum?$telaah->tanggal_keluar_hukum:'-'}}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Masuk Rektorat</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control"  readonly value="{{$telaah->tanggal_masuk_sekretariat?$telaah->tanggal_masuk_sekretariat:'-'}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" >Tanggal Keluar Rektorat</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control" value="{{$telaah->tanggal_keluar_sekretariat?$telaah->tanggal_keluar_sekretariat:'-'}}" readonly/>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Dokumen Pengantar</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-file"></i></span>
                                        <a href="{{ Storage::url($telaah->dokumen_pengantar) }}" target="_blank"
                                            class="form-control text-decoration-none text-primary bg-white"
                                            style="cursor: pointer; display: inline-block;">
                                            File Pengantar
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Dokumen Telaah</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-file-blank"></i></span>
                                        <a href="{{ Storage::url($telaah->dokumen_telaah) }}" target="_blank"
                                            class="form-control text-decoration-none text-primary bg-white"
                                            style="cursor: pointer; display: inline-block;">
                                            File Telaah
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Status</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                                        <input type="text" class="form-control" value="{{$telaah->status_telaah}}" readonly/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-mitra" role="tabpanel">
            <div class="row">
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
                                <input type="text" class="form-control" name="klasifikasi_mitra" id="klasifikasi_mitra" placeholder="Tulis Klasifikasi Mitra Kerja Sama" readonly value="{{$telaah->klasifikasi_mitra_desc}}"/>
                                </div>
                            </div>
                           
                            <div class="mb-3">
                                <label class="form-label" for="nama_instansi_mitra">Nama Instansi</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                                <input type="text" class="form-control" name="nama_instansi_mitra" id="nama_instansi_mitra" placeholder="Tulis Nama Instansi Mitra" readonly value="{{$telaah->nama_instansi_mitra}}" />
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="alamat_instansi_mitra">Alamat Instansi</label>
                                <div class="input-group input-group-merge">
                                    <textarea name="alamat_instansi_mitra" id="alamat_instansi_mitra" class="form-control" cols="10" rows="3" placeholder="Tulis Alamat Instansi" readonly>{{$telaah->alamat_instansi_mitra}}</textarea>
                                </div>
                            </div>
            
                            <div class="mb-3">
                                <label class="form-label" for="nama_mitra_penandatangan">Nama Pejabat Penandatangan</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" name="nama_mitra_penandatangan" id="nama_mitra_penandatangan" placeholder="Tulis Nama Pejabat yang menandatangani dokumen" readonly value="{{$telaah->nama_mitra_penandatangan}}" />
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="nama_mitra_penanggungjawab">Nama Penanggungjawab</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-user"></i></span>
                                <input type="text" class="form-control" name="nama_mitra_penanggungjawab" id="nama_mitra_penanggungjawab" placeholder="Tulis Nama Penanggung Jawab" readonly value="{{$telaah->nama_mitra_penanggungjawab}}"/>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
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
                                        <input type="text" class="form-control" value="{{$uk->jabatan_penandatangan_nama_unit_kerja}}" readonly/>
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
                                        <input type="text" class="form-control"  readonly value="{{$uk->jabatan_penanggungjawab_nama_unit_kerja}}"/>
                                    </div>
                                </div>
                            </div>
            
                            <div class="row mb-3">
                                <div class="col-md-7">
                                    <label class="form-label" for="pic_nama_unit_kerja">Nama PIC</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" readonly value="{{$uk->pic_nama_unit_kerja}}"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label" for="contact_person">Contact Person</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-phone-call"></i></span>
                                        <input type="text" class="form-control"  readonly  value="{{$uk->contact_person}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-history" role="tabpanel">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                            <h5 class="mb-0">Riwayat Aktivitas</h5>
                        </div>
                        <div class="card-body mt-3">
                            <ul class="list-group">
                                @foreach ($aktivitas as $a)
                                    <li class="list-group-item">
                                        <div class="fw-bold d-flex align-items-center text-primary">
                                            @if ($a->aksi == 'VALIDASI')
                                                @if ($a->validasi == 'TERIMA')
                                                    Pengajuan diterima (Selesai) <i class="icon-base bx bx-check-square ms-2 text-success"></i>
                                                @else
                                                    Pengajuan ditolak <i class="icon-base bx bx-x-circle ms-2 text-danger"></i>    
                                                @endif
                                            
                                            @elseif($a->aksi == 'UPLOAD')
                                                Membuat pengajuan <i class="icon-base bx bx-upload ms-2 text-info"></i>
                                            @elseif($a->aksi == 'REVISI') 
                                                Merevisi pengajuan <i class="icon-base bx bx-message-edit ms-2 text-primary"></i>
                                            @endif
                                        </div>
                                        @if ($a->file_dokumen_telaah)
                                            <a class="text-decoration-underline text-danger" href="{{ Storage::url($a->file_dokumen_telaah) }}" target="_blank"><i class='bx bx-file-blank me-2 text-danger'></i>Dokumen telaah</a><br>
                                        @endif
                                        <small class="d-flex align-items-center"><i class='bx bx-calendar-alt me-2'></i>{{ date('d M Y H:i', strtotime($a->created_at)) }}</small>
                                        <div class="fw-bold d-flex align-items-center"><i class='bx bx-user me-2'></i>{{ $a->nama_pegawai }}</div>
                                        @if ($a->catatan)
                                            <div class="alert alert-danger mt-2">
                                                <p class="fw-bold mb-0">Catatan: </p>
                                                <p>{{ $a->catatan }}</p>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
