@extends('layouts.app')

@section('content')
<div class="container-cont d-flex justify-content-center align-items-center" style="height: calc(100vh - 50px);">
    <div class="row mx-auto">
        <div class="col-md-3 mb-4 mr-5">
            <div class="box bg-primary text-white text-center">
                <p class="judul">Pasien</p>
                <p class="nomer-kamar">{{ $countPasien }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="box bg-primary text-white text-center">
                <p class="judul">Alat</p>
                <p class="nomer-kamar">{{ $countAlat }}</p>
            </div>
        </div>
        <div class="col-md-3 mb-4 ml-5">
            <div class="box bg-primary text-white text-center">
                <p class="judul">Admin</p>
                <p class="nomer-kamar">{{ $countAdmin }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
