<?php

namespace App\Exports;

use App\Models\ItemMasuk;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class BarangMasukExport implements FromView
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
        $item = ItemMasuk::select('item_masuk.*', 'stok.stock_code', 'stok.description', 'transaksi_masuk.no AS no_transaksi', 'transaksi_masuk.date_transaksi', 'transaksi_masuk.receiving_name', 'transaksi_masuk.receiving_signature')
            ->join('stok', 'item_masuk.id_stok', '=', 'stok.id_stok')
            ->join('transaksi_masuk', 'item_masuk.id_transaksi', '=', 'transaksi_masuk.id_transaksi')
            ->where('transaksi_masuk.deleted_at', null)
            ->whereMonth('transaksi_masuk.date_transaksi', $this->bulan)
            ->whereYear('transaksi_masuk.date_transaksi', $this->tahun)
            ->orderBy('transaksi_masuk.date_transaksi', 'desc')
            ->get();

        return view('export.barang_masuk', [
            'item' => $item,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }
}
