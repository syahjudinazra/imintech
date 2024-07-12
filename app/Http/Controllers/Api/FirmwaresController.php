<?php

namespace App\Http\Controllers\Api;

use App\Models\Firmwares;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FirmwaresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $firmwares = Firmwares::all();
            $formattedFirmwares = $firmwares->map(function ($firmware) {
                return [
                    'id' => $firmware->id,
                    'tipe' => $firmware->tipe,
                    'versi' => $firmware->versi,
                    'android' => $firmware->android,
                    'flash' => $firmware->flash,
                    'ota' => $firmware->ota,
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
            $firmwares = Firmwares::all();

            $formattedFirmwares = $firmwares->map(function ($firmware) {
                return [
                    'id' => $firmware->id,
                    'tipe' => $firmware->tipe,
                    'versi' => $firmware->versi,
                    'android' => $firmware->android,
                    'flash' => $firmware->flash,
                    'ota' => $firmware->ota,
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
        $validated = $request->validate([
            'tipe' => 'required',
            'versi' => 'required|max:255',
            'android' => 'required|max:255',
            'flash' => 'nullable|max:255',
            'ota' => 'nullable|max:255',
        ]);

        $firmwares = Firmwares::create($validated);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $firmwares,
        ]);
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
        $validated = $request->validate([
            'tipe' => 'required',
            'versi' => 'required|max:255',
            'android' => 'required|max:255',
            'flash' => 'nullable|max:255',
            'ota' => 'nullable|max:255',
        ]);

        try {
            $firmwares = Firmwares::findOrFail($id);
            $firmwares->update($validated);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $firmwares->fresh(),
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
        try {
            Firmwares::findOrFail($id)->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal dihapus: ' . $e->getMessage()], 500);
        }
    }

}
