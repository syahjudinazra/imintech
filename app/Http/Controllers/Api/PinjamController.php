<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
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

            $query = Pinjam::where('status', 'Dipinjamkan')
                ->orderByDesc('tanggal');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggal', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('pinjamTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $pinjams = $query->paginate(10);

            $formattedPinjam = $pinjams->map(function ($pinjam) {
                return [
                    'id' => $pinjam->id,
                    'tanggal' => $pinjam->tanggal,
                    'serialnumber' => $pinjam->serialnumber,
                    'pinjamsdevice' => [
                        'id' => $pinjam->pinjamTipe->id,
                        'name' => $pinjam->pinjamTipe->name
                    ],
                    'ram' => $pinjam->ram,
                    'android' => $pinjam->android,
                    'pelanggan' => $pinjam->pelanggan,
                    'alamat' => $pinjam->alamat,
                    'sales' => $pinjam->sales,
                    'no_telp' => $pinjam->no_telp,
                    'pengirim' => $pinjam->pengirim,
                    'kelengkapankirim' => $pinjam->kelengkapankirim,
                    'tanggalkembali' => $pinjam->tanggalkembali,
                    'penerima' => $pinjam->penerima,
                    'kelengkapankembali' => $pinjam->kelengkapankembali,
                    'status' => $pinjam->status,
                    'created_at' => $pinjam->created_at,
                    'updated_at' => $pinjam->updated_at,
                    'deleted_at' => $pinjam->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedPinjam,
                'pagination' => [
                    'total' => $pinjams->total(),
                    'per_page' => $pinjams->perPage(),
                    'current_page' => $pinjams->currentPage(),
                    'last_page' => $pinjams->lastPage(),
                    'next_page_url' => $pinjams->nextPageUrl(),
                    'prev_page_url' => $pinjams->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function kembali(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Pinjam::where('status', 'Dikembalikan')
                ->orderByDesc('tanggal');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggal', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('pinjamTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $pinjams = $query->paginate(10);

            $formattedPinjam = $pinjams->map(function ($pinjam) {
                return [
                    'id' => $pinjam->id,
                    'tanggal' => $pinjam->tanggal,
                    'serialnumber' => $pinjam->serialnumber,
                    'pinjamsdevice' => [
                        'id' => $pinjam->pinjamTipe->id,
                        'name' => $pinjam->pinjamTipe->name
                    ],
                    'ram' => $pinjam->ram,
                    'android' => $pinjam->android,
                    'pelanggan' => $pinjam->pelanggan,
                    'alamat' => $pinjam->alamat,
                    'sales' => $pinjam->sales,
                    'no_telp' => $pinjam->no_telp,
                    'pengirim' => $pinjam->pengirim,
                    'kelengkapankirim' => $pinjam->kelengkapankirim,
                    'tanggalkembali' => $pinjam->tanggalkembali,
                    'penerima' => $pinjam->penerima,
                    'kelengkapankembali' => $pinjam->kelengkapankembali,
                    'status' => $pinjam->status,
                    'created_at' => $pinjam->created_at,
                    'updated_at' => $pinjam->updated_at,
                    'deleted_at' => $pinjam->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedPinjam,
                'pagination' => [
                    'total' => $pinjams->total(),
                    'per_page' => $pinjams->perPage(),
                    'current_page' => $pinjams->currentPage(),
                    'last_page' => $pinjams->lastPage(),
                    'next_page_url' => $pinjams->nextPageUrl(),
                    'prev_page_url' => $pinjams->previousPageUrl(),
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
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pinjamsdevice_id' => 'required|max:255',
            'ram' => 'required|max:255',
            'android' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'sales' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'pengirim' => 'required|max:255',
            'kelengkapankirim' => 'required|max:255',
            'tanggalkembali' => 'max:255',
            'penerima' => 'max:255',
            'kelengkapankembali' => 'max:255',
            'status' => 'max:255',
        ]);

        try {
            $pinjams = Pinjam::create($request->all());

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $pinjams
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
            $pinjams = Pinjam::findOrFail($id);

            return response()->json([
                'message' => 'Data berhasil ditemukan',
                'data' => $pinjams
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
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pinjamsdevice_id' => 'max:255',
            'ram' => 'required|max:255',
            'android' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'sales' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'pengirim' => 'required|max:255',
            'kelengkapankirim' => 'required|max:255',
            'tanggalkembali' => 'max:255',
            'penerima' => 'max:255',
            'kelengkapankembali' => 'max:255',
            'status' => 'required|max:255',
        ]);

        try {
            $pinjams = Pinjam::findOrFail($id);

            $pinjams->update($request->all());

            $formattedPinjam = [
                'id' => $pinjams->id,
                'tanggal' => $pinjams->tanggal,
                'serialnumber' => $pinjams->serialnumber,
                'pinjamsdevice' => [
                    'id' => $pinjams->pinjamTipe->id,
                    'name' => $pinjams->pinjamTipe->name
                ],
                'ram' => $pinjams->ram,
                'android' => $pinjams->android,
                'pelanggan' => $pinjams->pelanggan,
                'alamat' => $pinjams->alamat,
                'sales' => $pinjams->sales,
                'no_telp' => $pinjams->no_telp,
                'pengirim' => $pinjams->pengirim,
                'kelengkapankirim' => $pinjams->kelengkapankirim,
                'tanggalkembali' => $pinjams->tanggalkembali,
                'penerima' => $pinjams->penerima,
                'kelengkapankembali' => $pinjams->kelengkapankembali,
                'status' => $pinjams->status,
                'created_at' => $pinjams->created_at,
                'updated_at' => $pinjams->updated_at,
                'deleted_at' => $pinjams->deleted_at,
            ];

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $formattedPinjam
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal diubah: ' . $e->getMessage()], 500);
        }
    }

    public function move(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pinjamsdevice_id' => 'max:255',
            'ram' => 'required|max:255',
            'android' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'sales' => 'required|max:255',
            'no_telp' => 'required|max:255',
            'pengirim' => 'required|max:255',
            'kelengkapankirim' => 'required|max:255',
            'tanggalkembali' => 'required|max:255',
            'penerima' => 'required|max:255',
            'kelengkapankembali' => 'required|max:255',
            'status' => 'required|max:255',
        ]);

        try {
            $pinjams = Pinjam::findOrFail($id);

            $pinjams->update($request->all());

            $formattedPinjam = [
                'id' => $pinjams->id,
                'tanggal' => $pinjams->tanggal,
                'serialnumber' => $pinjams->serialnumber,
                'pinjamsdevice' => [
                    'id' => $pinjams->pinjamTipe->id,
                    'name' => $pinjams->pinjamTipe->name
                ],
                'ram' => $pinjams->ram,
                'android' => $pinjams->android,
                'pelanggan' => $pinjams->pelanggan,
                'alamat' => $pinjams->alamat,
                'sales' => $pinjams->sales,
                'no_telp' => $pinjams->no_telp,
                'pengirim' => $pinjams->pengirim,
                'kelengkapankirim' => $pinjams->kelengkapankirim,
                'tanggalkembali' => $pinjams->tanggalkembali,
                'penerima' => $pinjams->penerima,
                'kelengkapankembali' => $pinjams->kelengkapankembali,
                'status' => $pinjams->status,
                'created_at' => $pinjams->created_at,
                'updated_at' => $pinjams->updated_at,
                'deleted_at' => $pinjams->deleted_at,
            ];

            return response()->json([
                'message' => 'Data berhasil dipindahkan',
                'data' => $formattedPinjam
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal dipindahkan: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pinjams = Pinjam::find($id);

        if (!$pinjams) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $pinjams->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
