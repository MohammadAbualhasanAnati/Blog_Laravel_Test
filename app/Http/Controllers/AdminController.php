<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function users(){
        $firstNames=User::pluck('first_name')->toArray();
        $lastNames=User::pluck('last_name')->toArray();
        return view('admin.users',[
            'firstNames'=>$firstNames,
            'lastNames'=>$lastNames,
        ]);
    }
}
