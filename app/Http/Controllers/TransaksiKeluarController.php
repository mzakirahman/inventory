<?php

namespace App\Http\Controllers;

use App\Models\ItemKeluar;
use App\Models\Stok;
use App\Models\TransaksiKeluar;
use Illuminate\Http\Request;

class TransaksiKeluarController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "transaksi_keluar",
            "title" => "Transaksi Barang Keluar"
        ];
        $data['transaksi'] = TransaksiKeluar::orderBy('created_at', 'desc')->get();
        foreach ($data['transaksi'] as $row) {
            $row->item = ItemKeluar::where('id_transaksi', $row->id_transaksi)->get()->count();
        }
        return view('transaksi_keluar', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'from' => 'required|max:30',
            'to' => 'required|max:30',
            'serial' => 'required|max:20',
        ]);

        $data['id_transaksi'] = null;
        $data['from'] = $request->from;
        $data['to'] = $request->to;
        $data['company'] = $request->company;
        $data['serial'] = $request->serial;
        $data['vessel'] = $request->vessel;
        $data['etd'] = $request->etd;
        $data['eta'] = $request->eta;
        $data['vogaye'] = $request->vogaye;

        $create = TransaksiKeluar::create($data)->id_transaksi;

        if ($create != "") {
            $result['status'] = '1';
            $result['id'] = encrypt_int($create);
            $result['msg'] = 'Berhasil menambahkan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menambahkan data';
        }
        return response()->json($result);
    }

    public function detail($id)
    {
        $id = decrypt_int($id);
        $data['web'] = [
            "page" => "transaksi_keluar",
            "title" => "Transaksi Barang Keluar"
        ];
        $data['transaksi'] = TransaksiKeluar::where('id_transaksi', $id)->get();
        $data['item'] = ItemKeluar::join('stok', 'item_keluar.vocab_number', '=', 'stok.id_stok')
            ->select('item_keluar.*', 'stok.description', 'stok.stock_code')
            ->where('id_transaksi', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $data['barang'] = Stok::select('id_stok', 'stock_code', 'description', 'qoh')->orderBy('created_at', 'desc')->get();

        return view('transaksi_keluar_detail', $data);
    }

    public function update(Request $request)
    {
        request()->validate([
            'from' => 'required|max:30',
            'to' => 'required|max:30',
            'serial' => 'required|max:20',
        ]);

        $id = decrypt_url($request->id);
        $data['from'] = $request->from;
        $data['to'] = $request->to;
        $data['company'] = $request->company;
        $data['serial'] = $request->serial;
        $data['vessel'] = $request->vessel;
        $data['etd'] = $request->etd;
        $data['eta'] = $request->eta;
        $data['vogaye'] = $request->vogaye;
        $data['consignor_empl'] = $request->consignorempl;
        $data['consignor_signature'] = $request->consignorsignature;
        $data['consignor_name'] = $request->consignorname;
        $data['consignor_date'] = $request->consignordate;
        $data['consignee_empl'] = $request->consigneeempl;
        $data['consignee_signature'] = $request->consigneesignature;
        $data['consignee_name'] = $request->consigneename;
        $data['consignee_date'] = $request->consigneedate;
        $data['stock_card_empl'] = $request->stockcardempl;
        $data['stock_card_signature'] = $request->stockcardsignature;
        $data['stock_card_name'] = $request->stockcardname;
        $data['stock_card_date'] = $request->stockcarddate;
        $data['mmis_empl'] = $request->mmisempl;
        $data['mmis_signature'] = $request->mmissignature;
        $data['mmis_name'] = $request->mmisname;
        $data['mmis_date'] = $request->mmisdate;


        if (TransaksiKeluar::where('id_transaksi', $id)->update($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menyimpan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menyimpan data';
        }
        return response()->json($result);
    }

    public function destroy(Request $request)
    {
        $id = decrypt_url($request->id);
        if (TransaksiKeluar::where('id_transaksi', $id)->delete()) {
            $item = ItemKeluar::select('qty', 'vocab_number')->where('id_transaksi', $id)->get();
            foreach ($item as $row) {
                $stok = Stok::select('qoh')->where('id_stok', $row->vocab_number)->get();
                $update['qoh'] = $stok[0]->qoh + $row->qty;
                Stok::where('id_stok', $row->vocab_number)->update($update);
            }
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }
        return response()->json($result);
    }

    public function store_item(Request $request)
    {
        request()->validate([
            'vocab' => 'required',
            'qty' => 'required',
        ]);

        $data['id_item'] = null;
        $data['id_transaksi'] = decrypt_url($request->id_transaksi);
        $data['vocab_number'] = decrypt_url($request->vocab);
        $data['uom'] = $request->uom;
        $data['qty'] = $request->qty;
        $data['order_no'] = $request->orderno;
        $data['remaks'] = $request->remaks;
        if (ItemKeluar::create($data)) {
            $update['qoh'] = $request->qoh - $data['qty'];
            Stok::where('id_stok', $data['vocab_number'])->update($update);
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menambahkan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menambahkan data';
        }
        return response()->json($result);
    }

    public function detail_item(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);

        $id = decrypt_url($request->id);
        $item = ItemKeluar::join('stok', 'item_keluar.vocab_number', '=', 'stok.id_stok')
            ->where('id_item', $id)
            ->get();
        if (count($item) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $item[0]['id_item'] = encrypt_url($item[0]['id_item']);
            $item[0]['id_stok'] = encrypt_url($item[0]['id_stok']);
            $result['item'] = $item;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }

        return response()->json($result);
    }

    public function update_item(Request $request)
    {
        request()->validate([
            'vocab' => 'required',
            'qty' => 'required',
        ]);

        $id = decrypt_url($request->id);
        $data['uom'] = $request->uom;
        $data['qty'] = $request->qty;
        $data['order_no'] = $request->orderno;
        $data['remaks'] = $request->remaks;
        if (ItemKeluar::where('id_item', $id)->update($data)) {
            if ($request->qty > $request->qtyold) {
                $update['qoh'] = $request->qoh - ($request->qty - $request->qtyold);
                Stok::where('id_stok', decrypt_url($request->idstok))->update($update);
            } elseif ($request->qty < $request->qtyold) {
                $update['qoh'] = $request->qoh + ($request->qtyold - $request->qty);
                Stok::where('id_stok', decrypt_url($request->idstok))->update($update);
            }

            $result['status'] = '1';
            $result['msg'] = 'Berhasil perbarui data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal perbarui data';
        }
        return response()->json($result);
    }

    public function destroy_item(Request $request)
    {
        $id = decrypt_url($request->id);
        if (ItemKeluar::where('id_item', $id)->delete()) {
            $detail = ItemKeluar::select('qty', 'vocab_number')->where('id_item', $id)->withTrashed()->get();
            $stok = Stok::select('qoh')->where('id_stok', $detail[0]->vocab_number)->get();
            $update['qoh'] = $stok[0]->qoh + $detail[0]->qty;
            Stok::where('id_stok', $detail[0]->vocab_number)->update($update);
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }
        return response()->json($result);
    }
}
