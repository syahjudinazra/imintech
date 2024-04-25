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
        // Fetching Services data along with their associated ServicesDevice
        $services = Services::with('ServicesDevices')->latest()->get();

        // Mapping the array of objects and adding ServicesDevice data
        $mappedServices = $services->map(function ($service) {
            return [
                'serialnumber' => $service->serialnumber,
                'tanggalmasuk' => $service->tanggalmasuk,
                'tanggalselesai' => $service->tanggalselesai,
                'pemilik' => $service->pemilik,
                'status' => $service->status,
                'pelanggan' => $service->pelanggan,
                'servicesdevice' => [
                    'id' => $service->id,
                    'name' => $service->name,
                ],
                'pemakaian' => $service->pemakaian,
                'kerusakan' => $service->kerusakan,
                'perbaikan' => $service->perbaikan,
                'nosparepart' => $service->nosparepart,
                'snkanibal' => $service->snkanibal,
                'teknisi' => $service->teknisi,
                'catatan' => $service->catatan,
            ];
        });

        return response()->json(['data' => $mappedServices]);
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

            $services = new Services();
            $services->serialnumber = $request->input('serialnumber');
            $services->tanggalmasuk = $request->input('tanggalmasuk');
            $services->tanggalselesai = $request->input('tanggalselesai');
            $services->pemilik = $request->input('pemilik');
            $services->status = $request->input('status');
            $services->pelanggan = $request->input('pelanggan');
            $services->servicesdevice_id = $request->input('servicesdevice_id');
            $services->pemakaian = $request->input('pemakaian');
            $services->kerusakan = $request->input('kerusakan');
            $services->perbaikan = $request->input('perbaikan');
            $services->nosparepart = $request->input('nosparepart');
            $services->snkanibal = $request->input('snkanibal');
            $services->teknisi = $request->input('teknisi');
            $services->catatan = $request->input('catatan');

            $services->save();

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
        $services = Services::findOrFails($id);
        return response()->json(['data' => $services]);
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
            $services = Services::findOrFail($id);

            // Update firmware data
            $services->update([
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

            return response()->json(['message' => 'Data berhasil ditambahkan']);
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
        $services = Services::find($id);

        if (!$services) {
            return response()->json(['message' => 'Data tidak ditemukan', 'status' => false], 404);
        }
        $services->delete();
        return response()->json(['message' => 'Data berhasil dihapus', 'status' => true]);
    }
}
