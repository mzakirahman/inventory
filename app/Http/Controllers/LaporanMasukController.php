<?php

namespace App\Http\Controllers;

use App\Exports\BarangMasukExport;
use App\Models\ItemMasuk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMasukController extends Controller
{
    public function index()
    {
        if (isset($_GET['bulan']) && $_GET['bulan'] != "") {
            $bulan = $_GET['bulan'];
        } else {
            $bulan = date('m');
        }
        if (isset($_GET['tahun']) && $_GET['tahun'] != "") {
            $tahun = $_GET['tahun'];
        } else {
            $tahun = date('Y');
        }

        $data['web'] = [
            "page" => "laporan_masuk",
            "title" => "Laporan Transaksi Masuk"
        ];
        $data['item'] = ItemMasuk::select('item_masuk.*', 'stok.stock_code', 'stok.description', 'transaksi_masuk.no AS no_transaksi', 'transaksi_masuk.receiving_signature', 'transaksi_masuk.date_transaksi', 'transaksi_masuk.receiving_name')
            ->join('stok', 'item_masuk.id_stok', '=', 'stok.id_stok')
            ->join('transaksi_masuk', 'item_masuk.id_transaksi', '=', 'transaksi_masuk.id_transaksi')
            ->where('transaksi_masuk.deleted_at', null)
            ->whereMonth('transaksi_masuk.date_transaksi', $bulan)
            ->whereYear('transaksi_masuk.date_transaksi', $tahun)
            ->orderBy('transaksi_masuk.date_transaksi', 'desc')
            ->get();

        return view('laporan_masuk', $data);
    }

    public function export()
    {
        if (isset($_GET['bulan']) && $_GET['bulan'] != "") {
            $bulan = $_GET['bulan'];
        } else {
            $bulan = date('m');
        }
        if (isset($_GET['tahun']) && $_GET['tahun'] != "") {
            $tahun = $_GET['tahun'];
        } else {
            $tahun = date('Y');
        }

        $export = new BarangMasukExport($bulan, $tahun);

        return Excel::download($export, 'Data Transaksi Barang Masuk.xlsx');
    }
}
