<?php

namespace App\Exports;

use App\Models\EmailSchedule;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class EmailSchedulesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $schedules = EmailSchedule::all();

        return $schedules->values()->map(function ($item, $index) {
            $scheduleDate = '';
            $scheduleTime = '';

            if (!empty($item->email_schedule)) {
                try {
                    $datetime = Carbon::parse($item->email_schedule);
                    $scheduleDate = $datetime->format('Y-m-d');
                    $scheduleTime = $datetime->format('H:i');
                } catch (\Exception $e) {
                    // You can log the error or leave as empty
                }
            }

            return [
                'no'               => $index + 1,
                'company_name'     => $item->company_name,
                'pic'              => $item->pic,
                'email'            => $item->email,
                'website'          => $item->website,
                'company_address'  => $item->company_address,
                'date'             => $scheduleDate,
                'time'             => $scheduleTime,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Company Name',
            'PIC',
            'Email',
            'Website',
            'Company Address',
            'Date',
            'Time',
        ];
    }
}
