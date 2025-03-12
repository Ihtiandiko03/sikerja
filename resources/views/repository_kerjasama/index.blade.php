@extends('layouts/contentNavbarLayout')

@section('title', 'Telaah Kerja Sama')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Repository /</span> Entry Kerja Sama
</h4>

<a href="{{ Route('repository-kerja-sama.create') }}" class="btn btn-primary mb-4">Tambah Kerjasama</a>


<!-- Responsive Table -->
<div class="card">
  <h5 class="card-header">Daftar Kerjasama</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Unit Kerja/Inisiator</th>
          <th>Nomor Kerja Sama</th>
          <th>Mitra</th>
          <th>Klasifikasi Mitra</th>
          <th>Jenis Kerja Sama</th>
          <th>Jenis Perjanjian</th>
          <th>Bentuk Kegiatan</th>
          <th>Judul Kerjasama</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $i = 1; ?>
        @foreach ($kerjasama as $k)
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td>{{$k->unit_kerja_inisiator}}</td>
            <td>{{$k->nomor_kerjasama}}</td>
            <td>{{$k->nama_instansi_mitra}}</td>
            <td>{{$k->klasifikasi_mitra}}</td>
            <td>{{$k->jenis_kerjasama}}</td>
            <td>{{$k->jenis_perjanjian}}</td>
            <td>{{$k->bentuk_kegiatan}}</td>
            <td>{{$k->judul_kerjasama}}</td>
          </tr>
        @endforeach
        
        
      </tbody>
    </table>
  </div>
</div>
<!--/ Responsive Table -->
@endsection
