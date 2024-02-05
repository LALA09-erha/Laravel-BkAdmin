@extends('home/tamplate/tamplate')
    
@section('content')

<div class="page-heading">
    <h3>Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-14">       
                                        <p class= 'text-center'>Total Aktivitas Siswa</p>                                                                                                         
                                        <h2 class="text-center font-semibold">{{$totallog}} Aktivitas</h2>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-12 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-14">                                        
                                        <p class= 'text-center'>Total Siswa</p>                                    
                                        <h2 class="text-center font-semibold">{{$totalsiswa}} Orang</h2>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        
        

        <div class="col-12 col-lg-8">
            <div class="card m-2">
                <h2 class="text-center">Informasi Tambahan</h2>                        
                    <div class="card m-2">
                        <p >Guru Hanya Dapat Menambah Log Siswa, Melihat Data Siswa</p>
                    </div>
            </div>

            <div class="card m-2">
                    <div class="card m-2">
                        <p class="m-2">Jika Berkaitan Dengan Data Baik Data Siswa, Guru, Dan Lainnya . Harap Menggubungi Admin Terkait 😁</p>
                    </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <img src="https://www.officelovin.com/wp-content/uploads/2019/01/squeeze-studio-animation-office-6.jpg" alt="Gambar Dashboard" width="100%" >                
        </div>

    </section>
</div>
@endsection