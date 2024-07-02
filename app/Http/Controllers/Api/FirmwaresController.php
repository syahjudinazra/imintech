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
    public function index(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $firmwares = Firmwares::all();
            $formattedFirmwares = $firmwares->map(function ($firmware) {
                return [
                    'id' => $firmware->id,
                    'tipe' => $firmware->tipe,
                    'versi' => $firmware->versi,
                    'android' => $firmware->android,
                    'flash' => $firmware->flash,
                    'ota' => $firmware->ota,
                    'kategori' => $firmware->kategori,
                    'gambar' => url('storage/gambar/' . $firmware->gambar),
                    'created_at' => $firmware->created_at,
                    'updated_at' => $firmware->updated_at,
                    'deleted_at' => $firmware->deleted_at
                ];
            });

            return response()->json([
                'message' => 'Data ditemukan',
                'data' => $formattedFirmwares,
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function table(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $firmwares = Firmwares::all();

            $formattedFirmwares = $firmwares->map(function ($firmware) {
                return [
                    'id' => $firmware->id,
                    'tipe' => $firmware->tipe,
                    'versi' => $firmware->versi,
                    'android' => $firmware->android,
                    'flash' => $firmware->flash,
                    'ota' => $firmware->ota,
                    'kategori' => $firmware->kategori,
                    'gambar' => url('storage/gambar/' . $firmware->gambar),
                    'created_at' => $firmware->created_at,
                    'updated_at' => $firmware->updated_at,
                    'deleted_at' => $firmware->deleted_at
                ];
            });

            // Return JSON response
            return response()->json([
                'message' => 'Data ditemukan',
                'data' => $formattedFirmwares,
            ], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tipe' => 'required',
                'versi' => 'required|max:255',
                'android' => 'required|max:255',
                'flash' => 'required|max:255',
                'ota' => 'max:255|nullable',
                'kategori' => 'required|max:255',
                'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $firmware = new Firmwares();
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('storage/gambar/', $filename);
                $firmware->gambar = $filename;
            }

            $firmware->tipe = $request->input('tipe');
            $firmware->versi = $request->input('versi');
            $firmware->android = $request->input('android');
            $firmware->flash = $request->input('flash');
            $firmware->ota = $request->input('ota') ?? '';
            $firmware->kategori = $request->input('kategori');

            $firmware->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $firmware
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipe' => 'required',
            'versi' => 'required|max:255',
            'android' => 'required|max:255',
            'flash' => 'required|max:255',
            'ota' => 'max:255|nullable',
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
                'ota' => $request->input('ota') ?? '',
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
                'message' => 'Data berhasil diubah',
                'data' => $firmwares
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal diubah: ' . $e->getMessage()], 500);
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
