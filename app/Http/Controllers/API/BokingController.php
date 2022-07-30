<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Boking;
use Illuminate\Support\Facades\Validator;

class BokingController extends Controller
{
    // tampil
    public function index()
    {
        $datas = Boking::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }
    // tampil berdasarkan id
    public function show($id)
    {
        $data = Boking::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }
    // create
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [

            'member_id' => 'required|numeric',
            'paket_id' => 'required|numeric',
            'duration' => 'required',
            'tanggal' => 'required',

        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Boking::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }
    // update
    public function update(Request $request, $id)
    {
        $bokings = Boking::where('id', $id)->get()->first();
        if (empty($bokings)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'member_id' => 'required|numeric',
                'paket_id' => 'required|numeric',
                'duration' => 'required',
                'tanggal' => 'required',
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $bokings->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $bokings], 200);
        }
    }
    // Hapus
    public function destroy($id)
    {
        $bokings = Boking::find($id);
        if (empty($bokings)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $bokings->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $bokings]);
    }



    // tes relasi
   public function indexRelasi()
   {
       $bokings = Boking::with('member','paket')->get();
       return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $bokings], 200);
   }
}
