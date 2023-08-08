<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{

    public function index()
    {
        $data['web'] = [
            "page" => "suplier",
            "title" => "Data Suplier"
        ];
        $data['suplier'] = Suplier::orderBy('created_at', 'desc')->get();
        return view('suplier', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required|max:100|min:2',
            'alamat' => 'required|max:255|min:2',
            'telepon' => 'required|max:20|min:3',
        ]);

        $data['id_suplier'] = null;
        $data['nama_suplier'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['telepon'] = $request->telepon;

        if (Suplier::create($data)) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menambahkan data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menambahkan data';
        }
        return response()->json($result);
    }


    public function detail(Request $request)
    {
        request()->validate([
            'id' => 'required',
        ]);

        $id = decrypt_url($request->id);
        $suplier = Suplier::where('id_suplier', $id)->get();
        if (count($suplier) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $suplier[0]->id_suplier = encrypt_url($suplier[0]->id_suplier);
            $result['suplier'] = $suplier;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }

        return response()->json($result);
    }

    public function update(Request $request)
    {
        request()->validate([
            'nama' => 'required|max:100|min:2',
            'alamat' => 'required|max:255|min:2',
            'telepon' => 'required|max:20|min:3',
        ]);

        $id = decrypt_url($request->id);
        $data['nama_suplier'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['telepon'] = $request->telepon;

        if (Suplier::where('id_suplier', $id)->update($data)) {
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
        request()->validate([
            'id' => 'required',
        ]);
        if (Suplier::where('id_suplier', decrypt_url($request->id))->delete()) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }

        return response()->json($result);
    }
}
