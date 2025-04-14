@extends('layouts/contentNavbarLayout')

@section('title', 'Monitoring Telaah Kerja Sama')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
  <div class="col-12 mb-3">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Filter Telaah</h5>
      </div>
      <div class="card-body mt-3">
        <div class="filter-container">
          <div class="mb-3">
            <label class="form-label" for="jenis_kerja_sama">Jenis Kerja Sama</label>
            <div class="input-group input-group-merge">
                <span id="jenis_kerja_sama2" class="input-group-text"><i class="bx bxs-component"></i></span>
                <select name="jenis_kerja_sama" id="jenis_kerja_sama" class="form-select form-select-sm">
                  <option value="" selected="" disabled="">Pilih Jenis Kerja Sama</option>
                  <option value="Kerjasama Dalam Negeri">Kerjasama Dalam Negeri</option>
                  <option value="Kerjasama Luar Negeri">Kerjasama Luar Negeri</option>
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="jenis_perjanjian">Jenis Perjanjian</label>
            <div class="input-group input-group-merge">
                <span id="jenis_perjanjian2" class="input-group-text"><i class='bx bx-conversation'></i></span>
                <select name="jenis_perjanjian" id="jenis_perjanjian" class="form-select form-select-sm">
                  <option value="" selected="" disabled="">Pilih Jenis Perjanjian</option>
                  <option value="Memorandum of Understanding (MOU)">Memorandum of Understanding (MOU)</option>
                  <option value="Memorandum of Agreement (MOA)">Memorandum of Agreement (MOA)</option>
                  <option value="Implementation Arrangement (IA)">Implementation Arrangement (IA)</option>
                </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label" for="status_telaah">Status</label>
            <div class="input-group input-group-merge">
                <span id="status_telaah2" class="input-group-text"><i class='bx bxs-widget'></i></span>
                <select name="status_telaah" id="status_telaah" class="form-select form-select-sm">
                  <option value="" selected="" disabled="">Pilih Status Telaah</option>
                  <option value="Selesai">Selesai</option>
                  <option value="Ditolak">Ditolak</option>
                  <option value="Dalam Proses">Proses</option>
                </select>
            </div>
          </div>
          <button type="button" id="filter" class="btn rounded-pill btn-primary btn-sm">FILTER</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Monitoring Telaah</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered" id="datatable">
            <thead class="table-light">
              <tr class="text-nowrap">
                <th>#</th>
                <th>Aksi</th>
                <th>Unit Kerja/Inisiator</th>
                <th>Status</th>
                <th>Mitra</th>
                <th>Jenis Kerja Sama</th>
                <th>Jenis Perjanjian</th>
                <th>Judul Kerja Sama</th>
              </tr>
            </thead>
            <tbody>
        
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ Responsive Table -->
@endsection

@section('page-script')
<link href="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.css" rel="stylesheet" integrity="sha384-M6C9anzq7GcT0g1mv0hVorHndQDVZLVBkRVdRb2SsQT7evLamoeztr1ce+tvn+f2" crossorigin="anonymous">
<script src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js" integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
      var table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,              
        ajax: {
          url: '{{ url()->current() }}',
          data: function(d) {
            d.status_telaah = $('#status_telaah').val();
            d.jenis_kerja_sama = $('#jenis_kerja_sama').val();
            d.jenis_perjanjian = $('#jenis_perjanjian').val();
          }
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
          {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false},
          {data: 'nama_unit', name: 'nama_unit'},
          {data: 'status', name: 'status', className: 'text-center', orderable: false, searchable: false},
          {data: 'nama_instansi_mitra', name: 'nama_instansi_mitra'},
          {data: 'jenis_kerja_sama', name: 'jenis_kerja_sama', className: 'text-center'},
          {data: 'jenis_perjanjian', name: 'jenis_perjanjian', className: 'text-center', orderable: false, searchable: false},
          {data: 'judul_kerja_sama', name: 'judul_kerja_sama', className: 'text-center', orderable: false, searchable: false},
        ]
      });

      $('#filter').click(function(e){
        e.preventDefault();
        table.draw();
      });
    });
</script>
@endsection
