<?php

namespace App\Imports;

use App\Models\Meeting;
use App\Models\User;
use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MeetingsImport implements ToModel, WithHeadingRow, WithMultipleSheets
{
    use Importable;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $legajo_profesor = User::where('university_id', $row['legajo_profesor'])->first();
        $materia = Subject::where('name', 'like', '%' . $row['materia'] . '%')->first();
        $pieces = explode('-', $row['dia_y_hora']);
        $day = normaliza(trim($pieces[0]));
        $hour = strtolower(trim($pieces[1]));
        $weekdays = [
            'lunes' => 1,
            'martes' => 2,
            'miercoles' => 3,
            'jueves' => 4,
            'viernes' => 5,
            'sabado' => 6,
            'domingo' => 0
        ];

        if ($row['tipo'] == 'Virtual') {
            $type = 'virtual';
        } elseif ($row['tipo'] == 'Presencial') {
            $type = 'face-to-face';
        }

        return new Meeting([
            'teacher_id' => $legajo_profesor->id,
            'subject_id' => $materia->id,
            'day' => $weekdays[$day],
            'hour' => $hour,
            'type' => $type,
            'classroom' => $row['salon_opc'],
            'meeting_url' => $row['link_opc']
        ]);
    }

    public function sheets(): array
    {
        return [
            // Select by sheet index
            0 => new MeetingsImport(),
        ];
    }
}
