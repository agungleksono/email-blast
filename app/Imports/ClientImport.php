<?php

namespace App\Imports;

use App\Models\EmailSchedule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithValidation;
// use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class ClientImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->isRowEmpty($row)) {
            return null;
        }

        $emailSchedule = $this->combineDateTime($row['date'], $row['time']);

        return new EmailSchedule([
            'company_name' => $row['company_name'],
            'pic' => $row['pic_name'],
            'email' => $row['email'],
            'website' => $row['web_site'],
            'company_address' => $row['company_address'],
            'email_schedule' => $emailSchedule,
        ]);
    }
    
    private function combineDateTime($date, $time)
    {
        // Handle Excel serialized date/time if needed
        if (is_numeric($date)) {
            $date = ExcelDate::excelToDateTimeObject($date)->format('Y-m-d');
        }

        if (is_numeric($time)) {
            $time = ExcelDate::excelToDateTimeObject($time)->format('H:i:s');
        }

        $timestamp = strtotime($date . ' ' . $time);

        if ($timestamp === false) {
            return null;
        }

        return date('Y-m-d H:i:s', $timestamp);
    }

    // to prevent when excel file there is no data but only insert date and time
    private function isRowEmpty(array $row): bool
    {
        // Define the key fields to check — skip if all are empty
        $requiredFields = [
            'company_name',
            'pic_name',
            'email',
            'web_site',
            'company_address',
        ];

        foreach ($requiredFields as $field) {
            if (!empty(trim($row[$field] ?? ''))) {
                return false; // Not empty
            }
        }

        return true; // Row is empty (except maybe date/time)
    }

    // /**
    //  * Define validation rules for each row.
    //  *
    //  * @return array
    //  */
    // public function rules(): array
    // {
    //     return [
    //         '*.date' => ['required', 'date_format:Y-m-d'], // strict date format
    //         '*.time' => ['required'],                      // allow time like "1:30 PM"
    //         '*.email' => ['required', 'email'],
    //         '*.company_name' => ['required'],
    //     ];
    // }

    // /**
    //  * Custom error messages.
    //  *
    //  * @return array
    //  */
    // public function customValidationMessages()
    // {
    //     return [
    //         '*.date.required' => 'The date field is required.',
    //         '*.date.date_format' => 'The date must be in the format YYYY-MM-DD (e.g. 2025-03-11).',
    //         '*.time.required' => 'The time field is required.',
    //         '*.email.required' => 'Email is required.',
    //         '*.email.email' => 'Invalid email format.',
    //         '*.company_name.required' => 'Company name is required.',
    //     ];
    // }
}
