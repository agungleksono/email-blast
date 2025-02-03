<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Client([
            'company_name' => $row['company_name'],
            'pic' => $row['pic_name'],
            'email' => $row['email'],
            'website' => $row['web_site'],
            'company_address' => $row['company_address'],
            'email_schedule' => date('Y-m-d H:i:s', strtotime($row['email_schedule'])),
            // 'email_schedule' => $row['email_schedule'],
        ]);
    }
}
