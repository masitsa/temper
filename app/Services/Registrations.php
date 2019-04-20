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
}