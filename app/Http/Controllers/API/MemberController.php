<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    // tampil
    public function index()
    {
        $datas = Member::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $data = Member::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [

            'nama' => 'required',
            'no_hp' => 'required|numeric',
            'email' => 'required',
            'alamat' => 'required',

        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Member::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $members = Member::where('id', $id)->get()->first();
        if (empty($members)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nama' => 'required',
                'no_hp' => 'required|numeric',
                'email' => 'required',
                'alamat' => 'required',
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $members->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $members], 200);
        }
    }
    // Hapus
    public function destroy($id)
    {
        $members = Member::find($id);
        if (empty($members)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $members->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $members]);
    }
}
