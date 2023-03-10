<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceDoneExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Barang::all();
    }

    public function headings(): array
    {
        return
        [
            "no", "tanggal", "serialnumber", "pelanggan", "model", "ram", "android", "garansi", "kerusakan", "kerusakanbawaan",
            "teknisi", "perbaikan", "snkanibal", "nosparepart", "note",
    ];
    }

}
