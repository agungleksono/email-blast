<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        // Set the timezone to Jakarta
        date_default_timezone_set('Asia/Jakarta');

        $clients = Client::where('email_schedule', now()->format('Y-m-d H:i:00'))
                        ->select('email')
                        ->get();

        $data = [
            'title' => 'Mail from Laravel 8',
            'body' => 'This is a test email using Laravel 8.'
        ];

        foreach ($clients as $client)
        {
            Mail::to($client->email)->send(new SendEmail($data));
            // return 'Email sent';
        }
    }
}
