<?php

namespace App\Http\Controllers;

use App\Models\EmailSchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->input('submit') == 'search') {
            $startDate = $request->query('start_date');
            $endDate = $request->query('end_date');

            $histories = EmailSchedule::where('is_sent', '1')
                                    ->whereBetween('email_schedule', [
                                        Carbon::parse($startDate)->startOfDay(), // Start of the day (00:00:00)
                                        Carbon::parse($endDate)->endOfDay()     // End of the day (23:59:59)
                                    ])
                                    ->get();
        } else {
            $histories = [];
        }

        return view('pages.history', compact('histories'));
    }

    public function reschedule(Request $request)
    {
        if ($request->input('submit') == 'schedule') {
            // Combine date and time
            $datetime = $request->input('date_schedule') . ' ' . $request->input('time_schedule');
    
            EmailSchedule::whereIn('id', $request->input('checkbox'))->update([
                'email_schedule' => $datetime,
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
        }
    }
}
