<?php

namespace App\Exports;

use App\Models\Meeting;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeetingsExport implements FromQuery, WithMapping, WithHeadings
{
    use Exportable;

    public function query()
    {
        return Meeting::query();
    }

    public function map($meeting): array
    {
        return [
            $meeting->teacher->university_id,
            $meeting->subject->name,
            $meeting->getExcelDayAndHour(),
            $meeting->getType(),
            $meeting->classroom,
            $meeting->meeting_url
        ];
    }

    public function headings(): array
    {
        return [
            'LEGAJO PROFESOR',
            'MATERIA',
            'DIA Y HORA',
            'TIPO',
            'SALON (OPC)',
            'LINK (OPC)',
        ];
    }
}
