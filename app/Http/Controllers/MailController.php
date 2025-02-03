<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Client;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        // Set the timezone to Jakarta
        date_default_timezone_set('Asia/Jakarta');

        $clients = Client::where('email_schedule', now()->format('Y-m-d H:i:00'))
                        ->select('email', 'pic', 'company_name', 'company_address')
                        ->get();

        // $data = [
        //     'title' => 'Mail from Laravel 8',
        //     'body' => 'This is a test email using Laravel 8.',
        //     'pic' => 'Sir/Madam',
        //     'company_name' => 'PT Denso Indonesia',

        // ];
        $email = Email::where('id', 1)
                        ->first();

        foreach ($clients as $client)
        {
            $data = [
                'pic' => $client->pic,
                'company_name' => $client->company_name,
                'company_address' => $client->company_address,
                'subject' => $email->subject,
                'upper_body' => $email->upper_body,
                'lower_body' => $email->lower_body,
            ];

            Mail::to($client->email)->send(new SendEmail($data));
            // return 'Email sent';
        }
    }

    public function editEmail()
    {
        $email = Email::where('id', 1)
                        ->first();

        return view('pages.email_template', compact('email'));
    }

    public function updateEmail(Request $request)
    {
        $subject = $request->input('subject');
        $upper_body = $request->input('upper_body');
        $lower_body = $request->input('lower_body');

        $email = Email::where('id', 1)->update([
            'subject' => $subject,
            'upper_body' => $upper_body,
            'lower_body' => $lower_body,
        ]);

        return redirect('/update-email');
    }
}
