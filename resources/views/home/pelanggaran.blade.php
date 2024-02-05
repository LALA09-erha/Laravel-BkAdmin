@extends('home/tamplate/tamplate')
    
@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pelanggaran</h3>
                <p class="text-subtitle text-muted">For Pelanggaran to check they list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pelanggaran</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    Tambah Jenis Pelanggaran
                </button>
                <a href="https://docs.google.com/spreadsheets/d/1Yx0p1XJStQ8RPUHbr3VpoVuAn4zwWM-xckxbrE9BoXU/edit#gid=1271295487" target="_blank" class="btn btn-outline-success">Custom Jenis Pelanggaran</a>

                <!--login form Modal -->
                <div class="modal fade text-left" id="inlineForm" tabindex="-1"
                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                    Tambah Pelanggaran</h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/tambahpelanggaran" method="post" style="width:100%">
                                    @csrf
                                    <div class="form-group has-icon-left" style="width: 100%">
                                        <label for="password-id-icon">Jenis Pelanggaran</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control" name="jenis"
                                                placeholder="Jenis Pelanggaran" id="password-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group has-icon-left" style="width: 100%">
                                        <label for="mobile-id-icon">Point Pelanggaran</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control" name="point"
                                                placeholder="Point Pelanggaran" id="mobile-id-icon" required>
                                            <div class="form-control-icon">
                                                <i class="bi bi-check"></i>
                                            </div>
                                        </div>
                                    </div>                           
                        
                                </div>
                                <div class="modal-footer">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset"
                                            class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Jenis Pelanggaran</th>
                            <th>Point</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach ($pelanggaran as $data)                      
                        <tr>
                            <td>{{$data[0]}}</td>
                            <td>{{$data[1]}}</td>
                            <td>{{$data[2]}}</td>       
                            {{-- <td>
                                <a href="/deletepelanggaran/{{$data[0]}}" class="btn btn-danger">Delete</a>
                            </td> --}}

                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
@endsection