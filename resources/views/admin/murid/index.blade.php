@extends('layouts.master')

@section('css')
<link href="{{ asset('skoteassets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('skoteassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Data Murid</h4>
    <div class="d-flex gap-2 align-items-center">
      <a href="{{ route('admin.murid.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
        <i class="bx bx-plus font-size-16"></i> <span>Tambah Murid</span>
      </a>

      <a href="{{ route('admin.murid.template') }}" class="btn btn-success d-flex align-items-center gap-1">
        <i class="bx bx-download font-size-16"></i> <span>Template Excel</span>
      </a>

      <form action="{{ route('admin.murid.import') }}" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
        @csrf
        <input type="file" name="excel" accept=".xlsx, .xls" required class="form-control form-control-sm">
        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
          <i class="bx bx-upload font-size-16"></i> <span>Import</span>
        </button>
      </form>
    </div>
  </div>
  <div class="card-body">
    <form id="bulk-form" method="POST" action="{{ route('admin.murid.bulk-update-status') }}">
      @csrf
      <input type="hidden" name="murid_ids" id="murid_ids">
      <div class="mb-3 d-flex gap-2">
        <button type="button" onclick="submitBulk('sudah')" class="btn btn-success d-flex align-items-center gap-1">
          <i class="bx bx-check-circle font-size-12"></i> <span>Tandai Sudah Bayar</span>
        </button>
        <button type="button" onclick="submitBulk('belum')" class="btn btn-danger d-flex align-items-center gap-1">
          <i class="bx bx-x-circle font-size-12"></i> <span>Tandai Belum Bayar</span>
        </button>
      </div>
    </form>
    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" style="border: 2px solid #3751CF;">
      <thead style="background-color: #3751CF; color: white;">
        <tr>
          <th><input type="checkbox" id="select-all"></th>
          <th>#</th>
          <th>NISN</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Status Bayar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($siswa as $m)
        <tr>
          <td>
            <input type="checkbox" class="murid-checkbox" value="{{ $m->id }}">
          </td>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $m->user->nisn }}</td>
          <td>{{ $m->nama }}</td>
          <td>{{ $m->kelas }}</td>
          <td>
            @if(strtolower($m->status_bayar) === 'sudah')
            <span class="badge bg-success">Sudah</span>
            @else
            <span class="badge bg-danger">Belum</span>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.murid.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('admin.murid.destroy', $m->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@section('js')
<script>
  // Checkbox Select All
  document.getElementById('select-all').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.murid-checkbox');
    checkboxes.forEach(cb => cb.checked = this.checked);
  });
</script>
<script>
  function submitBulk(status) {
    const checkboxes = document.querySelectorAll('.murid-checkbox:checked');
    if (checkboxes.length === 0) {
      Swal.fire({
        icon: 'error',
        title: 'Waduh!',
        text: 'Pilih Minimal 1 Murid!',
      })
      return;
    }

    let ids = [];
    checkboxes.forEach(cb => ids.push(cb.value));

    // bikin input hidden
    const form = document.getElementById('bulk-form');

    // clear input hidden sebelumnya
    document.getElementById('murid_ids').value = JSON.stringify(ids);

    // tambah input status
    let inputStatus = document.createElement('input');
    inputStatus.type = 'hidden';
    inputStatus.name = 'status';
    inputStatus.value = status;

    form.appendChild(inputStatus);
    form.submit();
  }
</script>
<!-- Required datatable js -->
<script src="{{ asset('skoteassets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Responsive examples -->
<script src="{{ asset('skoteassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('skoteassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('skoteassets/js/pages/datatables.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($message = session()->get('success'))
<script type="text/javascript">
  Swal.fire({
    icon: 'success',
    title: 'Sukses!',
    text: '{{ $message }}',
  })
</script>
@endif

@if ($message = session()->get('error'))
<script type="text/javascript">
  Swal.fire({
    icon: 'error',
    title: 'Waduh!',
    text: '{{ $message }}',
  })
</script>
@endif

@stop

@endsection