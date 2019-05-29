<?php

namespace App\Imports;

use App\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function model(array $row)
    {



        return new Item([
            'group_name'     => $this->name,
            'name'     => $row[1],
            'phone'    => $row[2],
            'email'    => $row[3],
        ]);
    }
}
