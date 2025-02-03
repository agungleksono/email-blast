<?php

namespace App\Http\Controllers;

use App\Imports\ClientImport;
use App\Models\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('dashboard', compact('clients'));
    }

    public function setEmailSchedule(Request $request)
    {
        // dd($request->input('submit'));
        // Validate the request
        // $request->validate([
        //     'date_schedule' => 'required|date',
        //     'time_schedule' => 'required|date_format:H:i',
        // ]);
        if ($request->input('submit') == 'schedule') {
            // Combine date and time
            $datetime = $request->input('date_schedule') . ' ' . $request->input('time_schedule');
    
            Client::whereIn('id', $request->input('checkbox'))->update([
                'email_schedule' => $datetime,
            ]);
    
            return redirect('home');
            // return redirect()->route('users.index')->with('success', 'Users updated successfully!');

        } elseif ($request->input('submit') == 'delete') {
            if ($request->has('checkbox'))
            {
                Client::whereIn('id', $request->checkbox)->delete();
                return redirect()->back()->with('success', 'Selected items deleted successfully.');
            }
            return redirect()->back()->with('error', 'No items selected.');
        }
        
    }

    public function importClients(Request $request)
    {
        // dd($request->file('file'));
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls,csv',
        // ]);

        Excel::import(new ClientImport, $request->file('file'));
        return redirect()->back()->with('success', 'Users imported successfully.');
    }
}
