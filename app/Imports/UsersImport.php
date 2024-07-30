<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

    

class UsersImport implements ToCollection
{
    public function collection(Collection $row)
    {
        
        return $row;
    }
    
}
