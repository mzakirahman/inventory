<?php

namespace App\Http\Controllers;

use App\Models\ItemKeluar;
use App\Models\ItemMasuk;
use App\Models\Stok;
use App\Models\Suplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "dashboard",
            "title" => "Dashboard"
        ];
        $data['user'] = User::count();
        $data['stok'] = Stok::count();
        $data['suplier'] = Suplier::count();
        $data['item_masuk'] = ItemMasuk::join('transaksi_masuk', 'item_masuk.id_transaksi', '=', 'transaksi_masuk.id_transaksi')
            ->where('transaksi_masuk.deleted_at', null)
            ->count();
        $data['item_keluar'] = ItemKeluar::join('transaksi_keluar', 'item_keluar.id_transaksi', '=', 'transaksi_keluar.id_transaksi')
            ->where('transaksi_keluar.deleted_at', null)
            ->count();
        $data['notif'] = Stok::where('qoh', '<=', '5')->get();
        return view('dashboard', $data);
    }
}
