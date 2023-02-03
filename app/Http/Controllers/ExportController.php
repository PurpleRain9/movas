<?php

namespace App\Http\Controllers;
use Artisan;
use Exception;
use Illuminate\Http\Request;
use Log;
use Flash;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
class ExportController extends Controller
{
    // export data.sql file
    public function backup(){
        try {
            // start the backup process
            Artisan::call('backup:run --only-db --disable-notifications');
            $output = Artisan::output();
            dd($output);
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            $path = storage_path('app/Laravel/*'); // save in storage/app/Laravel-Admin
            $latest_ctime = 0;
            $latest_filename = '';
            $files = glob($path);
            foreach($files as $file)
            {
                if (is_file($file) && filectime($file) > $latest_ctime)
                {
                        $latest_ctime = filectime($file);
                        $latest_filename = $file;
                }
            }
            return response()->download($latest_filename);
            Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            print_r($e->getMessage());
        
        }
   

   
    }
}
