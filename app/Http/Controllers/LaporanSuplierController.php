<?php

namespace App\Http\Controllers;

use App\Exports\SuplierExport;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanSuplierController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "laporan_suplier",
            "title" => "Laporan Suplier"
        ];
        $data['suplier'] = Suplier::orderBy('created_at', 'desc')->get();
        return view('laporan_suplier', $data);
    }

    public function export()
    {
        return Excel::download(new SuplierExport, 'Data Suplier.xlsx');
    }
}
