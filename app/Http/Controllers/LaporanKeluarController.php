<?php

namespace App\Http\Controllers;

use App\Exports\BarangKeluarExport;
use App\Models\ItemKeluar;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanKeluarController extends Controller
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
            "page" => "laporan_keluar",
            "title" => "Laporan Transaksi Keluar"
        ];
        $data['item'] = ItemKeluar::select('item_keluar.*', 'stok.stock_code', 'stok.description', 'transaksi_keluar.company', 'transaksi_keluar.from', 'transaksi_keluar.to', 'transaksi_keluar.serial', 'transaksi_keluar.created_at AS input', 'transaksi_keluar.consignor_name', 'transaksi_keluar.consignor_signature')
            ->join('stok', 'item_keluar.vocab_number', '=', 'stok.id_stok')
            ->join('transaksi_keluar', 'item_keluar.id_transaksi', '=', 'transaksi_keluar.id_transaksi')
            ->where('transaksi_keluar.deleted_at', null)
            ->whereMonth('transaksi_keluar.created_at', $bulan)
            ->whereYear('transaksi_keluar.created_at', $tahun)
            ->orderBy('transaksi_keluar.created_at', 'desc')
            ->get();

        return view('laporan_keluar', $data);
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

        $export = new BarangKeluarExport($bulan, $tahun);
        return Excel::download($export, 'Data Transaksi Barang Keluar.xlsx');
    }
}
