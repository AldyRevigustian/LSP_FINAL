<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function index(){
            $pemberitahuans = Pemberitahuan::where('status', 'aktif')->get();
            $kategoris = Kategori::all();
            return view('User.dashboard', compact('pemberitahuans', 'kategoris'));
        }
}
