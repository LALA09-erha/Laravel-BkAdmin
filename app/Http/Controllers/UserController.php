<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;


class UserController extends Controller
{
    // halaman users
    public function index()
    {   
        if(session('user')[0][4] == "Admin"){
            // mengambil semua data users dari google sheet
            $data = Sheets::spreadsheet('16iXiHIWgpdlVbXDaeWleWzeaZUeBFlET8VhB2S0gA20')
            ->sheet('datauser')
            ->all();

            $data = json_decode(json_encode($data), true);
            
            return view('home.users',  ['title' => 'Users | BK Administration', 'data' => $data]);
        }else{
            return redirect('/login');
        }
        
    }


}
