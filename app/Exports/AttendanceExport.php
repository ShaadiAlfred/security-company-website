<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AttendanceExport implements FromCollection, WithHeadings, WithColumnFormatting, WithEvents
{
    public function __construct(Collection $attendanceCollection)
    {
        $this->attendanceCollection = $attendanceCollection;
    }

    public function collection(): Collection
    {

        return $this->attendanceCollection->transform(function($attendanceItem) {
            return [
                $attendanceItem->employee->number,
                $attendanceItem->employee->name,
                $attendanceItem->is_present,
                $attendanceItem->note,
                $attendanceItem->submittedBy->name,
                $attendanceItem->submitted_from,
                Date::dateTimeToExcel($attendanceItem->created_at),
            ];
        });
    }

    public function headings(): array
    {
        return [
            __('Employee Number'),
            __('Employee'),
            __('Is present?'),
            __('Note'),
            __('Submitted By'),
            __('Submitted From'),
            __('Submitted At'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DATETIME,
        ];
    }

    public function registerEvents(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                AfterSheet::class => function (AfterSheet $event) {
                    $event->sheet->getDelegate()->setRightToLeft(true);
                },
            ];
        }
    }
}
