<?php

namespace App\Imports;

use App\Models\TutorForm;
use Maatwebsite\Excel\Concerns\ToModel;

class TutorFormImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TutorForm([
            'tutor_name' => $row[0],
            'student_name' => $row[1],
            'day_of_tution' => $row[2],
            'tution_time' => $row[3],
            'rate' => $row[4],
            'commission' => $row[5],
            'month' => $row[6]
        ]);
    }
}
