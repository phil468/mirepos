<?php

namespace App\Imports;

use App\ReporteCierre;
use Maatwebsite\Excel\Concerns\ToModel;


class ReporteCierreImport implements ToModel
{
    public function model(array $row)
    {
        return new ReporteCierre([
            'CODIGO'      => $row[1], //B
            'DESCRIPCION' => $row[2], //C
            'UM'          => $row[3], //D
            'CANTIDAD'    => $row[4], //E
            'PRE_UNIT'    => $row[5], //F
            'IMPORTE'     => $row[6], //G
        ]);
    }
}
