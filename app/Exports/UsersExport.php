<?php

namespace App\Exports;

use App\Models\UsersCSV;
use Maatwebsite\Excel\Concerns\WithHeadings;
 use Maatwebsite\Excel\Concerns\Exportable;
 use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements WithHeadings, FromArray
{
    use Exportable;

     protected $data;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $csvUser = new UsersCSV(); 
         
        $all_users_info = $csvUser->get_only_requered_headers($this->data);

        return   $all_users_info;
        
    }

    //  public function collection()
    // {
    //      $csvUser = new UsersCSV(); 

    //     $all_users_info = $csvUser->get_only_requered_headers($this->data);

    //     return   $all_users_info;
    // }



    public function headings() :array
    {
        return [ "name", "surname", "initials","age", "date_of_birth" ];
    }
}
