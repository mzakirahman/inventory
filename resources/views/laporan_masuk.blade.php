@extends('main')
@section('content')
    <div class="statistics-card">
        <form action="{{ route('laporan-barang-masuk') }}" method="GET">
            <div class="mb-4 row">
                <div class="col-lg-2 mb-2">
                    <div class="form-group d-flex">
                        <label class="my-auto">Bulan </label>
                        @if (isset($_GET['bulan']) && $_GET['bulan'] != '')
                            @php
                                $bulan = $_GET['bulan'];
                            @endphp
                        @else
                            @php
                                $bulan = date('m');
                            @endphp
                        @endif
                        <select name="bulan" class="form-select ms-1">
                            <option value="01" @if ($bulan == '01') selected @endif>Januari</option>
                            <option value="02" @if ($bulan == '02') selected @endif>Februari</option>
                            <option value="03" @if ($bulan == '03') selected @endif>Maret</option>
                            <option value="04" @if ($bulan == '04') selected @endif>April</option>
                            <option value="05" @if ($bulan == '05') selected @endif>Mei</option>
                            <option value="06" @if ($bulan == '06') selected @endif>Juni</option>
                            <option value="07" @if ($bulan == '07') selected @endif>Juli</option>
                            <option value="08" @if ($bulan == '08') selected @endif>Agustus</option>
                            <option value="09" @if ($bulan == '09') selected @endif>September</option>
                            <option value="10" @if ($bulan == '10') selected @endif>Oktober</option>
                            <option value="11" @if ($bulan == '11') selected @endif>November</option>
                            <option value="12" @if ($bulan == '12') selected @endif>Desmber</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2 mb-2">
                    <div class="form-group d-flex">
                        <label class="my-auto">Tahun </label>
                        @if (isset($_GET['tahun']) && $_GET['tahun'] != '')
                            @php
                                $tahun = $_GET['tahun'];
                            @endphp
                        @else
                            @php
                                $tahun = date('Y');
                            @endphp
                        @endif
                        <select name="tahun" class="form-select ms-1">
                            @for ($i = date('Y'); $i <= 2023; $i++)
                                <option value="{{ $i }}" @if ($tahun == $i) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                        <a href="{{ url('/laporan-barang-masuk/export?bulan=' . $bulan . '&tahun=' . $tahun) }}" class="btn btn-success"><i class="fas fa-download"></i> Export Excel</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="mb-3">
            <p class="m-0"><strong>Laporan Transaksi Masuk</strong></p>
            <p class="m-0">Bulan : {{ bulan_indo($bulan) }}</p>
            <p class="m-0">Tahun : {{ $tahun }}</p>
            <p class="m-0">Total Data : @if (count($item) > 0)
                    {{ count($item) . ' data' }}
                @else
                    Tidak ada data
                @endif
            </p>
        </div>
        <table id="table" class="table table-bordered" style="width:100%">
            <thead style="vertical-align: middle">
                <tr>
                    <th>No. </th>
                    <th>No. Transaksi</th>
                    <th>Date</th>
                    <th>PO Number</th>
                    <th>Stock Code</th>
                    <th>Description</th>
                    <th>UOI</th>
                    <th>Qty On Hand</th>
                    <th>Qty Received</th>
                    <th>Qty Balance</th>
                    <th>Min/Max</th>
                    <th>Bin Loc</th>
                    <th>Doc Loc</th>
                    <th>Remarks</th>
                    <th>Receiving Section</th>
                    <th>Signature</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($item as $row)
                    <tr style="vertical-align: middle">
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->no_transaksi }}</td>
                        <td>{{ date('d-m-Y', strtotime($row->date_transaksi)) }}</td>
                        <td>{{ $row->po_number }}</td>
                        <td>{{ $row->stock_code }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->uoi }}</td>
                        <td>{{ $row->on_hand }}</td>
                        <td>{{ $row->received }}</td>
                        <td>{{ $row->balance }}</td>
                        <td>{{ $row->min_max }}</td>
                        <td>{{ $row->bin_loc }}</td>
                        <td>{{ $row->doc_loc }}</td>
                        <td>{{ $row->remarks }}</td>
                        <td>{{ $row->receiving_name }}</td>
                        <td>{{ $row->receiving_signature }}</td>
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
