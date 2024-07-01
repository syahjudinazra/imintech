<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StocksSku;
use Illuminate\Http\Request;

class StocksSkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocksSku = StocksSku::all();
        return response()->json([
            'message' => 'Data ditemukan',
            'data' => $stocksSku
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
            $stocksSku = new StocksSku();
            $stocksSku->name = $request->input('name');

            $stocksSku->save();

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $stocksSku
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
            $stocksSku = StocksSku::findOrFail($id);

            $stocksSku->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $stocksSku
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
        $stocksSku = StocksSku::find($id);

        if (!$stocksSku) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $stocksSku->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
