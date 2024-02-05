<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;


class AuthController extends Controller
{

    // halaman login
    public function index()
    {
        if(session('user')){
            return redirect('/');
        }else{
            return view('login.login',  ['title' => 'Login | BK Administration']);
        }
        
    }

    // proses login
    public function prosesLogin(Request $request)
    {
        $email = $request->user;
        $password = $request->password;


        $data = Sheets::spreadsheet('16iXiHIWgpdlVbXDaeWleWzeaZUeBFlET8VhB2S0gA20')
            ->sheet('datauser')
            ->all();
            
        $data = json_decode(json_encode($data), true);
        
        $user = array_filter($data, function ($item) use ($email, $password) {
            return $item[3] == $email && $item[2] == $password;
        });

        // masukkan data user ke dataarray
        $dataarray =[];
        foreach ($user as $key => $value) {
            $dataarray[] = $value;
        }

        if (count($user) > 0) {
            session(['user' => $dataarray]);
            return redirect('/');
        } else {

            return redirect('/login')->with('message', 'Login Failed');
        }
    }

    // logout
    public function logout(Request $request)
    {
        session()->forget('user');

        $request->session()->flush();
        return redirect('/login')->with('message', 'Logout Success');
    }
}
