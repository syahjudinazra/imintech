<?php

namespace App\Exports;

use App\Models\Services;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServicesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Services::with('ServicesTipe')->select(
            "serialnumber",
            "tanggalmasuk",
            "tanggalselesai",
            "pemilik",
            "status",
            "pelanggan",
            "servicesdevice_id",
            "pemakaian",
            "kerusakan",
            "perbaikan",
            "nosparepart",
            "snkanibal",
            "teknisi",
            "catatan"
        )
            ->get()
            ->map(function ($service) {
                return [
                    $service->serialnumber,
                    $service->tanggalmasuk,
                    $service->tanggalselesai,
                    $service->pemilik,
                    $service->status,
                    $service->pelanggan,
                    $service->ServicesTipe ? $service->ServicesTipe->name : null,
                    $service->pemakaian,
                    $service->kerusakan,
                    $service->perbaikan,
                    $service->nosparepart,
                    $service->snkanibal,
                    $service->teknisi,
                    $service->catatan,
                ];
            });
    }

    public function headings(): array
    {
        return ["Serial Number", "Tanggal Masuk", "Tanggal Selesai", "Pemilik", "Status", "Pelanggan", "Tipe Device", "Pemakaian", "Kerusakan", "Perbaikan", "No SpareParts", "SN Kanibal", "Teknisi", "Catatan"];
    }
}
