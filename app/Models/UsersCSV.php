<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersCSV extends Model
{
    use HasFactory;
    protected $guarded = [];

public function digit2($digit){
        if (intval($digit) < 10 ) {
            return "0".$digit;
        }
        return $digit;
    }

      public function create_users_info(int $number=0)
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

   
    
    $number = intval($number);
    $user_info = [];

            for ($i=0; $i <$number ; $i++) { 

 
                    $name = $name_list[rand ( 0 , count($name_list) -1)];
                    $surname = $surname_list[rand ( 0 , count($surname_list) -1)];
                    $birth_day =  $this->digit2(rand ( 1 , 31)).'-'.$this->digit2(rand ( 1 , 12)).'-'. rand ( 1920 , 2020);    // Generate random dates

                    // get age from Date of birth
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

        public function unique_multidim_array($array, $key) {
            $temp_array = array();
            $i = 0;
            $key_array = array();
        
            foreach($array as $val) {
                if (!in_array($val[$key], $key_array)) {
                    $key_array[$i] = $val[$key];
                    $temp_array[$i] = $val;
                }
                $i++;
            }
                return $temp_array;
        }

   
   /* 
    * Create and filter duplicated users info
    * This can take long if a user requer more data
   */
    public function get_unique_users(int $number_of_users)
    {
        $limit = 0;
        $unique_generated_users = [];
        // $all_users = $this->create_users_info($number_of_users);
        $new_users = [];

        while (count($unique_generated_users) <= $number_of_users) {

                $number_of_users = $number_of_users - count($unique_generated_users);
        
                 $new_users =  array_merge( $unique_generated_users , $this->create_users_info($number_of_users));  // create users

                 $unique_generated_users = $this->unique_multidim_array($new_users, "uid");         // filter the duplicates

                if ($limit > 50 ||count($unique_generated_users) >= $number_of_users ) {   break;   }

                // $all_users = array_merge($this->create_users_info($number_of_users), $all_users);        
       
        $limit++;
        }

        return $unique_generated_users;
                   
    }

    public function save_all_users($users_info)
    { 
            foreach($users_info as $info){
                $user = new UsersCSV();
                $user->name = $info["name"]; 
                $user->surname = $info["surname"]; 
                $user->initials = $info["initials"];    
                $user->age = $info["age"];    
                $user->date_of_birth = date_create($info["birth_day"]);    
                $user->save();
                array_shift($users_info);
            }
            return true;
    }




    public function get_only_requered_headers(array $data)
    {
       $user_info = [];
       $i = 0;
            foreach($data as $user){
                $i++;
                array_push($user_info, [
                "#" => $i,
                "name" =>$user["name"],
                "surname" =>$user["surname"],
                "initials" =>$user["initials"],
                "age" =>$user["age"],
                "date_of_birth" => str_replace("-", "/", $user["birth_day"]),
                ]);
            }
        return $user_info;
    }

}
