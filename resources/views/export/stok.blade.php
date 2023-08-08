<div>
    <p><strong>Laporan Stok Barang</strong></p>
    <p>Total Data : @if (count($stok) > 0)
            {{ count($stok) . ' data' }}
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
            <th style="font-weight: bold">Stock Code</th>
            <th style="font-weight: bold">Description</th>
            <th style="font-weight: bold">QOH</th>
            <th style="font-weight: bold">Unit Value</th>
            <th style="font-weight: bold">Total Value</th>
            <th style="font-weight: bold">Location</th>
            <th style="font-weight: bold">Bin Loc</th>
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
                <td>{{ nl2br($row->description) }}</td>
                <td>{{ number_format($row->qoh, 0, ',', '.') }}</td>
                <td>{{ number_format($row->unit_value, 0, ',', '.') }}</td>
                <td>{{ number_format($row->qoh * $row->unit_value, 0, ',', '.') }}</td>
                <td>{{ $row->location }}</td>
                <td>{{ $row->bin_loc }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
