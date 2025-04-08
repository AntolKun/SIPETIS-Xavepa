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
    <h4 class="mb-0">Data Nilai Siswa</h4>
    <div class="d-flex gap-2">
      <a href="{{ asset('templates/template_nilai.xlsx') }}" class="btn btn-success">
        <i class="bx bx-download"></i> Download Template
      </a>
      <a href="{{ route('admin.murid.nilai.import.form') }}" class="btn btn-primary">
        <i class="bx bx-upload"></i> Import Nilai
      </a>
    </div>
  </div>
  <div class="card-body">
    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100" style="border: 3px solid #000000;">
      <thead style="background-color: #3751CF; color: white;">
        <tr>
          <th rowspan="2">NISN</th>
          <th rowspan="2">Nama</th>
          <th rowspan="2">Kelas</th>

          <th colspan="4" class="text-center">Agama</th>
          <th colspan="4" class="text-center">PKN</th>
          <th colspan="4" class="text-center">Bahasa Indonesia</th>
          <th colspan="4" class="text-center">Matematika</th>
          <th colspan="4" class="text-center">IPA</th>
          <th colspan="4" class="text-center">IPS</th>
          <th colspan="4" class="text-center">B. Inggris</th>
          <th colspan="4" class="text-center">SB</th>
          <th colspan="4" class="text-center">PJS</th>
          <th colspan="4" class="text-center">INF</th>
          <th colspan="4" class="text-center">BLM</th>
          <th colspan="4" class="text-center">BMN</th>
          <th colspan="4" class="text-center">PAK</th>
        </tr>
        <tr>
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>AGM{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>PKN{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>BI{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>MTK{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>IPA{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>IPS{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>BING{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>SB{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>PJS{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>INF{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>BLM{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>BMN{{ $n }}</th>
          @endforeach
          @foreach (['1', '2', '3', 'LUS'] as $n)
          <th>PAK{{ $n }}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach($nilaiList as $nilai)
        <tr>
          <td>{{ $nilai['nisn'] }}</td>
          <td>{{ $nilai['nama'] }}</td>
          <td>{{ $nilai['kelas'] }}</td>

          @php
          $mapels = ['AGM', 'PKN', 'BI', 'MTK', 'IPA', 'IPS', 'BING', 'SB', 'PJS', 'INF', 'BLM', 'BMN', 'PAK'];
          @endphp

          @foreach ($mapels as $mapel)
          <td>{{ $nilai[$mapel . '1'] ?? '' }}</td>
          <td>{{ $nilai[$mapel . '2'] ?? '' }}</td>
          <td>{{ $nilai[$mapel . '3'] ?? '' }}</td>
          <td>{{ $nilai[$mapel . 'LUS'] ?? '' }}</td>
          @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@section('js')
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