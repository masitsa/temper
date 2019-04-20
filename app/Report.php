<?php

namespace App;

use App\Percentage;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Report extends Model
{
    public function getWeeks()
    {
        $result = DB::table('reports')
            ->selectRaw('WEEK(created_at) AS weeks')
            ->distinct()
            ->get();

        return $result;
    }

    private function getWeekPercentage($stage, $week_number)
    {
        return DB::table('reports')
        ->selectRaw('count(reports.user_id) AS total_registrations')
        ->whereRaw('reports.onboarding_perentage >= '.$stage.' AND WEEK(reports.created_at) = '.$week_number)
        ->get();
    }

    public function getWeeklyRegistrations($weeks, $percentages)
    {
        //Get registrations per week per onboarding percentage
        $all_registrations = Array();

        foreach($weeks as $row)
        {
            $week_number = $row->weeks;

            $weekly_registrations = Array();

            $total_weekly_registrations = 0;

            foreach($percentages as $res)
            {
                $value = $res->value;
                $name = $res->name;

                $registrations = $this->getWeekPercentage($value, $week_number);
                
                $onboarded_users = 0;

                foreach($registrations as $reg)
                {
                    $onboarded_users = $reg->total_registrations ? $reg->total_registrations : 0;
                }
                
                $weekly_registrations[] = $onboarded_users;

                ($total_weekly_registrations <= $onboarded_users) ? $total_weekly_registrations = $onboarded_users : null ;
            }
            
            //Calculate percentage
            for($r = 0; $r < count($weekly_registrations); $r++)
            {
                $percentage_total = ($weekly_registrations[$r] / $total_weekly_registrations) * 100;

                $weekly_registrations[$r] = round($percentage_total);
            }
                
            $all_registrations[] = Array
            (
                "name" => 'Week '.$week_number,

                "data" => $weekly_registrations
            );
        }

        return $all_registrations;
    }
}
