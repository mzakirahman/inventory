@extends('main')
@section('content')
    <div class="statistics-card">
        <div class="mb-4">
            <a href="{{ url('/laporan-stok/export') }}" class="btn btn-success"><i class="fas fa-download"></i> Export
                Excel</a>
        </div>
        <div class="mb-3">
            <p class="m-0"><strong>Laporan Stok Barang</strong></p>
            <p class="m-0">Total Data : @if (count($stok) > 0)
                    {{ count($stok) . ' data' }}
                @else
                    Tidak ada data
                @endif
            </p>
        </div>
        <table id="table" class="table table-bordered" style="width:100%">
            <thead style="vertical-align: middle">
                <tr>
                    <th>No. </th>
                    <th>Stock Code</th>
                    <th>Description</th>
                    <th>QOH</th>
                    <th>Unit Value</th>
                    <th>Total Value</th>
                    <th>Location</th>
                    <th>Bin loc</th>
                </tr>
            </thead>
            <tbody>

                @php
                    $no = 1;
                @endphp
                @foreach ($stok as $row)
                    <tr style="vertical-align: middle">
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->stock_code }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ number_format($row->qoh, 0, ',', '.') }}</td>
                        <td>{{ number_format($row->unit_value, 0, ',', '.') }}</td>
                        <td>{{ number_format($row->qoh * $row->unit_value, 0, ',', '.') }}</td>
                        <td>{{ $row->location }}</td>
                        <td>{{ $row->bin_loc }}</td>
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
