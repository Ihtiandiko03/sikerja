@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12 mb-3 order-0">
        <div class="card">
          <div class="d-flex align-items-start row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary mb-3">Selamat Datang 🎉</h5>
                <p class="mb-3">Aplikasi Kerja Sama ITERA</p>
  
                <a href="javascript:;" class="btn btn-sm btn-outline-primary">Lihat Kerja Sama</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-6">
                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="175" alt="View Badge User">
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
              </div>
            </div>
            <p class="mb-1">MoU</p>
            <h4 class="card-title mb-3">999</h4>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="../assets/img/icons/unicons/wallet-info.png" alt="wallet info" class="rounded">
              </div>
            </div>
            <p class="mb-1">MoA</p>
            <h4 class="card-title mb-3">999</h4>
          </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
              <div class="avatar flex-shrink-0">
                <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
              </div>
            </div>
            <p class="mb-1">IA</p>
            <h4 class="card-title mb-3">999</h4>
          </div>
        </div>
    </div>
</div>
@endsection