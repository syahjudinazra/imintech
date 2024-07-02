<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stocks;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            // Check if user is authenticated
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            // Fetch paginated stocks
            $stock = Stocks::paginate(10);

            // Format stocks data
            $formattedStocks = $stock->map(function ($stock) {
                return [
                    'id' => $stock->id,
                    'serialnumber' => $stock->serialnumber,
                    'stocksdevice' => [
                        'id' => $stock->stockTipe->id,
                        'name' => $stock->stockTipe->name
                    ],
                    'stockssku' => [
                        'id' => $stock->stocksKeeping->id,
                        'name' => $stock->stocksKeeping->name
                    ],
                    'noinvoice' => $stock->noinvoice,
                    'tanggalmasuk' => $stock->tanggalmasuk,
                    'tanggalkeluar' => $stock->tanggalkeluar,
                    'pelanggan' => $stock->pelanggan,
                    'lokasi' => $stock->lokasi,
                    'keterangan' => $stock->keterangan,
                    'status' => $stock->status,
                    'created_at' => $stock->created_at,
                    'updated_at' => $stock->updated_at,
                    'deleted_at' => $stock->deleted_at,
                ];
            });

            // Return JSON response with formatted data and pagination meta
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedStocks,
                'meta' => [
                    'current_page' => $stock->currentPage(),
                    'last_page' => $stock->lastPage(),
                    'per_page' => $stock->perPage(),
                    'total' => $stock->total(),
                ]
            ]);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json([
                'messages' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function gudang(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Stocks::where('status', 'Gudang')
                ->orderByDesc('created_at');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('serialnumber', 'like', "%{$search}%")
                        ->orWhere('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('tanggalkeluar', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhereHas('stockTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $stockGudang = $query->paginate(10);

            $formattedStocks = $stockGudang->map(function ($gudang) {

                return [
                    'id' => $gudang->id,
                    'serialnumber' => $gudang->serialnumber,
                    'stocksdevice' => [
                        'id' => $gudang->stockTipe->id,
                        'name' => $gudang->stockTipe->name
                    ],
                    'stockssku' => [
                        'id' => $gudang->stocksKeeping->id,
                        'name' => $gudang->stocksKeeping->name
                    ],
                    'noinvoice' => $gudang->noinvoice,
                    'tanggalmasuk' => $gudang->tanggalmasuk,
                    'tanggalkeluar' => $gudang->tanggalkeluar,
                    'pelanggan' => $gudang->pelanggan,
                    'lokasi' => $gudang->lokasi,
                    'keterangan' => $gudang->keterangan,
                    'status' => $gudang->status,
                    'created_at' => $gudang->created_at,
                    'updated_at' => $gudang->updated_at,
                    'deleted_at' => $gudang->deleted_at,
                ];
            });

            // Return JSON response
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedStocks,
                'pagination' => [
                    'current_page' => $stockGudang->currentPage(),
                    'last_page' => $stockGudang->lastPage(),
                    'per_page' => $stockGudang->perPage(),
                    'total' => $stockGudang->total(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function diservice(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Stocks::where('status', 'Diservice')
                ->orderByDesc('created_at');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('serialnumber', 'like', "%{$search}%")
                        ->orWhere('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('tanggalkeluar', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhereHas('stockTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $stockDiservice = $query->paginate(10);

            $formattedStocks = $stockDiservice->map(function ($diservice) {

                return [
                    'id' => $diservice->id,
                    'serialnumber' => $diservice->serialnumber,
                    'stocksdevice' => [
                        'id' => $diservice->stockTipe->id,
                        'name' => $diservice->stockTipe->name
                    ],
                    'stockssku' => [
                        'id' => $diservice->stocksKeeping->id,
                        'name' => $diservice->stocksKeeping->name
                    ],
                    'noinvoice' => $diservice->noinvoice,
                    'tanggalmasuk' => $diservice->tanggalmasuk,
                    'tanggalkeluar' => $diservice->tanggalkeluar,
                    'pelanggan' => $diservice->pelanggan,
                    'lokasi' => $diservice->lokasi,
                    'keterangan' => $diservice->keterangan,
                    'status' => $diservice->status,
                    'created_at' => $diservice->created_at,
                    'updated_at' => $diservice->updated_at,
                    'deleted_at' => $diservice->deleted_at,
                ];
            });

            // Return JSON response
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedStocks,
                'pagination' => [
                    'current_page' => $stockDiservice->currentPage(),
                    'last_page' => $stockDiservice->lastPage(),
                    'per_page' => $stockDiservice->perPage(),
                    'total' => $stockDiservice->total(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function dipinjam(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Stocks::where('status', 'Dipinjam')
                ->orderByDesc('created_at');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('serialnumber', 'like', "%{$search}%")
                        ->orWhere('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('tanggalkeluar', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhereHas('stockTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $stockDipinjam = $query->paginate(10);

            $formattedStocks = $stockDipinjam->map(function ($dipinjam) {

                return [
                    'id' => $dipinjam->id,
                    'serialnumber' => $dipinjam->serialnumber,
                    'stocksdevice' => [
                        'id' => $dipinjam->stockTipe->id,
                        'name' => $dipinjam->stockTipe->name
                    ],
                    'stockssku' => [
                        'id' => $dipinjam->stocksKeeping->id,
                        'name' => $dipinjam->stocksKeeping->name
                    ],
                    'noinvoice' => $dipinjam->noinvoice,
                    'tanggalmasuk' => $dipinjam->tanggalmasuk,
                    'tanggalkeluar' => $dipinjam->tanggalkeluar,
                    'pelanggan' => $dipinjam->pelanggan,
                    'lokasi' => $dipinjam->lokasi,
                    'keterangan' => $dipinjam->keterangan,
                    'status' => $dipinjam->status,
                    'created_at' => $dipinjam->created_at,
                    'updated_at' => $dipinjam->updated_at,
                    'deleted_at' => $dipinjam->deleted_at,
                ];
            });

            // Return JSON response
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedStocks,
                'pagination' => [
                    'current_page' => $stockDipinjam->currentPage(),
                    'last_page' => $stockDipinjam->lastPage(),
                    'per_page' => $stockDipinjam->perPage(),
                    'total' => $stockDipinjam->total(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function terjual(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Stocks::where('status', 'Terjual')
                ->orderByDesc('created_at');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('serialnumber', 'like', "%{$search}%")
                        ->orWhere('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('tanggalkeluar', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhere('lokasi', 'like', "%{$search}%")
                        ->orWhereHas('stockTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $stockTerjual = $query->paginate(10);

            $formattedStocks = $stockTerjual->map(function ($terjual) {

                return [
                    'id' => $terjual->id,
                    'serialnumber' => $terjual->serialnumber,
                    'stocksdevice' => [
                        'id' => $terjual->stockTipe->id,
                        'name' => $terjual->stockTipe->name
                    ],
                    'stockssku' => [
                        'id' => $terjual->stocksKeeping->id,
                        'name' => $terjual->stocksKeeping->name
                    ],
                    'noinvoice' => $terjual->noinvoice,
                    'tanggalmasuk' => $terjual->tanggalmasuk,
                    'tanggalkeluar' => $terjual->tanggalkeluar,
                    'pelanggan' => $terjual->pelanggan,
                    'lokasi' => $terjual->lokasi,
                    'keterangan' => $terjual->keterangan,
                    'status' => $terjual->status,
                    'created_at' => $terjual->created_at,
                    'updated_at' => $terjual->updated_at,
                    'deleted_at' => $terjual->deleted_at,
                ];
            });

            // Return JSON response
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedStocks,
                'pagination' => [
                    'current_page' => $stockTerjual->currentPage(),
                    'last_page' => $stockTerjual->lastPage(),
                    'per_page' => $stockTerjual->perPage(),
                    'total' => $stockTerjual->total(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
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
            'serialnumber' => 'required|max:255',
            'stocksdevice_id' => 'required|max:255',
            'stocks_sku_id' => 'required|max:255',
            'noinvoice' => 'required|max:255',
            'tanggalmasuk' => 'required|max:255',
            'tanggalkeluar' => 'max:255',
            'pelanggan' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        try {
            $stock = Stocks::create($request->all());

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $stock
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
        try {
            $stock = Stocks::findOrFail($id);

            return response()->json([
                'message' => 'Data berhasil ditemukan',
                'data' => $stock
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
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
            'serialnumber' => 'required|max:255',
            'stocksdevice_id' => 'max:255',
            'stocks_sku_id' => 'max:255',
            'noinvoice' => 'required|max:255',
            'tanggalmasuk' => 'required|max:255',
            'tanggalkeluar' => 'max:255',
            'pelanggan' => 'required|max:255',
            'lokasi' => 'required|max:255',
            'keterangan' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        try {
            $stock = Stocks::findOrFail($id);

            $stock->update($request->all());

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $stock
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
        $stock = Stocks::find($id);

        if (!$stock) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $stock->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
