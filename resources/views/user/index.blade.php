@extends('layouts/contentNavbarLayout')

@section('title', 'User Management')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header border-bottom">
                <h6 class="card-title my-0">Tambah User</h6>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <label for="id_pegawai" class="form-label">Pilih Pegawai</label>
                            <select class="form-select select2" id="id_pegawai" name="id_pegawai" required>
                                <option value="">Pilih Pegawai</option>
                                @foreach($pegawai as $p)
                                    <option 
                                        value="{{ $p->id_pegawai }}" 
                                        data-email="{{ $p->email }}" 
                                        data-nama="{{ $p->nama_pegawai }}">
                                        {{ $p->nama_pegawai }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="email" id="pegawai_email">
                            <input type="hidden" name="nama" id="nama_pegawai">
                        </div>
                        <div class="col-md-2">
                            <label for="role_kerja" class="form-label">Role</label>
                            <select class="form-select select2-role" id="role_kerja" name="role_kerja" required>
                                <option value="">Pilih Role</option>
                                <option value="0">Admin</option>
                                <option value="1">User</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="id_unit" class="form-label">Pilih Pegawai</label>
                            <select class="form-select select2-unit" id="id_unit" name="id_unit" required>
                                <option value="">Pilih Unit</option>
                                @foreach($unit as $u)
                                    <option 
                                        value="{{ $u->kd_unit }}"> 
                                        {{ $u->nama_unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
  <div class="col-12">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-0">User Kerjasama</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive text-nowrap">
          <table class="table table-bordered" id="datatable">
            <thead class="table-light">
              <tr class="text-nowrap">
                <th>#</th>
                <th>Unit</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                {{-- <th>Aksi</th> --}}
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
          url: '{{ route('user.index') }}'
        },
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
          {data: 'nama_unit', name: 'nama_unit'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {
            data: 'role_kerja',
            name: 'role_kerja',
            className: 'text-center',
            render: function(data, type, row) {
              return data == 0 ? 'Admin' : 'User';
            }
          },
          // {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
      });

      $(document).on('click', '.btn-delete', function () {
        const id = $(this).data('id');
        // Use Laravel's route helper for safer URL generation
        let action = "{{ route('user.destroy', ':id') }}";
        action = action.replace(':id', id);
        $('#deleteForm').attr('action', action);
      });

      $('#id_pegawai').on('change', function() {
        var email = $(this).find(':selected').data('email') || '';
        var nama = $(this).find(':selected').data('nama') || '';
        $('#pegawai_email').val(email);
        $('#nama_pegawai').val(nama);
      });
    });
</script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: "Pilih Pegawai",
                allowClear: true
            });
            $('.select2-role').select2({
                width: '100%',
                placeholder: "Pilih Role",
                allowClear: true,
                minimumResultsForSearch: Infinity
            });
            $('.select2-unit').select2({
                width: '100%',
                placeholder: "Pilih Unit",
                allowClear: true
            });
        });
    </script>
@endsection