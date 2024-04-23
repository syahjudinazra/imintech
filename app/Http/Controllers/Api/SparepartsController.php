<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spareparts;
use App\Models\SparepartsDevice;
use Illuminate\Http\Request;

class SparepartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = Spareparts::with('SparepartsDevice')->latest()->get();

        return response()->json(['data' => $spareParts]);
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
            'nosparepart' => 'required|max:255',
            'sparepartsdevice_id' => 'required',
            'nama' => 'required|max:255',
            'quantity' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        try {
            // Create a new Spareparts instance
            $spareParts = new Spareparts();
            $spareParts->nosparepart = $request->input('nosparepart');
            $spareParts->sparepartsdevice_id = $request->input('sparepartsdevice_id');
            $spareParts->nama = $request->input('nama');
            $spareParts->quantity = $request->input('quantity');
            $spareParts->harga = $request->input('harga');

            // Save the Spareparts instance
            $spareParts->save();

            return response()->json(['message' => 'Data berhasil ditambahkan', 'status' => true]);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage(), 'status' => false], 500);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $spareparts = Spareparts::find($id);

        if (!$spareparts) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }

        $spareparts->delete();

        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
