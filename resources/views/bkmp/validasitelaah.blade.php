@extends('layouts/contentNavbarLayout')

@section('title', 'Monitoring Telaah Kerja Sama')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Telaah /</span> Monitoring Telaah Kerjasama
</h4>

<!-- Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-left: 20px;">
  @foreach ($statuses as $status)
    <li class="nav-item" role="presentation">
      <button class="nav-link @if ($loop->first) active @endif" id="{{ $status }}-tab" data-bs-toggle="tab" data-bs-target="#{{ $status }}" type="button" role="tab" aria-controls="{{ $status }}" aria-selected="true">{{ ucfirst($status) }}</button>
    </li>
  @endforeach
</ul>

<div class="tab-content" id="myTabContent">
  @foreach ($statuses as $status)
    <div class="tab-pane fade @if ($loop->first) show active @endif" id="{{ $status }}" role="tabpanel" aria-labelledby="{{ $status }}-tab">
      <!-- Responsive Table -->
      <div class="card">
        <h5 class="card-header">Monitoring Telaah - {{ ucfirst($status) }}</h5>
        <div class="table-responsive text-nowrap">
          <table class="table">
            <thead>
              <tr class="text-nowrap">
                <th>#</th>
                <th>Detail</th>
                <th>Status</th>
                @if ($status == 'Ditolak')
                  <th>Alasan</th>
                @endif
                <th>Unit Kerja/Inisiator</th>
                <th>Mitra</th>
                <th>Jenis Kerja Sama</th>
                <th>Jenis Perjanjian</th>
                <th>Judul Kerja Sama</th>
                <th>BKMP</th>
                
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php $i = 1; ?>
              @foreach ($pengajuan->where('status_telaah', $status) as $p)
                <tr>
                  <th scope="row"><?= $i++ ?></th>
                  <td>
                    <a href="{{ route('monitoring-telaah-kerja-sama.show', encrypt($p->id)) }}" class="btn btn-primary">Detail</a>
                  </td>
                  <td>
                    <span class="badge 
                      @if($p->status_telaah == 'Ditolak') bg-danger 
                      @elseif($p->status_telaah == 'Diajukan') bg-info 
                      @elseif($p->status_telaah == 'Diterima') bg-success 
                      @elseif($p->status_telaah == 'Dalam Proses') bg-secondary 
                      @endif">
                      {{$p->status_telaah}}
                    </span>
                  </td>
                  @if ($status == 'Ditolak')
                    <td>{{$p->ctt_bkmp}} </td>
                  @endif
                  <td>{{$p->unit_kerja_inisiator}}</td>
                  <td>{{$p->nama_instansi_mitra}}</td>
                  <td>{{$p->jenis_kerja_sama}}</td>
                  <td>{{$p->jenis_perjanjian}}</td>
                  <td>{{$p->judul_kerja_sama}}</td>
                  <td>
                      {{$p->tanggal_masuk_bkmp}} (Masuk)
                      <br>
                      {{$p->tanggal_keluar_bkmp}} (Keluar)
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!--/ Responsive Table -->
    </div>
  @endforeach
</div>

<!-- Revisi Modal -->

@endsection