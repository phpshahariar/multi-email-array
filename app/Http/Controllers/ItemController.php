<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
class ItemController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport(), 'items.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $name = $request->input('group_name');
        $file = $request->file('file');
         Excel::import(new UsersImport($name),$file);


        return back();
    }
}
