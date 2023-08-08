<?php

namespace App\Http\Controllers;

use App\Models\ItemMasuk;
use App\Models\Stok;
use App\Models\TransaksiMasuk;
use Illuminate\Http\Request;

class TransaksiMasukController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "transaksi_masuk",
            "title" => "Transaksi Barang Masuk"
        ];
        $data['transaksi'] = TransaksiMasuk::orderBy('created_at', 'desc')->get();
        foreach ($data['transaksi'] as $row) {
            $row->item = ItemMasuk::where('id_transaksi', $row->id_transaksi)->get()->count();
        }
        return view('transaksi_masuk', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'no' => 'required|max:30',
            'date' => 'required|max:30',
        ]);

        $data['id_transaksi'] = null;
        $data['no'] = $request->no;
        $data['date_transaksi'] = $request->date;

        $create = TransaksiMasuk::create($data)->id_transaksi;

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
            "page" => "transaksi_masuk",
            "title" => "Transaksi Barang Masuk"
        ];
        $data['transaksi'] = TransaksiMasuk::where('id_transaksi', $id)->get();
        $data['item'] = ItemMasuk::join('stok', 'item_masuk.id_stok', '=', 'stok.id_stok')
            ->select('item_masuk.*', 'stok.description', 'stok.stock_code')
            ->where('id_transaksi', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $data['barang'] = Stok::select('id_stok', 'stock_code', 'description', 'qoh')->orderBy('created_at', 'desc')->get();

        return view('transaksi_masuk_detail', $data);
    }

    public function update(Request $request)
    {
        request()->validate([
            'no' => 'required|max:30',
            'datetransaksi' => 'required|max:30',
        ]);

        $id = decrypt_url($request->id);
        $data['no'] = $request->no;
        $data['date_transaksi'] = $request->datetransaksi;
        $data['receiving_from'] = $request->receivingfrom;
        $data['carried_by'] = $request->carriedby;
        $data['checked_by'] = $request->checkedby;
        $data['position'] = $request->position;
        $data['date'] = $request->date;
        $data['receiving_name'] = $request->receivingname;
        $data['receiving_position'] = $request->receivingposition;
        $data['receiving_empl'] = $request->receivingempl;
        $data['receiving_date'] = $request->receivingdate;
        $data['inventory_name'] = $request->inventoryname;
        $data['inventory_position'] = $request->inventoryposition;
        $data['inventory_empl'] = $request->inventoryempl;
        $data['inventory_date'] = $request->inventorydate;
        $data['record_name'] = $request->recordname;
        $data['record_position'] = $request->recordposition;
        $data['record_empl'] = $request->recordempl;
        $data['record_date'] = $request->recorddate;
        $data['receiving_signature'] = $request->receivingsignature;
        $data['inventory_signature'] = $request->inventorysignature;
        $data['record_signature'] = $request->recordsignature;

        if (TransaksiMasuk::where('id_transaksi', $id)->update($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil perbarui data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal perbarui data';
        }
        return response()->json($result);
    }

    public function store_item(Request $request)
    {
        request()->validate([
            'code' => 'required',
            'received' => 'required|numeric',
            'hand' => 'required|numeric',
        ]);

        $data['id_item'] = null;
        $data['id_transaksi'] = decrypt_url($request->id_transaksi);
        $data['po_number'] = $request->po;
        $data['id_stok'] = decrypt_url($request->code);
        $data['uoi'] = $request->uoi;
        $data['on_hand'] = $request->hand;
        $data['received'] = $request->received;
        $data['balance'] = $request->balance;
        $data['min_max'] = $request->min;
        $data['bin_loc'] = $request->bin;
        $data['doc_loc'] = $request->doc;
        $data['remarks'] = $request->remarks;
        if (ItemMasuk::create($data)) {
            $stok = Stok::where('id_stok', $data['id_stok'])->get();
            $update['qoh'] = $stok[0]->qoh + $data['received'];
            Stok::where('id_stok', $data['id_stok'])->update($update);
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menambahkan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menambahkan data';
        }
        return response()->json($result);
    }

    public function destroy_item(Request $request)
    {
        $id = decrypt_url($request->id);
        if (ItemMasuk::where('id_item', $id)->delete()) {
            $detail = ItemMasuk::select('received', 'id_stok')->where('id_item', $id)->withTrashed()->get();
            $stok = Stok::select('qoh')->where('id_stok', $detail[0]->id_stok)->get();
            $update['qoh'] = $stok[0]->qoh - $detail[0]->received;
            Stok::where('id_stok', $detail[0]->id_stok)->update($update);
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }
        return response()->json($result);
    }

    public function detail_item(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);

        $id = decrypt_url($request->id);
        $item = ItemMasuk::join('stok', 'item_masuk.id_stok', '=', 'stok.id_stok')
            ->select('item_masuk.*', 'stok.stock_code', 'stok.description')
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
            'received' => 'required|numeric',
            'hand' => 'required|numeric',
        ]);
        $id = decrypt_url($request->id);;
        $data['po_number'] = $request->po;
        $data['uoi'] = $request->uoi;
        $data['on_hand'] = $request->hand;
        $data['received'] = $request->received;
        $data['balance'] = $request->balance;
        $data['min_max'] = $request->min;
        $data['bin_loc'] = $request->bin;
        $data['doc_loc'] = $request->doc;
        $data['remarks'] = $request->remarks;

        $stok = Stok::where('id_stok', decrypt_url($request->idstok))->get();
        if (ItemMasuk::where('id_item', $id)->update($data)) {
            if ($request->receivedold > $request->received) {
                $update['qoh'] = $stok[0]->qoh - ($request->receivedold - $request->received);
                Stok::where('id_stok', decrypt_url($request->idstok))->update($update);
            } elseif ($request->receivedold < $request->received) {
                $update['qoh'] = $stok[0]->qoh + ($request->received - $request->receivedold);
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

    public function destroy(Request $request)
    {
        $id = decrypt_url($request->id);
        if (TransaksiMasuk::where('id_transaksi', $id)->delete()) {
            $item = ItemMasuk::select('received', 'id_stok')->where('id_transaksi', $id)->get();
            foreach ($item as $row) {
                $stok = Stok::select('qoh')->where('id_stok', $row->id_stok)->get();
                $update['qoh'] = $stok[0]->qoh - $row->received;
                Stok::where('id_stok', $row->id_stok)->update($update);
            }
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }
        return response()->json($result);
    }
}
