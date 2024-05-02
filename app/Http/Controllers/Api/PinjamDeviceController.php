<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PinjamDevice;
use Illuminate\Http\Request;

class PinjamDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjamDevice = PinjamDevice::all();
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $pinjamDevice
        ], 200);
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
            'name' => 'required|max:255',
        ]);

        try {
            // Create a new Spareparts instance
            $pinjamDevice = new PinjamDevice();
            $pinjamDevice->name = $request->input('name');

            $pinjamDevice->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $pinjamDevice
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
            'name' => 'required|max:255',
        ]);

        try {
            $pinjamDevice = PinjamDevice::findOrFail($id);

            $pinjamDevice->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $pinjamDevice
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pinjamDevice = PinjamDevice::find($id);

        if (!$pinjamDevice) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $pinjamDevice->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
