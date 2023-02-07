<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;

class ServiceDoneImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'tanggal' => $row[1],
            'serialnumber' => $row[2],
            'pelanggan' => $row[3],
            'model' => $row[4],
            // 'kerusakan' => $row[5],
            // 'kerusakanbawaan' => $row[6],
            // 'teknisi' => $row[7],
            // 'perbaikan' => $row[8],
            // 'snkanibal' => $row[9],
            // 'nosparepart' => $row[10],
        ]);
    }
}
