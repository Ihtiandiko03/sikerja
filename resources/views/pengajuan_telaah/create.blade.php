@extends('layouts/contentNavbarLayout')

@section('title', 'Pengajuan Telaah')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Telaah/</span> Pengajuan Telaah</h4>

<div class="row">
  <form method="POST" action="{{ route('telaah-kerja-sama.store') }}" enctype="multipart/form-data">
    @csrf

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
                    <input type="text" class="form-control" name="unit_kerja_inisiator" id="unit_kerja_inisiator" placeholder="Tulis Nama Unit Kerja" required />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="bentuk_kegiatan">Bentuk Kegiatan</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-run"></i></span>
                    <input type="text" class="form-control" name="bentuk_kegiatan" id="bentuk_kegiatan" placeholder="Tulis Bentuk Kegiatan" required />
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
                    <div class="input-group input-group-merge">
                        <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bx-network-chart"></i></span>
                        <select name="jenis_kerja_sama" id="jenis_kerja_sama" class="form-select" required>
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
                    <input type="text" class="form-control" name="judul_kerja_sama" id="judul_kerja_sama" placeholder="Tulis Judul Kerjasama" required />
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="dokumen_pengantar">Surat Pengantar (.PDF Max 2 Mb)</label>
                    <div class="input-group input-group-merge">
                    <input type="file" class="form-control" name="dokumen_pengantar" id="dokumen_pengantar" accept=".pdf" required />
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label" for="dokumen_telaah">Dokumen Telaah (.Doc Max 10 Mb)</label>
                    <div class="input-group input-group-merge">
                    <input type="file" class="form-control" name="dokumen_telaah" id="dokumen_telaah" accept=".docx" required/>
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
                        <input type="text" class="form-control" name="klasifikasi_mitra" id="klasifikasi_mitra" placeholder="Tulis Klasifikasi Mitra Kerja Sama" required/>
                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label" for="nama_instansi_mitra">Nama Instansi</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                        <input type="text" class="form-control" name="nama_instansi_mitra" id="nama_instansi_mitra" placeholder="Tulis Nama Instansi Mitra" required />
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="alamat_instansi_mitra">Alamat Instansi</label>
                        <div class="input-group input-group-merge">
                            <textarea name="alamat_instansi_mitra" id="alamat_instansi_mitra" class="form-control" cols="10" rows="3" placeholder="Tulis Alamat Instansi" required></textarea>
                        </div>
                    </div>
    
                    <div class="mb-3">
                        <label class="form-label" for="nama_mitra_penandatangan">Nama Pejabat Penandatangan</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" name="nama_mitra_penandatangan" id="nama_mitra_penandatangan" placeholder="Tulis Nama Pejabat yang menandatangani dokumen" required />
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label" for="nama_mitra_penanggungjawab">Nama Penanggungjawab</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                        <input type="text" class="form-control" name="nama_mitra_penanggungjawab" id="nama_mitra_penanggungjawab" placeholder="Tulis Nama Penanggung Jawab" required />
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>

    

    <div class="col-xl" id="unitKerjaContainer">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Unit Kerja</h5>
            </div>
            <div class="card-body">
                
                <div class="mb-3">
                    <label class="form-label" for="unit_kerja">Unit Kerja</label>
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-buildings"></i></span>
                        <input type="text" class="form-control" name="unit_kerja[]"  placeholder="Tulis Unit Kerja" required />
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

                <div class="row mb-3">
                    <div class="col-md-7">
                        <label class="form-label" for="pic_nama_unit_kerja">Nama PIC</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                            <input type="text" class="form-control" name="pic_nama_unit_kerja[]"  placeholder="" required/>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label" for="contact_person">Contact Person</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-phone-call"></i></span>
                            <input type="text" class="form-control" name="contact_person[]"  placeholder="Tulis Contact Person" required/>
                        </div>
                    </div>
                </div>
                
                
            
            </div>
        </div>
    </div>


    <!-- Tombol Tambah Data -->
    <div class="col-xl mb-5">
        <button type="button" id="tambahData" class="btn btn-secondary">Tambah Unit</button>
    </div>

    <!-- Tombol Submit -->
    <div class="col-xl text-center">
        <button type="submit" class="btn btn-primary">Simpan Pengajuan</button>
    </div>
  </form>
</div>
@endsection
