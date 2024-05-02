<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StocksDevice;
use Illuminate\Http\Request;

class StocksDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocksDevice = StocksDevice::all();
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $stocksDevice
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
            $stocksDevice = new StocksDevice();
            $stocksDevice->name = $request->input('name');

            $stocksDevice->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $stocksDevice
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
            $stocksDevice = StocksDevice::findOrFail($id);

            $stocksDevice->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $stocksDevice
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
        $stocksDevice = StocksDevice::find($id);

        if (!$stocksDevice) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $stocksDevice->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
