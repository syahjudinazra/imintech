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
        // $spareParts = Spareparts::with('SparepartsDevice')->latest()->get();
        $spareParts = Spareparts::paginate(10);
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
            'tipe' => 'required',
            'nama' => 'required|max:255',
            'quantity' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        try {
            // Create a new Spareparts instance
            $spareParts = new Spareparts();
            $spareParts->nosparepart = $request->input('nosparepart');
            $spareParts->tipe = $request->input('tipe');
            $spareParts->nama = $request->input('nama');
            $spareParts->quantity = $request->input('quantity');
            $spareParts->harga = $request->input('harga');

            // Save the Spareparts instance
            $spareParts->save();

            return response()->json(['message' => 'Data berhasil ditambahkan']);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $spareParts = Spareparts::findOrFail($id);
        return response()->json(['data' => $spareParts]);
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
            'nosparepart' => 'required|max:255',
            'tipe' => 'required',
            'nama' => 'required|max:255',
            'quantity' => 'required|numeric',
            'harga' => 'required|numeric',
        ]);

        try {
            // Find the Spareparts instance
            $spareParts = Spareparts::findOrFail($id);

            // Update the Spareparts instance
            $spareParts->update([
                'nosparepart' => $request->input('nosparepart'),
                'tipe' => $request->input('tipe'),
                'nama' => $request->input('nama'),
                'quantity' => $request->input('quantity'),
                'harga' => $request->input('harga'),
            ]);

            // Return success response
            return response()->json(['message' => 'Data berhasil diperbarui'], 204);
        } catch (\Exception $e) {
            // Return error response
            return response()->json(['message' => 'Gagal memperbarui data: ' . $e->getMessage()], 500);
        }
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
