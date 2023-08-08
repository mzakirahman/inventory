<div class="mb-3">
    <p><strong>Laporan Transaksi Masuk</strong></p>
    <p>Bulan : {{ bulan_indo($bulan) }}</p>
    <p>Tahun : {{ $tahun }}</p>
    <p>Total Data : @if (count($item) > 0)
            {{ count($item) . ' data' }}
        @else
            Tidak ada data
        @endif
    </p>
</div>
<br>
<table border="1">
    <thead style="font-weight: bold">
        <tr>
            <th style="font-weight: bold">No. </th>
            <th style="font-weight: bold">No. Transaksi</th>
            <th style="font-weight: bold">Date</th>
            <th style="font-weight: bold">PO Number</th>
            <th style="font-weight: bold">Stock Code</th>
            <th style="font-weight: bold">Description</th>
            <th style="font-weight: bold">UOI</th>
            <th style="font-weight: bold">Qty On Hand</th>
            <th style="font-weight: bold">Qty Received</th>
            <th style="font-weight: bold">Qty Balance</th>
            <th style="font-weight: bold">Min/Max</th>
            <th style="font-weight: bold">Bin Loc</th>
            <th style="font-weight: bold">Doc Loc</th>
            <th style="font-weight: bold">Remarks</th>
            <th style="font-weight: bold">Receiving Section</th>
            <th style="font-weight: bold">Signature</th>
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
