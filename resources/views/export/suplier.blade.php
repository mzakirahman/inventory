<div>
    <p><strong>Laporan Suplier</strong></p>
    <p>Total Data : @if (count($suplier) > 0) {{ count($suplier)." data" }} @else Tidak ada data @endif
    </p>
</div>
<br>
<table border="1">
    <thead style="font-weight: bold">
        <tr>
            <th style="font-weight: bold">No. </th>
            <th style="font-weight: bold">Nama Suplier</th>
            <th style="font-weight: bold">Alamat</th>
            <th style="font-weight: bold">Telepon</th>
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