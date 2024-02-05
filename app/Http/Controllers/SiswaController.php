<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class SiswaController extends Controller
{
    public function index()
    {
        // mengambil semua data users dari google sheet
        $data = Sheets::spreadsheet('1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM')
        ->sheet('datasiswa')
        ->all();

        $data = json_decode(json_encode($data), true);
        return view('home.siswas', ['title' => 'Siswa | BK Administration', 'data' => $data]);
    }
}
