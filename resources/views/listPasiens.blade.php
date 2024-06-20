@extends('layouts.app')
@section('content')

<div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Ruang</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Code Alat</th>
                                            <th>Kecepatan</th>
                                            <th>Pangaturan</th>
                                        </tr>
                                        @foreach($key as $s)
                                        <tr>
                                            <td>{{$s->nama}}</td>
                                            <td>{{$s->ruang}}</td>
                                            <td>{{$s->created_at}}</td>
                                            <td>{{$s->alat}}</td>
                                            <td>{{$s->tetes}}</td>
                                            <td>
                                                <a href="deletepasiens/{{$s->id}}" type="button" class="btn btn-danger">Hapus</a>
                                                <a href="editpasiens/{{$s->id}}" type="button" class="btn btn-warning">Edit</a>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


@endsection