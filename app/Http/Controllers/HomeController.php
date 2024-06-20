<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\sensor;
use App\Models\Pasien;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $countPasien = Pasien::count();
        $countAlat = sensor::count();
        $countAdmin = User::count(); // Menghitung semua pengguna sebagai admin

        return view('home', compact('countPasien', 'countAlat', 'countAdmin'));
    }

    public function testing()
    {
        return view('testing');
    }
}

