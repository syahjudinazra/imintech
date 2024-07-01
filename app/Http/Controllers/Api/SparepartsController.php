<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spareparts;
use Illuminate\Http\Request;

class SparepartsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = Spareparts::all();

        $formattedSpareparts = $spareParts->map(function ($sparePart) {

            return [
                'id' => $sparePart->id,
                'nosparepart' => $sparePart->nosparepart,
                'tipe' => $sparePart->tipe,
                'nama' => $sparePart->nama,
                'quantity' => $sparePart->quantity,
                'harga' => $sparePart->harga,
                'created_at' => $sparePart->created_at,
                'updated_at' => $sparePart->updated_at,
                'deleted_at' => $sparePart->deleted_at,
            ];
        });

        // Return JSON response
        return response()->json([
            'messages' => 'Data ditemukan',
            'data' => $formattedSpareparts
        ]);
    }

    public function updateQuantity(Request $request, $id)
    {
        $spareParts = SpareParts::findOrFail($id);
        $quantity = $request->input('quantity');

        if (is_null($quantity) || !is_numeric($quantity) || $quantity <= 0) {
            return response()->json([
                'messages' => 'Quantity must be a positive number',
            ], 400);
        }

        if ($request->has('add')) {
            $spareParts->quantity += $quantity;
            $spareParts->save();
            return response()->json([
                'messages' => 'Berhasil tambah quantity',
                'data' => $spareParts
            ]);
        } elseif ($request->has('reduce')) {
            if ($spareParts->quantity >= $quantity) {
                $spareParts->quantity -= $quantity;
                $spareParts->save();
                return response()->json([
                    'messages' => 'Berhasil kurangi quantity',
                    'data' => $spareParts
                ]);
            } else {
                return response()->json([
                    'messages' => 'Jumlah yang dikurangi melebihi quantity',
                    'data' => $spareParts
                ], 400);
            }
        } else {
            return response()->json([
                'messages' => 'Invalid request, must contain either add or reduce',
            ], 400);
        }
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
            $spareParts = Spareparts::create($request->all());

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $spareParts
            ], 200);
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
        try {
            $spareParts = Spareparts::findOrFail($id);

            // Format the service data
            $formattedSpareparts = [
                'id' => $spareParts->id,
                'nosparepart' => $spareParts->nosparepart,
                'tipe' => $spareParts->tipe,
                'nama' => $spareParts->nama,
                'quantity' => $spareParts->quantity,
                'harga' => $spareParts->harga,
                'created_at' => $spareParts->created_at,
                'updated_at' => $spareParts->updated_at,
                'deleted_at' => $spareParts->deleted_at,
            ];

            return response()->json([
                'message' => 'Data ditemukan',
                'data' => $formattedSpareparts
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
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
            $spareParts = Spareparts::findOrFail($id);

            $spareParts->update($request->all());

            // Format the service data
            $formattedSpareparts = [
                'id' => $spareParts->id,
                'nosparepart' => $spareParts->nosparepart,
                'tipe' => $spareParts->tipe,
                'nama' => $spareParts->nama,
                'quantity' => $spareParts->quantity,
                'harga' => $spareParts->harga,
                'created_at' => $spareParts->created_at,
                'updated_at' => $spareParts->updated_at,
                'deleted_at' => $spareParts->deleted_at,
            ];

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $formattedSpareparts
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal diubah: ' . $e->getMessage()], 500);
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
