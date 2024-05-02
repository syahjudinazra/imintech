<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ServicesDevice;
use Illuminate\Http\Request;

class ServicesDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicesDevice = ServicesDevice::all();
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $servicesDevice
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
            $servicesDevice = new ServicesDevice();
            $servicesDevice->name = $request->input('name');

            $servicesDevice->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $servicesDevice
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
            $servicesDevice = ServicesDevice::findOrFail($id);

            $servicesDevice->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $servicesDevice
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
        $servicesDevice = ServicesDevice::find($id);

        if (!$servicesDevice) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $servicesDevice->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
