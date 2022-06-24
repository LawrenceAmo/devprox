<?php

namespace App\Imports;

use App\Models\csv_import; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;


class RecordsImport implements ToModel, WithHeadingRow
{
        use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         if (!isset($row[0])) {
        return null;
    }
        return  
        new csv_import([
           "name" =>$row[1],
                "surname" =>$row["surname"],
                "initials" =>$row["initials"],
                "age" =>intval($row["age"]),
                "date_of_birth" =>   date_create($row["date_of_birth"]) ,
                
        ]);

      
    }
}
