<?php

namespace App\Http\Controllers\Api;

use App\Models\Firmwares;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirmwaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $firmwares = Firmwares::all();
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $firmwares
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required',
            'versi' => 'required|max:255',
            'android' => 'required|max:255',
            'flash' => 'required|max:255',
            'ota' => 'required|max:255',
            'kategori' => 'required|max:255',
            'gambar' => 'image|mimes:jpg,png|max:2048',
        ]);

        try {
            $firmwares = new Firmwares();

            $gambar = $request->file('gambar');
            if ($gambar) {
                $gambar_name = time() . '_' . $gambar->getClientOriginalName();
                $gambar->move(public_path('images'), $gambar_name);
                $firmwares->gambar = $gambar_name;
            }

            $firmwares->tipe = $request->input('tipe');
            $firmwares->versi = $request->input('versi');
            $firmwares->android = $request->input('android');
            $firmwares->flash = $request->input('flash');
            $firmwares->ota = $request->input('ota');
            $firmwares->kategori = $request->input('kategori');

            $firmwares->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $firmwares
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $firmwares = Firmwares::findOrFail($id);
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $firmwares
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipe' => 'required',
            'versi' => 'required|max:255',
            'android' => 'required|max:255',
            'flash' => 'required|max:255',
            'ota' => 'required|max:255',
            'kategori' => 'required|max:255',
            'gambar' => 'image|mimes:jpg,png|max:2048',
        ]);

        try {
            $firmwares = Firmwares::findOrFail($id);

            // Update firmware data
            $firmwares->update([
                'tipe' => $request->input('tipe'),
                'versi' => $request->input('versi'),
                'android' => $request->input('android'),
                'flash' => $request->input('flash'),
                'ota' => $request->input('ota'),
                'kategori' => $request->input('kategori'),
            ]);

            if ($request->hasFile('gambar')) {
                $gambar = $request->file('gambar');
                $gambar_name = time() . '_' . $gambar->getClientOriginalName();
                $gambar->move(public_path('images'), $gambar_name);

                // Delete old image if exists
                if ($firmwares->gambar) {
                    $old_image_path = public_path('images') . '/' . $firmwares->gambar;
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }

                $firmwares->gambar = $gambar_name;
                $firmwares->save();
            }

            return response()->json([
                'message' => 'Data berhasil diupdate',
                'data' => $firmwares
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal mengupdate data: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $firmwares = Firmwares::find($id);

        if (!$firmwares) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        $firmwares->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
