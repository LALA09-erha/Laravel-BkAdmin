<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class HomeController extends Controller
{
    public function index()
    {
        if(session('user')){
            // dd(session('user'));
            $log = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
            ->sheet('logpoint')
            ->all();

            $log = json_decode(json_encode($log), true);

            // menghitung jumlah total log otomatis 
            $totallog = count($log)-1;

            $siswas =  Sheets::spreadsheet('1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM')
            ->sheet('datasiswa')
            ->all();


            $siswas = json_decode(json_encode($siswas), true);
            $totalsiswa = count($siswas)-1;

            return view('home.dash',  ['title' => 'Home | BK Administration' , 'totallog' => $totallog, 'totalsiswa' => $totalsiswa]);
        }else{
            return redirect('/login');
        }
        
    }
}
