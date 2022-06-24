<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    // $data var is user data from form []
    // get test 1 form page
    public function index(Request $request, $data=[])
    {
        // get users from DB, Limit according to the pagination you want
        $users = DB::table('users')->simplePaginate(5); // number of rows to display in view, you can set to any number

        // set the form inputs to empty string on first page load
         if (!$request->has(['surname','name','id_number', 'date_of_birth' ])) {
           $data = [
            "name" => "",
            "surname" => "",
            "id_number" => "",
            "date_of_birth" => "",
        ];
         }
 
        return view('test1')->with('data', $data)->with('users',$users); 
    }    



    //   Create the User
    public function create_user(Request $request)
    {
        $validated = $request->validate([
            'surname' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'name' => ['required','regex:/^[a-zA-Z]+$/u', 'string', 'max:255'],
            'id_number' =>  ['required', 'unique:users','digits:13' ],
            'date_of_birth' =>  ['required', 'date' ],
         ]);
        //  Get form data
        $name = $request->name;
        $surname = $request->surname;
        $id = $request->id_number;
        $date_of_birth = date_create($request->date_of_birth);
        $date_of_birth = date_format($date_of_birth,"d/m/Y");       // formart the date to [ dd/mm/yyyy ]
       
        // Get date of birth from the ID Number instead
            $day = substr($id,4,2);
            $month = substr($id,2,2);
            $year = substr($id,0,2); 

            if (intval($year) <=22 && intval($year) >=00 ) {
            $year = "20".$year;
            }else{
            $year = "19".$year;
            }
            $dob_from_id = $year."-".$month."-".$day;

            // check if Date of birth is the same as from ID Number
            $validated = $request->validate([
                'date_of_birth' =>  ['in:'.$dob_from_id ],
            ]);
 
            // create New User
            $user = new User();
            $user->name = $name; 
            $user->surname = $surname; 
            $user->id_number = $id;    
            $user->date_of_birth = $date_of_birth;    
            $user->save();
        return redirect()->to('test1')->with('success','user created successfully!');
    }

    

    // Destroy/delete a user by ID
    public function destroy_user(Request $request)
    {    
        DB::table('users')->where('id', '=', intval($request->userID))->delete();
       return redirect()->to('test1')->with('success','user Deleted successfully!');
    }

}
