<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class csv_import extends Model
{
    use HasFactory;
     protected $guarded = [];


    //  get all the records from csv file
     public function get_users($file)
    { 
        $data = [];
        $handle = fopen($file, "r");
        for ($i = 0; $row = fgetcsv($handle ); ++$i) {
            array_shift($row); // remove the number that identify the row/user
            array_push($data, $row);
        }
        fclose($handle);
        array_shift($data);  // remove the headers
        return $data;
     }


    //  Save users to all database 
      public function save_all_users($users_info)
    { 
            foreach($users_info as $info){
                $user = new csv_import();
                $user->name = $info[0]; 
                $user->surname = $info[1]; 
                $user->initials = $info[2];    
                $user->age = $info[3];    
                $user->date_of_birth = date_create(str_replace("/", "-",$info[4]));  // format the date from [dd/mm/yyy] to [dd-mm-yyy] to store it to database  
                $user->save();
                array_shift($users_info);
            }
            return true;
    }

}
