<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "stok",
            "title" => "Stok Barang"
        ];
        $data['stok'] = Stok::orderBy('created_at', 'desc')->get();
        return view('stok', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'code' => 'required|max:100|min:2',
            'description' => 'required|min:2',
            'qoh' => 'required|numeric',
            'unit_value' => 'required|numeric',
            'location' => 'required|max:100',
            'bin_loc' => 'required|max:100',
        ]);

        $cek = Stok::where('stock_code', $request->code)->get()->count();
        if ($cek > 0) {
            $result['status'] = '00';
            $result['msg'] = 'Kode sudah digunakan!!';
        } else {
            $data['id_stok'] = null;
            $data['stock_code'] = $request->code;
            $data['description'] = $request->description;
            $data['qoh'] = $request->qoh;
            $data['unit_value'] = $request->unit_value;
            $data['location'] = $request->location;
            $data['bin_loc'] = $request->bin_loc;

            if (Stok::create($data)) {
                $result['status'] = '1';
                $result['msg'] = 'Berhasil menambahkan data';
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Gagal menambahkan data';
            }
        }
        return response()->json($result);
    }


    public function detail(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);

        $id = decrypt_url($request->id);
        $stok = Stok::where('id_stok', $id)->get();
        if (count($stok) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $stok[0]->id_stok = encrypt_url($stok[0]->id_stok);
            $result['stok'] = $stok;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }

        return response()->json($result);
    }

    public function update(Request $request)
    {
        request()->validate([
            'code' => 'required|max:100|min:2',
            'description' => 'required|min:2',
            'qoh' => 'required|numeric',
            'unit_value' => 'required|numeric',
            'location' => 'required|max:100',
            'bin_loc' => 'required|max:100',
        ]);

        $id = decrypt_url($request->id);
        $cek = Stok::where('stock_code', $request->code)->where('id_stok', '!=', $id)->get()->count();
        if ($cek > 0) {
            $result['status'] = '00';
            $result['msg'] = 'Kode sudah digunakan!!';
        } else {
            $data['stock_code'] = $request->code;
            $data['description'] = $request->description;
            $data['qoh'] = $request->qoh;
            $data['unit_value'] = $request->unit_value;
            $data['location'] = $request->location;
            $data['bin_loc'] = $request->bin_loc;

            if (Stok::where('id_stok', $id)->update($data)) {
                $result['status'] = '1';
                $result['msg'] = 'Berhasil perbarui data';
            } else {
                $result['status'] = '0';
                $result['msg'] = 'Gagal perbarui data';
            }
        }

        return response()->json($result);
    }

    public function destroy(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);
        if (Stok::where('id_stok', decrypt_url($request->id))->delete()) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }

        return response()->json($result);
    }
}
