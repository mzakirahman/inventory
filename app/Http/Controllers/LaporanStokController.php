<?php

namespace App\Http\Controllers;

use App\Exports\StokExport;
use App\Models\Stok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanStokController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "laporan_stok",
            "title" => "Laporan Stok Barang"
        ];
        $data['stok'] = Stok::orderBy('created_at', 'desc')->get();
        return view('laporan_stok', $data);
    }

    public function export()
    {
        return Excel::download(new StokExport, 'Data Stok.xlsx');
    }
}
