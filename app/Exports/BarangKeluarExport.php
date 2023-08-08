<?php

namespace App\Exports;

use App\Models\ItemKeluar;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BarangKeluarExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $bulan;
    private $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {

        $item = ItemKeluar::select('item_keluar.*', 'stok.stock_code', 'stok.description', 'transaksi_keluar.company', 'transaksi_keluar.from', 'transaksi_keluar.to', 'transaksi_keluar.serial', 'transaksi_keluar.created_at AS input', 'transaksi_keluar.consignor_name', 'transaksi_keluar.consignor_signature')
            ->join('stok', 'item_keluar.vocab_number', '=', 'stok.id_stok')
            ->join('transaksi_keluar', 'item_keluar.id_transaksi', '=', 'transaksi_keluar.id_transaksi')
            ->where('transaksi_keluar.deleted_at', null)
            ->whereMonth('transaksi_keluar.created_at', $this->bulan)
            ->whereYear('transaksi_keluar.created_at', $this->tahun)
            ->orderBy('transaksi_keluar.created_at', 'desc')
            ->get();

        return view('export.barang_keluar', [
            'item' => $item,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }
}
