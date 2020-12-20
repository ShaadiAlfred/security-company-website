<?php

namespace App\Imports;

use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EmployeesImport implements ToModel, WithStartRow
{
    /**
     * @return \App\Models\Employee|null
     */
    public function model(array $row)
    {
        if (empty($row[0])) {
            return null;
        }

        $hiredOn = $row[10];

        if (! is_null($hiredOn)) {
            if (! strpos($hiredOn, '/')) {
                $hiredOn = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($hiredOn);
            } else {
                $hiredOn = Carbon::createFromFormat('d/m/Y', $hiredOn);
            }
        }

        return new Employee([
            'number'          => $row[0],
            'name'            => $row[1],
            'national_id'     => $row[2],
            'address'         => $row[3],
            'phone'           => $row[4],
            'age'             => $row[5],
            'notes'           => $row[6],
            // 'job_location_id' => $row[7], TODO
            // 'job_shift_id'    => $row[?], TODO
            'section'         => $row[8],
            '3ohda'           => $row[9],
            'hired_on'        => $hiredOn,
            'status'          => $row[11],
            'kashf_amny'      => $row[12],
            'no3_el_mo5alfa'  => $row[13],
            'pants'           => $row[14],
            'summer_t_shirt'  => $row[15],
            'winter_t_shirt'  => $row[16],
            'eish'            => $row[17],
            'jacket'          => $row[18],
            'shoes'           => $row[19],
            'vest'            => $row[20],
            'donk'            => $row[21],
            'notes_2'         => $row[22],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

}
