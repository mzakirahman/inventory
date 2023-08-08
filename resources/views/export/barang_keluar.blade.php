<div class="mb-3">
    <p><strong>Laporan Transaksi Keluar</strong></p>
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
            <th style="font-weight: bold">From Location Code</th>
            <th style="font-weight: bold">To Location Code</th>
            <th style="font-weight: bold">Serial No.</th>
            <th style="font-weight: bold">Vocab Number</th>
            <th style="font-weight: bold">Description</th>
            <th style="font-weight: bold">UOM</th>
            <th style="font-weight: bold">QTY</th>
            <th style="font-weight: bold">Order No.</th>
            <th style="font-weight: bold">Remaks</th>
            <th style="font-weight: bold">Input</th>
            <th style="font-weight: bold">Consignor</th>
            <th style="font-weight: bold">Siganture</th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($item as $row)
            <tr style="vertical-align: middle">
                <td>{{ $no++ }}</td>
                <td>{{ $row->from }}</td>
                <td>{{ $row->to }}</td>
                <td>{{ $row->serial }}</td>
                <td>{{ $row->stock_code }}</td>
                <td>{{ $row->description }}</td>
                <td>{{ $row->uom }}</td>
                <td>{{ $row->qty }}</td>
                <td>{{ $row->order_no }}</td>
                <td>{{ $row->remaks }}</td>
                <td>{{ date('d-m-Y', strtotime($row->input)) }}</td>
                <td>{{ $row->consignor_name }}</td>
                <td>{{ $row->consignor_signature }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
