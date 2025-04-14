@extends('layouts/contentNavbarLayout')

@section('title', 'Bentuk Kegiatan')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
<!-- Responsive Table -->
<div class="row">
  <div class="col-12 mb-3">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Form Tambah Bentuk Kegiatan</h5>
      </div>
      <div class="card-body mt-2">
        <form action="{{ Route('bentuk-kegiatan.store') }}" method="POST">
          @csrf
          @method('POST')
          <div>
            <label for="bentukKegiatanFormControlInput" class="form-label">Bentuk Kegiatan</label>
            <input type="text" class="form-control" name="bentuk_kegiatan" id="bentukKegiatanFormControlInput" placeholder="Masukkan bentuk kegiatan" required>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Bentuk Kegiatan</h5>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered" id="datatable">
          <thead class="table-light">
            <tr class="text-nowrap">
              <th width="5%">#</th>
              <th>Bentuk Kegiatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
      
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm" method="POST">
      @csrf 
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header border-bottom">
          <h5 class="modal-title">Edit Bentuk Kegiatan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-id">
          <div class="mb-3">
            <label>Bentuk Kegiatan</label>
            <input type="text" id="edit-bentuk-kegiatan" name="bentuk_kegiatan" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
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
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
                {data: 'bentuk_kegiatan', name: 'bentuk_kegiatan'},
                {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false},
            ]
        });

        $(document).on('click', '.edit-btn', function () {
            const id = $(this).data('id');
            const bentuk_kegiatan = $(this).data('bentukkegiatan');

            $('#edit-id').val(id);
            $('#edit-bentuk-kegiatan').val(bentuk_kegiatan);
            $('#editForm').attr('action', '/bentuk-kegiatan/' + id);
        });

        $(document).on('click', '.delete-btn', function () {
            const id = $(this).data('id');

            $('#deleteForm').attr('action', '/bentuk-kegiatan/' + id);
        });
    });
</script>
@endsection
