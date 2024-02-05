@extends('home/tamplate/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Siswa</h3>
                <p class="text-subtitle text-muted">For siswa to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                @if (session('user')[0][4] == "Admin")
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    Custom Data Siswa
                </button>
                @endif
                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Custom Data Siswa</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <p>Harap yang Mengakses Hanya Admin Atau Petugas Yang terkait</p>    
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex justify-content-end">
                                        {{-- url class button redirect to ulr --}}
                                        <a href="https://docs.google.com/spreadsheets/d/1FmwFDcO8cr7dWOnOJpw3um4Op3SWp9C1c_EeKU8xNHM/edit#gid=0" target="_blank"  class="btn btn-primary me-1 mb-1">Submit</a>                                        
                                        <button class="close btn btn-light-secondary me-1 mb-1" data-bs-dismiss="modal"
                                        aria-label="Close"
                                            >Kembali</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Tahun Ajaran</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Point</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach ($data as $user)                      
                        <tr>
                            <td>{{$user[0]}}</td>
                            <td>{{$user[1]}}</td>
                            <td>{{$user[2]}}</td>
                            <td>{{$user[3]}}</td>
                            <td>{{$user[4]}}</td>
                            <td>{{$user[5]}}</td>
                            <td>{{$user[6]}}</td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection