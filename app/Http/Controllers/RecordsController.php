<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Imports\RecordsImport;
use App\Exports\recordsExport;
use Illuminate\Http\Request;
use App\Models\Records;

class RecordsController extends Controller
{ 
    // $data var is user data from form []
    // get test 1 form page
    public function index(Request $request)
    {
        $data=[
            'name'=> ''
        ];
        // get users from DB, Limit according to the pagination you want
        // $users = DB::table('users')->simplePaginate(5); // number of rows to display in view, you can set to any number
 
        return view('test2')->with('data', $data)->with('users',''); 
    } 

    private function user_full_names(int $number=0)
    {
       
        $name_list = array(
        'Juan',
        'Luis',
        'Pedro',
        'Christopher',
        'Ryan',
        'Ethan',
        'John',
        'Zoey',
        'Sarah',
        'Michelle',
        'Samantha',                
        "Albert",
        "Alberta",
        "Jennine",
        "Jenny",
        "Jerald",
        "Jeraldine",
        "Jeramy",
        "Jere",
        "Jeremiah",
        "Jeremy",
        // "Jeri",
        // "Jerica",
        // "Jerilyn",
        // "Jerlene",
        // "Jermaine",
        // "Jerold",
        // "Jerome",
        // "Jeromy",
        // "Jerrell",
        // "Jerri",
    );

    // Surnames
        $surname_list = array(
       'Walker',
        'Thompson',
        'Anderson',
        'Johnson',
        'Tremblay',
        'Peltier',
        'Cunningham',
        'Simpson',
        'Mercado',
        'Sellers',
        "Jenny",
        "Jerald",
        "Jeraldine",
        "Jeramy",
        "Jere",
        "Jeremiah",
        "Jeremy",
        "Jeri",
        "Jerica",
        "Jerilyn",
        // "Jerlene",
        // "Jermaine",
        // "Jerold",
        // "Jerome",
        // "Jeromy",
        // "Jerrell",
        // "Jerri",
    );

    function make_2digits($digit){
        if (intval($digit) < 10 ) {
            return "0".$digit;
        }
        return $digit;
    }
    
    $number = intval($number);
    $user_info = [];

            for ($i=0; $i <$number ; $i++) { 

                    $name = $name_list[rand ( 0 , count($name_list) -1)];
                    $surname = $surname_list[rand ( 0 , count($surname_list) -1)];
                    $birth_day =  make_2digits(rand ( 1 , 31)).'-'.make_2digits(rand ( 1 , 12)).'-'.make_2digits(rand ( 1920 , 2020));    // Generate random dates

                    //   age from Date of birth
                   $age = date_diff(date_create($birth_day), date_create('today'))->y;

                   $uid = implode([
                            'name'=>$name,
                            'surname' => $surname,
                            'initials' => $name[0],
                            'age' => $age,
                            'birth_day' => $birth_day,
                         ]);

                    array_push($user_info, [
                        'uid' => $uid,
                        'name'=>$name,
                        'surname' => $surname,
                        'initials' => $name[0],
                        'age' => $age,
                        'birth_day' => $birth_day,
                    ] );
            }

      return  $user_info; 
    }


    public function random_user_info(Request $request)
    {
        // return $request->number;
        

        // for( $i = 0; $i < $request->number; $i++){
            // $number = $request->number || 2;
            $users =$this->user_full_names($request->number);
        // }
        
       $output =  (new FastExcel($users))->export('files.xlsx');

        return   $users;
    }

            // return Excel::download(new RecordsExport, 'users.xlsx');
            // return Excel::download(new RecordsExport, 'users-collection.xlsx');
    

    public function save_user_info( Request $request) 
    {
        for ($i=0; $i <count($request->users_info) ; $i++) { 
         
                     $user = new Records();
                    $user->name = $request->users_info[$i]["name"]; 
                    $user->surname = $request->users_info[$i]["surname"]; 
                    $user->initials = $request->users_info[$i]["initials"];    
                    $user->date_of_birth = date_create($request->users_info[$i]["birth_day"]);    
                    $user->age = $request->users_info[$i]["age"];    
                    $user->save();

        }

            
            return $request->users_info[0] ;
    }    
}
