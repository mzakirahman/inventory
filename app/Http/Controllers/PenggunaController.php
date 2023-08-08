<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $data['web'] = [
            "page" => "pengguna",
            "title" => "Data Pengguna"
        ];
        $data['pengguna'] = User::select('id_user', 'nama_user', 'username', 'role', 'foto')->orderBy('created_at', 'desc')->get();
        return view('pengguna', $data);
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required|max:30|min:2',
            'username' => 'required|max:30|min:2',
            'password' => 'required|max:50',
            'role' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:6000',
        ]);

        $cek_username = User::select('username')->where('username', $request->username)->get()->count();
        if ($cek_username > 0) {
            $result['status'] = '00';
            $result['msg'] = 'Username sudah digunakan!!';
        } else {
            $data['id_user'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $data['nama_user'] = $request->nama;
            $data['username'] = $request->username;
            $data['role'] = $request->role;
            $data['password'] = bcrypt(md5($request->password));

            $namaFoto = $data['username'] . rand(1, 9999) . '.' . $request->foto->extension();
            $folder = "files/user";
            $data['foto'] = $folder . '/' . $namaFoto;
            $request->foto->move(public_path($folder), $namaFoto);

            if (User::create($data)) {
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
        $pengguna = User::where('id_user', $id)->get();
        if (count($pengguna) > 0) {
            $result['status'] = '1';
            $result['msg'] = 'Data ditemukan';
            $pengguna[0]->id_user = encrypt_url($pengguna[0]->id_user);
            $result['pengguna'] = $pengguna;
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Data tidak ditemukan';
        }

        return response()->json($result);
    }

    public function update(Request $request)
    {
        request()->validate([
            'nama' => 'required|max:30|min:2',
            'username' => 'required|max:30|min:2',
            'password' => 'max:50',
            'role' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:6000',
        ]);
        $id = decrypt_url($request->id);
        $cek_username = User::select('username')->where('username', $request->username)->where('id_user', '!=', $id)->get()->count();
        if ($cek_username > 0) {
            $result['status'] = '00';
            $result['msg'] = 'Username sudah digunakan!!';
        } else {

            $data['nama_user'] = $request->nama;
            $data['username'] = $request->username;
            $data['role'] = $request->role;

            if (isset($request->password) && $request->password != "" && $request->password != null) {
                $data['password'] = bcrypt(md5($request->password));
            }
            if (isset($request->foto)) {
                $namaFoto = $data['username'] . rand(1, 9999) . '.' . $request->foto->extension();
                $folder = "files/user";
                $data['foto'] = $folder . '/' . $namaFoto;
                $request->foto->move(public_path($folder), $namaFoto);
            }
            if (User::where('id_user', $id)->update($data)) {
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
        if (User::find(decrypt_url($request->id))->delete()) {
            $result['status'] = '1';
            $result['msg'] = 'Berhasil menghapus data';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Gagal menghapus data';
        }

        return response()->json($result);
    }
}
