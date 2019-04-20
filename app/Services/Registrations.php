<?php

namespace App\Services;

class Registrations
{
    public function uploadFile($request)
    {
        if ($request->input('submit') != null )
        {
            $file = $request->file('csv_file');
      
            // File Details 
            $filename = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $tempPath = $file->getRealPath();

            $fileSize = $file->getSize();

            $mimeType = $file->getMimeType();

            if($extension == 'csv')
            {
                $handle = fopen($tempPath, "r");
    
                $result = Array();
    
                $header_string = fgetcsv($handle); //Removes the first line of headings in the csv
    
                $header_array = explode(';', $header_string[0]);
    
                while($data = fgetcsv($handle))
                {
                    $row = explode(';', $data[0]);
    
                    $registration = array
                    (
                        $header_array[0] => (int)$row[0],
                        $header_array[1] => $row[1],
                        $header_array[2] => (int)$row[2],
                        $header_array[3] => (int)$row[3],
                        $header_array[4] => (int)$row[4]
                    );

                    $result[] = $registration;
                }
    
                return $result;
            }
            
            else
            {
                Session::flash('message','Invalid file extension. Please try again');
            }

        }
            
        else
        {
            Session::flash('message','Invalid File. Please try again');
        }

        return FALSE;
    }
    
    public function getRegistrations()
    {
        $filename = 'export.csv';

        $filepath = storage_path("app\\public\\".$filename);

        $handle = fopen($filepath, "r");

        $result = Array();

        $header_string = fgetcsv($handle); //Removes the first line of headings in the csv

        $header_array = explode(';', $header_string[0]);

        while($data = fgetcsv($handle))
        {
            $row = explode(';', $data[0]);

            $registration = array
            (
                $header_array[0] => $row[0],
                $header_array[1] => $row[1],
                $header_array[2] => $row[2],
                $header_array[3] => $row[3],
                $header_array[4] => $row[4]
            );

            $result[] = $registration;
        }

        return $result;
    }

    public function getDailyRegistrations($csv_data, $unique_dates)
    {
        $date_registrations = Array();

        for($r = 0; $r < count($unique_dates); $r++)
        {
            $date = $unique_dates[$r];

            $count_create_account = 0;

            $count_activate_account = 0;

            $count = 0;

            $count = 0;

            $count = 0;

            $count = 0;

            $count = 0;

            $count = 0;

            for($s = 0; $s < count($csv_data); $s++)
            {
                if(($csv_data['created_at'] == $date) && ($csv_data['onboarding_perentage'] == '0'))
                {
                    $stage = getStageName($csv_data['onboarding_perentage']);

                    $count++;
                }
            }

            $date_registrations[$date] = $count;
        }

        return $date_registrations;
    }

    private function getStageName($percentage)
    {
        $stage = false;

        switch($percentage)
        {
            case '0' : 

                $stage = 'Create Account';

                break;

            case '20' : 

                $stage = 'Activate Account';

                break;
                
            case '40' : 

                $stage = 'Profile Information';

                break;
                
            case '50' : 

                $stage = 'Job Interest';

                break;
                
            case '70' : 

                $stage = 'Work Experience';

                break;
                
            case '90' : 

                $stage = 'Freelancer Status';

                break;
                
            case '99' : 

                $stage = 'Pending Approval';

                break;
                
            case '100' : 

                $stage = 'Approval';

                break;
        }

        return $stage;
    }
}