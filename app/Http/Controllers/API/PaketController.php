<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    // tampil
    public function index()
    {
        $datas = Paket::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $data = Paket::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [

            'paket' => 'required',
            'fasilitas' => 'required',
            'harga' => 'required|numeric',
            'keterangan' => 'required',

        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Paket::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $pakets = Paket::where('id', $id)->get()->first();
        if (empty($pakets)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'paket' => 'required',
                'fasilitas' => 'required',
                'harga' => 'required|numeric',
                'keterangan' => 'required',

            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $pakets->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $pakets], 200);
        }
    }
    // Hapus
    public function destroy($id)
    {
        $pakets = Paket::find($id);
        if (empty($pakets)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $pakets->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $pakets]);
    }



    // tes relasi
    public function indexRelasi()
    {
        $pakets = Paket::with('boking')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $pakets], 200);
    }
}
