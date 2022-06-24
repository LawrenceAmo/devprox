<?php

namespace App\Exports;

use App\Models\Records;
use App\Models\UsersCSV; 
use Maatwebsite\Excel\Concerns\FromCollection; 
 use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;

  
class RecordsExport implements WithHeadings,  FromCollection
{
    protected $data;
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function __construct()
    {
        // $this->data = $data;
    }
  
    use Exportable;

    // public function query()
    // {
    //     return  UsersCSV::query()->select( "name", "surname", "age", "date_of_birth")->limit(5);
    // }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function collection()
    {
        return UsersCSV::select(  "name", "surname","initials", "age", "date_of_birth")->limit(5)->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings() :array
    {
        return [ "name", "surname", "initials","age", "date_of_birth" ];
    }
}
