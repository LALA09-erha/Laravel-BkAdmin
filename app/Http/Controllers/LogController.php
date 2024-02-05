<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;


class LogController extends Controller
{

    // view log 
    public function index()
    {
        // mengambil semua data users dari google sheet
        $log = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('logpoint')
        ->all();

        $log = json_decode(json_encode($log), true);

        

        $siswas =  Sheets::spreadsheet('1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM')
        ->sheet('datasiswa')
        ->all();

        $siswas = json_decode(json_encode($siswas), true);

        return view('home.log', ['title' => 'Log Perilaku | BK Administration' , 'log' => $log, 'siswas' => $siswas
    ]);
    }

    // view tambah log
    public function logmanagement(){


        $pelanggaran = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('pelanggaran')
        ->all();

        $pelanggaran = json_decode(json_encode($pelanggaran), true);

        $kebaikan = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('kebaikan')
        ->all();

        $kebaikan = json_decode(json_encode($kebaikan), true);

        return view('home.logmanagement', ['title' => 'Tambah Log Siswa | BK Administration' , 'pelanggaran' => $pelanggaran, 'kebaikan' => $kebaikan
    ]);
    }

    // tambah log siswa
    public function tambahlogsiswa(Request $request)
    {   
        $idsiswa = $request->idsiswa;
        // check apakah siswa ada
        $siswas =  Sheets::spreadsheet('1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM')
        ->sheet('datasiswa')
        ->all();

        $siswas = json_decode(json_encode($siswas), true);

        $check = false;
        foreach($siswas as $siswa){
            if($siswa[0] == $idsiswa){
                $check = true;
                $datasiswa = $siswa;
            }
        }

        if($check == false){
            return redirect('/logmanagement')->with('message', 'Data gagal ditambahkan! Siswa tidak ditemukan!');
        }

        // jenis 
        $jenis = $request->jenis;
        if($jenis == '1'){
            $jenis = 'Pelanggaran';
            $detail = $request->pelanggaran;
        }else if($jenis == '2'){
            $jenis = 'Kebaikan';
            $detail = $request->kebaikan;
        }
        else{
            return redirect('/logmanagement')->with('message', 'Data gagal ditambahkan! Siswa tidak ditemukan!');
        }

        // id admin 
        $idadmin = session('user')[0][0];
        $date = date('d-m-Y H:i:s');
        
        // menghitung id terakhir dan menambahkan 1
        $id = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('logpoint')
        ->all();

        // mengambil id yang terbesar   
        // $id = count($id) + 1;
        $id = json_decode(json_encode($id), true);
        if(count($id) == 1){
            $id = 1;
        }else{
            $id = end($id)[0] + 1;
        }

        $data = [
            $id,
            $date,
            $idsiswa,
            $jenis,
            $detail,
            $idadmin,
        ];
       
        // update data point siswa di $datasiswa pada kolom point 
        if($jenis == 'Pelanggaran'){
            $datasiswa[6] = intval($datasiswa[6]) - intval(substr($detail,-1));
        }else{
            $datasiswa[6] = intval($datasiswa[6]) + intval(substr($detail,-1));
        }

        // update data point siswa di google sheet
        $id = $datasiswa[0] + 1;
        $test =  Sheets::spreadsheet('1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM')
        ->sheet('datasiswa')
        ->range('A'.$id.':G'.$id)->update([$datasiswa]);



        // menambahkan data ke google sheet
        Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('logpoint')
        ->append([$data]);
        return redirect('/logperilaku')->with('message', 'Data berhasil ditambahkan!');
    }

    // view pelanggaran
    public function pelanggaran()
    {
        // mengambil semua data users dari google sheet
        $pelanggaran = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('pelanggaran')
        ->all();

        $pelanggaran = json_decode(json_encode($pelanggaran), true);
        return view('home.pelanggaran', ['title' => 'Jenis Pelanggaran | BK Administration' , 'pelanggaran' => $pelanggaran
    ]);
    }

    // tambah pelanggaran
    public function tambahpelanggaran(Request $request)
    {   
        $jenis = $request->jenis;
        $poin = $request->point;

        
        // menghitung id terakhir dan menambahkan 1
        $id = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('pelanggaran')
        ->all();

        // mengambil id yang terbesar   
        // $id = count($id) + 1;
        $id = json_decode(json_encode($id), true);
        if(count($id) == 1){
            $id = 1;
        }else
            $id = end($id)[0] + 1;

        // membuat array data
        $data = [
            $id,
            $jenis,
            $poin
        ];
        // menambahkan data ke google sheet
        Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('pelanggaran')
        ->append([$data]);
        return redirect('/pelanggaran')->with('message', 'Data berhasil ditambahkan!');
    }

    // // delete pelanggaran
    // public function deletepelanggaran($id)
    // {
    //     if($id == 'ID'){
    //         return redirect('/pelanggaran')->with('message', 'Data gagal dihapus!');
    //     }
    //     $id = $id + 1;
    //     // update data yang $id nya sama dengan $id yang dikirimkan menjadi kosong
    //    $test =  Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
    //     ->sheet('pelanggaran')
    //     ->range('A'.$id.':C'.$id)->update([['','','']]);
    //     return redirect('/pelanggaran')->with('message', 'Data berhasil dihapus!');
    // }


    // view kebaikan
    public function kebaikan()
    {
        // mengambil semua data users dari google sheet
        $kebaikan = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('kebaikan')
        ->all();

        $kebaikan = json_decode(json_encode($kebaikan), true);
        return view('home.kebaikan', ['title' => 'Jenis Kebaikan | BK Administration' , 'kebaikan' => $kebaikan
    ]);
    }

    // tambah kebaikan
    public function tambahkebaikan(Request $request)
    {   
        $jenis = $request->jenis;
        $poin = $request->point;

        
        // menghitung id terakhir dan menambahkan 1
        $id = Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('kebaikan')
        ->all();

        // mengambil id yang terbesar   
        // $id = count($id) + 1;
        $id = json_decode(json_encode($id), true);
        if(count($id) == 1){
            $id = 1;
        }else
            $id = end($id)[0] + 1;

        // membuat array data
        $data = [
            $id,
            $jenis,
            $poin
        ];
        // menambahkan data ke google sheet
        Sheets::spreadsheet('1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU')
        ->sheet('kebaikan')
        ->append([$data]);
        return redirect('/kebaikan')->with('message', 'Data berhasil ditambahkan!');
    }
}
