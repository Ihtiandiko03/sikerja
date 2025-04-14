@extends('layouts/contentNavbarLayout')

@section('title', 'Monitoring Kerja Sama')

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

<div class="row">
  <div class="col-12">
    <div class="col-12 mb-3">
      <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-0">Filter Kerja Sama</h5>
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
              <label class="form-label" for="status_kerjasama">Status</label>
              <div class="input-group input-group-merge">
                  <span id="status_kerjasama2" class="input-group-text"><i class='bx bxs-widget'></i></span>
                  <select name="status_kerjasama" id="status_kerjasama" class="form-select form-select-sm">
                    <option value="" selected="" disabled="">Pilih Status</option>
                    <option value="AKTIF">Aktif</option>
                    <option value="KADALUARSA">Kadaluarsa</option>
                  </select>
              </div>
            </div>
            <button type="button" id="filter" class="btn rounded-pill btn-primary btn-sm">FILTER</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Monitoring Kerja Sama</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered" id="datatable">
            <thead class="table-light">
              <tr class="text-nowrap">
                <th>#</th>
                <th>Aksi</th>
                <th>Unit Kerja/Inisiator</th>
                <th>Nomor Kerja Sama</th>
                <th>Status</th>
                <th>Mitra</th>
                <th>Klasifikasi Mitra</th>
                <th>Jenis Kerja Sama</th>
                <th>Jenis Perjanjian</th>
                <th>Bentuk Kegiatan</th>
                <th>Judul Kerjasama</th>
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

<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="deleteForm" method="POST">
      @csrf 
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header border-bottom">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

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
            d.status_kerjasama = $('#status_kerjasama').val();
            d.jenis_kerja_sama = $('#jenis_kerja_sama').val();
            d.jenis_perjanjian = $('#jenis_perjanjian').val();
          }
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
          {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false},
          {data: 'nama_unit', name: 'nama_unit'},
          {data: 'nomor_kerjasama', name: 'nomor_kerjasama', className: 'text-center', orderable: false,},
          {data: 'status', name: 'status', className: 'text-center', orderable: false,},
          {data: 'list_mitra', name: 'list_mitra'},
          {data: 'list_klasifikasi_mitra', name: 'list_klasifikasi_mitra'},
          {data: 'jenis_kerjasama', name: 'jenis_kerjasama'},
          {data: 'jenis_perjanjian', name: 'jenis_perjanjian'},
          {data: 'bentuk_kegiatan_desc', name: 'bentuk_kegiatan_desc'},
          {data: 'judul_kerjasama', name: 'judul_kerjasama'},
        ]
      });

      $('#filter').click(function(e){
        e.preventDefault();
        table.draw();
      });

      $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');

        $('#deleteForm').attr('action', '/repository-kerja-sama/' + id + '/delete');
      });
    });
</script>
@endsection