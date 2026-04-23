<?php

namespace App\Http\Controllers;

use App\Imports\ClientImport;
use App\Models\EmailSchedule;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function index()
    {
        $clients = EmailSchedule::whereNull('is_sent')->get();
        return view('pages.schedule', compact('clients'));
    }

    public function setEmailSchedule(Request $request)
    {
        if ($request->input('submit') == 'schedule') {
            $validator = Validator::make($request->all(), [
                'date_schedule' => 'required', 
                'time_schedule' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            // Combine date and time
            $datetime = $request->input('date_schedule') . ' ' . $request->input('time_schedule');
    
            EmailSchedule::whereIn('id', $request->input('checkbox'))->update([
                'email_schedule' => $datetime,
                'is_sent' => null,
            ]);
    
            // return redirect('home');
            return redirect()->route('index.schedule')->with('success', 'Schedule set successfully!');

        } elseif ($request->input('submit') == 'delete') {
            if ($request->has('checkbox'))
            {
                EmailSchedule::whereIn('id', $request->checkbox)->delete();
                return redirect()->back()->with('success', 'Selected items deleted successfully.');
            }
            return redirect()->back()->with('error', 'No items selected.');
        } elseif ($request->input('submit') == 'delete-all') {
            EmailSchedule::where('is_sent', null)->delete();
            return redirect()->back()->with('success', 'All scheduled items deleted successfully.');
        }
        
    }

    public function importClients(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        Excel::import(new ClientImport, $request->file('file'));
        return redirect()->back()->with('success', 'Users imported successfully.');
    }
}
