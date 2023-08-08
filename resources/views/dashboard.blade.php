@extends('main')
@section('content')
<div class="row mb-4">
    @if (Auth::user()->role == '1')
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="statistics-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <img src="{{ asset('/assets/img/svg/icon-user.svg') }}" alt="" class="icon-stat">
                    <h3 class="statistics-value">{{ $user }}</h3>
                    <h5 class="content-desc">Data Pengguna</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '2' || Auth::user()->role == '4')
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="statistics-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <img src="{{ asset('/assets/img/svg/icon-suplier.svg') }}" alt="" class="icon-stat">
                    <h3 class="statistics-value">{{ $suplier }}</h3>
                    <h5 class="content-desc">Data Suplier</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '2' || Auth::user()->role == '4')
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="statistics-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <img src="{{ asset('/assets/img/svg/icon-stok.svg') }}" alt="" class="icon-stat">
                    <h3 class="statistics-value">{{ $stok }}</h3>
                    <h5 class="content-desc">Data Barang</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '2' || Auth::user()->role == '3' || Auth::user()->role ==
    '4')
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="statistics-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <img src="{{ asset('/assets/img/svg/icon-barang-masuk.svg') }}" alt="" class="icon-stat">
                    <h3 class="statistics-value">{{ $item_masuk }}</h3>
                    <h5 class="content-desc">Data Barang Masuk</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if (Auth::user()->role == '1' || Auth::user()->role == '2' || Auth::user()->role == '3' || Auth::user()->role ==
    '4')
    <div class="col-12 col-md-6 col-lg-3 mb-3">
        <div class="statistics-card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column justify-content-between align-items-start">
                    <img src="{{ asset('/assets/img/svg/icon-barang-keluar.svg') }}" alt="" class="icon-stat">
                    <h3 class="statistics-value">{{ $item_keluar }}</h3>
                    <h5 class="content-desc">Data Barang Keluar</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@if (Auth::user()->role == '1' || Auth::user()->role == '2')
<div class="row">
    <div class="col-lg-8 col-12 col-md-8">
        <div class="statistics-card mb-4">
            <div class="d-felx">

                <div>
                    <h2 class="content-title"> <img src="{{ asset('/assets/img/global/bell.svg') }}" alt=""> Notifikasi
                    </h2>
                    <h5 class="content-desc mb-4">Barang Akan Segera Habis</h5>
                </div>
            </div>
            <table id="table-stok" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Stock Code</th>
                        <th>Description</th>
                        <th>QOH</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($notif as $row)
                    <tr style="vertical-align: middle">
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->stock_code }}</td>
                        <td>{{ $row->description }}</td>
                        <td>{{ $row->qoh }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


@endsection
@push('js_function')
<script>
    $('#table-stok').DataTable({
        responsive: true,
        "searching": false,
        "ordering" : false,
        "paging" : false
    });
</script>
@endpush