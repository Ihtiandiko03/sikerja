@extends('layouts/contentNavbarLayout')

@section('title', 'Telaah Kerja Sama')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Telaah /</span> Pengajuan Telaah Kerjasama
</h4>

<a href="{{ Route('telaah-kerja-sama.create') }}" class="btn btn-primary mb-4">Pengajuan Telaah Kerjasama</a>


<!-- Responsive Table -->
<div class="card">
  <h5 class="card-header">Daftar Pengajuan</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr class="text-nowrap">
          <th>#</th>
          <th>Unit Kerja/Inisiator</th>
          <th>Mitra</th>
          <th>Jenis Kerja Sama</th>
          <th>Jenis Perjanjian</th>
          <th>Judul Kerja Sama</th>
          {{-- <th>BKMP</th> --}}
          {{-- <th>Bidang Hukum</th> --}}
          {{-- <th>Detail</th> --}}
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php $i = 1; ?>
        @foreach ($pengajuan as $p)
          <tr>
            <th scope="row"><?= $i++ ?></th>
            <td>{{$p->unit_kerja_inisiator}}</td>
            <td>{{$p->nama_instansi_mitra}}</td>
            <td>{{$p->jenis_kerja_sama}}</td>
            <td>{{$p->jenis_perjanjian}}</td>
            <td>{{$p->judul_kerja_sama}}</td>
            {{-- <td>
                {{$p->tanggal_masuk_bkmp}} (Masuk BKMP)
                <br>
                {{$p->tanggal_keluar_bkmp}} (Keluar BKMP)
            </td>
            <td>
                {{$p->tanggal_masuk_hukum}} (Masuk Hukum)
                <br>
                {{$p->tanggal_keluar_hukum}} (Keluar Hukum)
            </td> --}}
            {{-- <td>
                <a href="" class="btn btn-primary">Detail</a>
            </td> --}}
          </tr>
        @endforeach
        
        
      </tbody>
    </table>
  </div>
</div>
<!--/ Responsive Table -->
@endsection
