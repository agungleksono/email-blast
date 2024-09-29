<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $data = [
            'title' => 'Mail from Laravel 8',
            'body' => 'This is a test email using Laravel 8.'
        ];

        Mail::to('agungdwy79@gmail.com')->send(new SendEmail($data));
        return 'Email sent';
    }
}
