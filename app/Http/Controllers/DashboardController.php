<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('dashboard', compact('clients'));
    }

    public function setEmailSchedule(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'date_schedule' => 'required|date',
        //     'time_schedule' => 'required|date_format:H:i',
        // ]);

        // Combine date and time
        $datetime = $request->input('date_schedule') . ' ' . $request->input('time_schedule');

        Client::whereIn('id', $request->input('checkbox'))->update([
            'email_schedule' => $datetime,
        ]);

        return redirect('home');
        // return redirect()->route('users.index')->with('success', 'Users updated successfully!');
    }
}
