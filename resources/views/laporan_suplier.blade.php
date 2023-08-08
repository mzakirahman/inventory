@extends('main')
@section('content')
    <div class="statistics-card">
        <div class="mb-4">
            <a href="{{ url('/laporan-suplier/export') }}" class="btn btn-success"><i class="fas fa-download"></i> Export
                Excel</a>
        </div>
        <div class="mb-3">
            <p class="m-0"><strong>Laporan Suplier</strong></p>
            <p class="m-0">Total Data : @if (count($suplier) > 0)
                    {{ count($suplier) . ' data' }}
                @else
                    Tidak ada data
                @endif
            </p>
        </div>
        <table id="table" class="table table-bordered" style="width:100%">
            <thead style="vertical-align: middle">
                <tr>
                    <th>No. </th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($suplier as $row)
                    <tr style="vertical-align: middle">
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama_suplier }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>{{ $row->telepon }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
@push('js_function')
    <script>
        $('#table').DataTable({
            responsive: true,
            "searching": false,
            "ordering": false,
            "paging": false,
            "info": false
        });
    </script>
@endpush
