<?php

namespace App\Http\Controllers\Api;

use App\Exports\ServicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ServicesController extends Controller
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

            $services = Services::all();

            $formattedServices = $services->map(function ($service) {
                return [
                    'id' => $service->id,
                    'serialnumber' => $service->serialnumber,
                    'tanggalmasuk' => $service->tanggalmasuk,
                    'tanggalselesai' => $service->tanggalselesai,
                    'pemilik' => $service->pemilik,
                    'status' => $service->status,
                    'pelanggan' => $service->pelanggan,
                    'servicesdevice' => [
                        'id' => $service->servicesTipe->id,
                        'name' => $service->servicesTipe->name
                    ],
                    'pemakaian' => $service->pemakaian,
                    'kerusakan' => $service->kerusakan,
                    'perbaikan' => $service->perbaikan,
                    'nosparepart' => $service->nosparepart,
                    'snkanibal' => $service->snkanibal,
                    'teknisi' => $service->teknisi,
                    'catatan' => $service->catatan,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                    'deleted_at' => $service->deleted_at,
                ];
            });

            // Return JSON response
            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function export()
    {
        $date = Carbon::now()->format('d-m-Y');
        $fileName = 'ServicesData_' . $date . '.xlsx';

        return Excel::download(new ServicesExport, $fileName);
    }

    public function antrianPelanggan(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Antrian')
                ->where('pemilik', 'customer')
                ->orderByDesc('tanggalmasuk');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $antrianPelanggan = $query->paginate(10);

            $formattedServices = $antrianPelanggan->map(function ($antrian) {
                return [
                    'id' => $antrian->id,
                    'serialnumber' => $antrian->serialnumber,
                    'tanggalmasuk' => $antrian->tanggalmasuk,
                    'tanggalselesai' => $antrian->tanggalselesai,
                    'pemilik' => $antrian->pemilik,
                    'status' => $antrian->status,
                    'pelanggan' => $antrian->pelanggan,
                    'servicesdevice' => [
                        'id' => $antrian->servicesTipe->id,
                        'name' => $antrian->servicesTipe->name
                    ],
                    'pemakaian' => $antrian->pemakaian,
                    'kerusakan' => $antrian->kerusakan,
                    'perbaikan' => $antrian->perbaikan,
                    'nosparepart' => $antrian->nosparepart,
                    'snkanibal' => $antrian->snkanibal,
                    'teknisi' => $antrian->teknisi,
                    'catatan' => $antrian->catatan,
                    'created_at' => $antrian->created_at,
                    'updated_at' => $antrian->updated_at,
                    'deleted_at' => $antrian->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $antrianPelanggan->total(),
                    'per_page' => $antrianPelanggan->perPage(),
                    'current_page' => $antrianPelanggan->currentPage(),
                    'last_page' => $antrianPelanggan->lastPage(),
                    'next_page_url' => $antrianPelanggan->nextPageUrl(),
                    'prev_page_url' => $antrianPelanggan->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }


    public function validasiPelanggan(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Validasi')
                ->where('pemilik', 'customer')
                ->orderByDesc('tanggalmasuk');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $validasiPelanggan = $query->paginate(10);

            $formattedServices = $validasiPelanggan->map(function ($validasi) {
                return [
                    'id' => $validasi->id,
                    'serialnumber' => $validasi->serialnumber,
                    'tanggalmasuk' => $validasi->tanggalmasuk,
                    'tanggalselesai' => $validasi->tanggalselesai,
                    'pemilik' => $validasi->pemilik,
                    'status' => $validasi->status,
                    'pelanggan' => $validasi->pelanggan,
                    'servicesdevice' => [
                        'id' => $validasi->servicesTipe->id,
                        'name' => $validasi->servicesTipe->name
                    ],
                    'pemakaian' => $validasi->pemakaian,
                    'kerusakan' => $validasi->kerusakan,
                    'perbaikan' => $validasi->perbaikan,
                    'nosparepart' => $validasi->nosparepart,
                    'snkanibal' => $validasi->snkanibal,
                    'teknisi' => $validasi->teknisi,
                    'catatan' => $validasi->catatan,
                    'created_at' => $validasi->created_at,
                    'updated_at' => $validasi->updated_at,
                    'deleted_at' => $validasi->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $validasiPelanggan->total(),
                    'per_page' => $validasiPelanggan->perPage(),
                    'current_page' => $validasiPelanggan->currentPage(),
                    'last_page' => $validasiPelanggan->lastPage(),
                    'next_page_url' => $validasiPelanggan->nextPageUrl(),
                    'prev_page_url' => $validasiPelanggan->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function selesaiPelanggan(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Selesai')
                ->where('pemilik', 'customer')
                ->orderByDesc('tanggalselesai');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalselesai', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $selesaiPelanggan = $query->paginate(10);

            $formattedServices = $selesaiPelanggan->map(function ($selesai) {
                return [
                    'id' => $selesai->id,
                    'serialnumber' => $selesai->serialnumber,
                    'tanggalmasuk' => $selesai->tanggalmasuk,
                    'tanggalselesai' => $selesai->tanggalselesai,
                    'pemilik' => $selesai->pemilik,
                    'status' => $selesai->status,
                    'pelanggan' => $selesai->pelanggan,
                    'servicesdevice' => [
                        'id' => $selesai->servicesTipe->id,
                        'name' => $selesai->servicesTipe->name
                    ],
                    'pemakaian' => $selesai->pemakaian,
                    'kerusakan' => $selesai->kerusakan,
                    'perbaikan' => $selesai->perbaikan,
                    'nosparepart' => $selesai->nosparepart,
                    'snkanibal' => $selesai->snkanibal,
                    'teknisi' => $selesai->teknisi,
                    'catatan' => $selesai->catatan,
                    'created_at' => $selesai->created_at,
                    'updated_at' => $selesai->updated_at,
                    'deleted_at' => $selesai->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $selesaiPelanggan->total(),
                    'per_page' => $selesaiPelanggan->perPage(),
                    'current_page' => $selesaiPelanggan->currentPage(),
                    'last_page' => $selesaiPelanggan->lastPage(),
                    'next_page_url' => $selesaiPelanggan->nextPageUrl(),
                    'prev_page_url' => $selesaiPelanggan->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function antrianStock(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Antrian')
                ->where('pemilik', 'stock')
                ->orderByDesc('tanggalmasuk');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $antrianStock = $query->paginate(10);

            $formattedServices = $antrianStock->map(function ($antrian) {
                return [
                    'id' => $antrian->id,
                    'serialnumber' => $antrian->serialnumber,
                    'tanggalmasuk' => $antrian->tanggalmasuk,
                    'tanggalselesai' => $antrian->tanggalselesai,
                    'pemilik' => $antrian->pemilik,
                    'status' => $antrian->status,
                    'pelanggan' => $antrian->pelanggan,
                    'servicesdevice' => [
                        'id' => $antrian->servicesTipe->id,
                        'name' => $antrian->servicesTipe->name
                    ],
                    'pemakaian' => $antrian->pemakaian,
                    'kerusakan' => $antrian->kerusakan,
                    'perbaikan' => $antrian->perbaikan,
                    'nosparepart' => $antrian->nosparepart,
                    'snkanibal' => $antrian->snkanibal,
                    'teknisi' => $antrian->teknisi,
                    'catatan' => $antrian->catatan,
                    'created_at' => $antrian->created_at,
                    'updated_at' => $antrian->updated_at,
                    'deleted_at' => $antrian->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $antrianStock->total(),
                    'per_page' => $antrianStock->perPage(),
                    'current_page' => $antrianStock->currentPage(),
                    'last_page' => $antrianStock->lastPage(),
                    'next_page_url' => $antrianStock->nextPageUrl(),
                    'prev_page_url' => $antrianStock->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function validasiStock(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Validasi')
                ->where('pemilik', 'stock')
                ->orderByDesc('tanggalmasuk');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalmasuk', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $validasiStock = $query->paginate(10);

            $formattedServices = $validasiStock->map(function ($validasi) {
                return [
                    'id' => $validasi->id,
                    'serialnumber' => $validasi->serialnumber,
                    'tanggalmasuk' => $validasi->tanggalmasuk,
                    'tanggalselesai' => $validasi->tanggalselesai,
                    'pemilik' => $validasi->pemilik,
                    'status' => $validasi->status,
                    'pelanggan' => $validasi->pelanggan,
                    'servicesdevice' => [
                        'id' => $validasi->servicesTipe->id,
                        'name' => $validasi->servicesTipe->name
                    ],
                    'pemakaian' => $validasi->pemakaian,
                    'kerusakan' => $validasi->kerusakan,
                    'perbaikan' => $validasi->perbaikan,
                    'nosparepart' => $validasi->nosparepart,
                    'snkanibal' => $validasi->snkanibal,
                    'teknisi' => $validasi->teknisi,
                    'catatan' => $validasi->catatan,
                    'created_at' => $validasi->created_at,
                    'updated_at' => $validasi->updated_at,
                    'deleted_at' => $validasi->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $validasiStock->total(),
                    'per_page' => $validasiStock->perPage(),
                    'current_page' => $validasiStock->currentPage(),
                    'last_page' => $validasiStock->lastPage(),
                    'next_page_url' => $validasiStock->nextPageUrl(),
                    'prev_page_url' => $validasiStock->previousPageUrl(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data tidak ditemukan: ' . $e->getMessage()], 500);
        }
    }

    public function selesaiStock(Request $request)
    {
        try {
            if (!$request->user()) {
                return response()->json(['message' => 'Kamu tidak dapat mengakses halaman ini, Silahkan login terlebih dahulu!'], 403);
            }

            $query = Services::where('status', 'Selesai')
                ->where('pemilik', 'stock')
                ->orderByDesc('tanggalselesai');

            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('tanggalselesai', 'like', "%{$search}%")
                        ->orWhere('serialnumber', 'like', "%{$search}%")
                        ->orWhere('pelanggan', 'like', "%{$search}%")
                        ->orWhereHas('servicesTipe', function ($q) use ($search) {
                            $q->where('name', 'like', "%{$search}%");
                        });
                });
            }

            $selesaiStock = $query->paginate(10);

            $formattedServices = $selesaiStock->map(function ($selesai) {
                return [
                    'id' => $selesai->id,
                    'serialnumber' => $selesai->serialnumber,
                    'tanggalmasuk' => $selesai->tanggalmasuk,
                    'tanggalselesai' => $selesai->tanggalselesai,
                    'pemilik' => $selesai->pemilik,
                    'status' => $selesai->status,
                    'pelanggan' => $selesai->pelanggan,
                    'servicesdevice' => [
                        'id' => $selesai->servicesTipe->id,
                        'name' => $selesai->servicesTipe->name
                    ],
                    'pemakaian' => $selesai->pemakaian,
                    'kerusakan' => $selesai->kerusakan,
                    'perbaikan' => $selesai->perbaikan,
                    'nosparepart' => $selesai->nosparepart,
                    'snkanibal' => $selesai->snkanibal,
                    'teknisi' => $selesai->teknisi,
                    'catatan' => $selesai->catatan,
                    'created_at' => $selesai->created_at,
                    'updated_at' => $selesai->updated_at,
                    'deleted_at' => $selesai->deleted_at,
                ];
            });

            return response()->json([
                'messages' => 'Data ditemukan',
                'data' => $formattedServices,
                'pagination' => [
                    'total' => $selesaiStock->total(),
                    'per_page' => $selesaiStock->perPage(),
                    'current_page' => $selesaiStock->currentPage(),
                    'last_page' => $selesaiStock->lastPage(),
                    'next_page_url' => $selesaiStock->nextPageUrl(),
                    'prev_page_url' => $selesaiStock->previousPageUrl(),
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
            'tanggalmasuk' => 'required|max:255',
            'tanggalselesai' => 'max:255',
            'pemilik' => 'required|max:255',
            'status' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'servicesdevice_id' => 'required|max:255',
            'pemakaian' => 'required|max:255',
            'kerusakan' => 'required|max:255',
            'perbaikan' => 'max:255',
            'nosparepart' => 'max:255',
            'snkanibal' => 'max:255',
            'teknisi' => 'max:255',
            'catatan' => 'required|max:255',
        ]);

        try {
            $service = Services::create($request->all());

            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $service
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
            $service = Services::findOrFail($id);

            // Format the service data
            $formattedService = [
                'id' => $service->id,
                'serialnumber' => $service->serialnumber,
                'tanggalmasuk' => $service->tanggalmasuk,
                'tanggalselesai' => $service->tanggalselesai,
                'pemilik' => $service->pemilik,
                'status' => $service->status,
                'pelanggan' => $service->pelanggan,
                'servicesdevice' => [
                    'id' => $service->servicesTipe->id,
                    'name' => $service->servicesTipe->name
                ],
                'pemakaian' => $service->pemakaian,
                'kerusakan' => $service->kerusakan,
                'perbaikan' => $service->perbaikan,
                'nosparepart' => $service->nosparepart,
                'snkanibal' => $service->snkanibal,
                'teknisi' => $service->teknisi,
                'catatan' => $service->catatan,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
                'deleted_at' => $service->deleted_at,
            ];

            return response()->json([
                'message' => 'Data ditemukan',
                'data' => $formattedService
            ]);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'serialnumber' => 'required|max:255',
            'tanggalmasuk' => 'required|max:255',
            'tanggalselesai' => 'max:255',
            'pemilik' => 'required|max:255',
            'status' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'servicesdevice_id' => 'max:255',
            'pemakaian' => 'required|max:255',
            'kerusakan' => 'required|max:255',
            'perbaikan' => 'max:255',
            'nosparepart' => 'max:255',
            'snkanibal' => 'max:255',
            'teknisi' => 'max:255',
            'catatan' => 'required|max:255',
        ]);

        try {
            $service = Services::findOrFail($id);

            $service->update($request->all());

            $formattedService = [
                'id' => $service->id,
                'serialnumber' => $service->serialnumber,
                'tanggalmasuk' => $service->tanggalmasuk,
                'tanggalselesai' => $service->tanggalselesai,
                'pemilik' => $service->pemilik,
                'status' => $service->status,
                'pelanggan' => $service->pelanggan,
                'servicesdevice' => [
                    'id' => $service->servicesTipe->id,
                    'name' => $service->servicesTipe->name
                ],
                'pemakaian' => $service->pemakaian,
                'kerusakan' => $service->kerusakan,
                'perbaikan' => $service->perbaikan,
                'nosparepart' => $service->nosparepart,
                'snkanibal' => $service->snkanibal,
                'teknisi' => $service->teknisi,
                'catatan' => $service->catatan,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
                'deleted_at' => $service->deleted_at,
            ];

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => $formattedService
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data gagal diubah: ' . $e->getMessage()], 500);
        }
    }

    public function move(Request $request, $id)
    {
        $request->validate([
            'serialnumber' => 'required|max:255',
            'tanggalmasuk' => 'required|max:255',
            'tanggalselesai' => 'required|max:255',
            'pemilik' => 'required|max:255',
            'status' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'servicesdevice_id' => 'max:255',
            'pemakaian' => 'required|max:255',
            'kerusakan' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'nosparepart' => 'required|max:255',
            'snkanibal' => 'required|max:255',
            'teknisi' => 'required|max:255',
            'catatan' => 'required|max:255',
        ]);

        try {
            $service = Services::findOrFail($id);

            $service->update($request->all());

            $formattedService = [
                'id' => $service->id,
                'serialnumber' => $service->serialnumber,
                'tanggalmasuk' => $service->tanggalmasuk,
                'tanggalselesai' => $service->tanggalselesai,
                'pemilik' => $service->pemilik,
                'status' => $service->status,
                'pelanggan' => $service->pelanggan,
                'servicesdevice' => [
                    'id' => $service->servicesTipe->id,
                    'name' => $service->servicesTipe->name
                ],
                'pemakaian' => $service->pemakaian,
                'kerusakan' => $service->kerusakan,
                'perbaikan' => $service->perbaikan,
                'nosparepart' => $service->nosparepart,
                'snkanibal' => $service->snkanibal,
                'teknisi' => $service->teknisi,
                'catatan' => $service->catatan,
                'created_at' => $service->created_at,
                'updated_at' => $service->updated_at,
                'deleted_at' => $service->deleted_at,
            ];

            return response()->json([
                'message' => 'Data berhasil dipindahkan',
                'data' => $formattedService
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menambahkan data: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Services::find($id);

        if (!$service) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $service->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
