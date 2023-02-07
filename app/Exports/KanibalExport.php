<?php

namespace App\Exports;

use App\Models\Kanibal;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;
class KanibalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kanibal::all();
    }

    public function headings(): array
    {
        return
        [
            "no", "tanggal", "serialnumber", "pelanggan", "model", "ram", "android", "kerusakan", "kerusakanbawaan",
            "teknisi", "perbaikan", "snkanibal", "nosparepart", "note",
        ];
    }
}
