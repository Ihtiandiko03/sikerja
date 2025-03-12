@extends('layouts/contentNavbarLayout')

@section('title', 'Pengajuan Telaah')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Telaah/</span>Telaah Kerjasama</h4>

<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Status</h5>
            </div>
            <div class="card-body">
                
               
                <div class="row mb-3">
                    <div class="col-md-7">
                        <label class="form-label" >Tanggal Masuk BKMP</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="text" class="form-control"  readonly value="{{$telaah->tanggal_masuk_bkmp ? $telaah->tanggal_masuk_bkmp : '-'}}"/>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" >Tanggal Keluar BKMP</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            <input type="text" class="form-control" value="{{$telaah->tanggal_keluar_bkmp? $telaah->tanggal_keluar_bkmp : '-'}}" readonly/>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
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
                </div>

                <div class="col-md-2 mx-auto">
                    <div class="">
                       

                         <form action="{{route('bkmp.storevalidasitelaah')}}" method="POST" class="mt-5">
                            @csrf
                            @method('put')

                            <input type="hidden" name="id" value="{{ encrypt($telaah->id) }}">

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statustelaah1" checked>
                                <label class="form-check-label" for="statustelaah1" value="1">
                                    Validasi Pengajuan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="statustelaah2">
                                <label class="form-check-label" for="statustelaah2" value="0">
                                    Tolak Pengajuan
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="catatan">Catatan</label>
                                <textarea name="catatan" id="catatan" class="form-control" cols="10" rows="3" placeholder="Tulis Catatan"></textarea>
                            </div>


                              <button type="submit" class="btn btn-primary mt-2">Submit</button>


                         </form> 
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Pengajuan Telaah Kerjasama</h5>
            </div>
            <div class="card-body">
                
                <div class="mb-3">
                    <label class="form-label" for="unit_kerja_inisiator">Unit Kerja / Inisiator</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-group"></i></span>
                    <input type="text" class="form-control" name="unit_kerja_inisiator" id="unit_kerja_inisiator" placeholder="Tulis Nama Unit Kerja" readonly value="{{$telaah->unit_kerja_inisiator}}" />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-run"></i></span>
                    <input type="text" class="form-control" name="bentuk_kegiatan" id="bentuk_kegiatan" placeholder="Tulis Bentuk Kegiatan" readonly value="{{$telaah->bentuk_kegiatan}}" />
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
                
            </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mitra Kerja Sama</h5>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label class="form-label" for="klasifikasi_mitra">Klasifikasi Mitra</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-outline"></i></span>
                        <input type="text" class="form-control" name="klasifikasi_mitra" id="klasifikasi_mitra" placeholder="Tulis Klasifikasi Mitra Kerja Sama" readonly value="{{$telaah->klasifikasi_mitra}}"/>
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
                        <input type="text" class="form-control"  readonly value="{{$uk->unit_kerja}}"/>
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

<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Status Telaah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">Status: {{$telaah->status_telaah}}</div>
                @if($telaah->status_telaah == 'Ditolak')
                    <div class="alert alert-danger">Alasan: {{$telaah->ctt_bkmp}}</div>
                @endif 
            </div>
            <div class="modal-footer">
                @if($telaah->status_telaah == 'Ditolak')
                    <a href="{{route('telaah-kerja-sama.edit', encrypt($telaah->id))}}" class="btn btn-warning">Revisi</a>
                @endif 
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
        statusModal.show();
    });
</script>

@endsection
