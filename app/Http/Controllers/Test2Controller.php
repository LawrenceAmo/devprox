<?php

namespace App\Http\Controllers;

use App\Jobs\CreateUsers;
use Illuminate\Http\Request;
 use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Imports\RecordsImport;
use App\Jobs\CSVEports;
use App\Models\UsersCSV;
use App\Models\csv_import;
use Illuminate\Support\Facades\DB;

class Test2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = csv_import::simplePaginate(5);
        return view('test2')->with("users",$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    { 
        // get a file to be uploaded
        $path1 = $request->file('file')->store('temp'); 
        $file=storage_path('app').'/'.$path1;  

        // a queue, job to create all records a user requered / 
        CreateUsers::dispatch( $file);
        
        $num_users = new csv_import();
        $num_users = $num_users->get_users($file);

        return redirect()->back()->with("success", " Users are being stored to database, Check on the current records to see updates...");
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // API fun that update the data records on test 2 view (view current records)
        return csv_import::count();
    }

        /**
     * Delete all users / for test 2
     *
     */
    public function destroy()
    {
         DB::table("csv_imports")->delete();
        return redirect()->back()->with("success","All records deleted successfuly...");
    }

    /**
     * generate users and export csv file, with specified number of records
     * This function can take long if you need more user info (the more data you need the longer it takes to generate those users)
     * the recommended methode was to send this task to queue and generate all this in background, and send that file/data to an email when finished
     * I increased time and memory it take if more data is required
     */
    public function exportCSVDB(Request $request )
    {
        // increase momery and time if a user request more data. you can modify these numbers in php.ini file
        if ($request->number > 10000) {
            ini_set('memory_limit', '5120M');
            set_time_limit(10000);
        }

        // create new users
        $createUsers = new UsersCSV(); 
        $all_users_info =$createUsers->get_unique_users(intval($request->number)); // filter random generated data to remove all duplicated records

        $UsersExport = new UsersExport( $all_users_info);
        return  Excel::download( $UsersExport ,   "output.csv" );  // fire the download
        // return redirect()->back()->with("success","Your File will be downloaded soon...");
    }

   
}


 