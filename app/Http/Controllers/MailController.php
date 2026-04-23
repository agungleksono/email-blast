<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Client;
use App\Models\Email;
use App\Models\EmailSchedule;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function sendMail()
    {
        // Set the timezone to Jakarta
        date_default_timezone_set('Asia/Jakarta');

        $clients = EmailSchedule::where('email_schedule', now()->format('Y-m-d H:i:00'))
                        ->select('id', 'email', 'pic', 'company_name', 'company_address')
                        ->get();

        // $data = [
        //     'title' => 'Mail from Laravel 8',
        //     'body' => 'This is a test email using Laravel 8.',
        //     'pic' => 'Sir/Madam',
        //     'company_name' => 'PT Denso Indonesia',

        // ];
        $email = EmailTemplate::where('id', 1)
                        ->first();

        try {
            foreach ($clients as $client)
            {
                $data = [
                    'pic' => $client->pic,
                    'company_name' => $client->company_name,
                    'company_address' => $client->company_address,
                    'subject' => $email->subject,
                    'sender_mail' => $email->sender_mail,
                    'sender_name' => $email->sender_name,
                    'signature_name' => $email->signature_name,
                    'upper_body' => $email->upper_body,
                    'lower_body' => $email->lower_body,
                    'body_img' => $email->body_img,
                    'signature_img' => $email->signature_img,
                ];
    
                try {
                    Mail::to($client->email)->send(new SendEmail($data));
        
                    // ✅ Only update status if no exception occurs
                    EmailSchedule::where('id', $client->id)->update(['is_sent' => '1']);
                } catch (\Throwable $th) {
                    // \Log::error("Failed to send email to {$client->email}: " . $th->getMessage());
                    echo 'Error: ' . $th->getMessage();
                }
            }

            echo 'success';
        } catch (\Throwable $th) {
            echo 'Error: ' . $th->getMessage();
        }
    }

    public function testEmail()
    {
        $email = EmailTemplate::where('id', 1)
                            ->first();

        $data = [
            'pic' => 'Sir/Madam',
            'company_name' => 'Apple Inc.',
            'company_address' => 'One Apple Park Way, California, USA',
            'subject' => $email->subject,
            'sender_mail' => $email->sender_mail,
            'sender_name' => $email->sender_name,
            'signature_name' => $email->signature_name,
            'upper_body' => $email->upper_body,
            'lower_body' => $email->lower_body,
            'body_img' => $email->body_img,
            'signature_img' => $email->signature_img,
        ];

        try {
            Mail::to($email->recipient_mail_test)->send(new SendEmail($data));
            return redirect('/email-template')->with('success', 'Success test email!');
        } catch (\Throwable $th) {
            return redirect('/email-template')->with('error', 'Failed test email!Error: ' . $th->getMessage());
        }
    }

    public function editEmail()
    {
        $email = EmailTemplate::where('id', 1)
                        ->first();

        return view('pages.email_template', compact('email'));
    }

    public function updateEmail(Request $request)
    {
        $email = EmailTemplate::findOrFail(1);

        $email->sender_mail = $request->input('sender_mail');
        $email->sender_name = $request->input('sender_name');
        $email->subject = $request->input('subject');
        $email->upper_body = $request->input('upper_body');
        $email->lower_body = $request->input('lower_body');
        $email->recipient_mail_test = $request->input('recipient');
        // $email->signature_name = $request->input('signature_name');

        if ($request->hasFile('body_img')) {
            if ($email->body_img && Storage::disk('public')->exists('images/body/' . $email->body_img)) {
                Storage::disk('public')->delete('images/body/' . $email->body_img);
            }
            // $email->body_img = $request->file('body_img')->store('images/body', 'public');
            $path = $request->file('body_img')->store('images/body', 'public');
            $filename = basename($path);
            $email->body_img = $filename;
        }

        if ($request->hasFile('signature_img')) {
            if ($email->signature_img && Storage::disk('public')->exists('images/signature/' . $email->signature_img)) {
                Storage::disk('public')->delete('images/body/' . $email->signature_img);
            }
            // $email->signature_img = $request->file('signature_img')->store('images/signature', 'public');
            $path = $request->file('signature_img')->store('images/signature', 'public');
            $filename = basename($path);
            $email->signature_img = $filename;
        }
    
        $email->save();

        // $senderMail = $request->input('sender_mail');
        // $senderName = $request->input('sender_name');
        // $subject = $request->input('subject');
        // $upperBody = $request->input('upper_body');
        // $lowerBody = $request->input('lower_body');

        // $email = EmailTemplate::where('id', 1)->update([
        //     'sender_mail' => $senderMail,
        //     'sender_name' => $senderName,
        //     'subject' => $subject,
        //     'upper_body' => $upperBody,
        //     'lower_body' => $lowerBody,
        // ]);

        return redirect('/email-template')->with('success', 'Email template updated successfully!');
    }
}
