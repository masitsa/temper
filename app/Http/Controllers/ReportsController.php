<?php

namespace App\Http\Controllers;

use App\Report;

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
            DB::table('reports')->truncate();

            Report::insert($csv_data);

            Session::flash('message','Data uploaded successfully');
        }
      
        // Redirect to index
        return back();
    }

    public function registrations()
    {
        $report = new Report();
        $registrations = $report->getWeeklyRegistrations();
        
        $response['title'] = "Onboarding Report";

        $response['subtitle'] = "From July to August 2016";

        $response['registrations'] = $registrations;

        return $response;
    }

    // public function registrations()
    // {
    //     //Get all registration data
    //     $registrations = new Registrations();

    //     $csv_data = $registrations->getRegistrations();

    //     dd($csv_data);

    //     //Get unique dates
    //     $unique_dates = array_values(array_unique(array_map(function ($i) { return $i['created_at']; }, $csv_data)));
        
    //     //Get registrations per day
    //     $daily_registrations = $registrations->getDailyRegistrations($csv_data, $unique_dates);

    //     $response['title'] = "Onboarding Report";

    //     $response['subtitle'] = "From July to August 2016";

    //     $response['data'] = $csv_data;

    //     return $response;
    // }
}
