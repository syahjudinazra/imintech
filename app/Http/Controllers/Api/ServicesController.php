<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
            'serialnumber' => 'required',
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
            $service = new Services();
            $service->serialnumber = $request->input('serialnumber');
            $service->tanggalmasuk = $request->input('tanggalmasuk');
            $service->tanggalselesai = $request->input('tanggalselesai');
            $service->pemilik = $request->input('pemilik');
            $service->status = $request->input('status');
            $service->pelanggan = $request->input('pelanggan');
            $service->servicesdevice_id = $request->input('servicesdevice_id');
            $service->pemakaian = $request->input('pemakaian');
            $service->kerusakan = $request->input('kerusakan');
            $service->perbaikan = $request->input('perbaikan');
            $service->nosparepart = $request->input('nosparepart');
            $service->snkanibal = $request->input('snkanibal');
            $service->teknisi = $request->input('teknisi');
            $service->catatan = $request->input('catatan');

            $service->save();

            // Return formatted response JSON
            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => [
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
                ]
            ]);
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
        $service = Services::findOrFail($id);
        return response()->json([
            'message' => 'Data berhasil ditemukan',
            'data' => [
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
            ]
        ]);
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
            'serialnumber' => 'required',
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
            $service = Services::findOrFail($id);

            $service->update([
                'serialnumber' => $request->input('serialnumber'),
                'tanggalmasuk' => $request->input('tanggalmasuk'),
                'tanggalselesai' => $request->input('tanggalselesai'),
                'pemilik' => $request->input('pemilik'),
                'status' => $request->input('status'),
                'pelanggan' => $request->input('pelanggan'),
                'servicesdevice_id' => $request->input('servicesdevice_id'),
                'pemakaian' => $request->input('pemakaian'),
                'kerusakan' => $request->input('kerusakan'),
                'perbaikan' => $request->input('perbaikan'),
                'nosparepart' => $request->input('nosparepart'),
                'snkanibal' => $request->input('snkanibal'),
                'teknisi' => $request->input('teknisi'),
                'catatan' => $request->input('catatan'),
            ]);

            return response()->json([
                'message' => 'Data berhasil diubah',
                'data' => [
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
                ]
            ]);
        } catch (\Exception $e) {
            // Return error response
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
