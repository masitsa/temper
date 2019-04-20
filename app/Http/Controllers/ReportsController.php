<?php

namespace App\Http\Controllers;

use App\Report;

use App\Percentage;

use App\Services\Registrations;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Session;

class ReportsController extends Controller
{
    /**
     * Display onboarding report
     *
     */
    public function index()
    {
        return view('reports.onboarding');
    }

    public function store(Request $request)
    {
        //upload file & return array
        $registrations = new Registrations();

        $csv_data = $registrations->uploadFile($request);

        //save array to database
        if($csv_data != FALSE)
        {
            //Truncate any data from the table
            Report::truncate();

            Report::insert($csv_data);

            Session::flash('message','Data uploaded successfully');
        }
      
        // Redirect to index
        return back();
    }

    public function registrations()
    {
        //Get all onboarding percentages
        $percentages = Percentage::all();

        //Get weeks
        $report = new Report();
        $weeks = $report->getWeeks();

        //Fetch registration percentages per week
        $registrations = $report->getWeeklyRegistrations($weeks, $percentages);
        
        $response['title'] = "Onboarding Report";

        $response['subtitle'] = "From July to August 2016";

        $response['registrations'] = $registrations;

        return $response;
    }
}
