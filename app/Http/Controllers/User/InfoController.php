<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(){
        $identitas = Identitas::first();
        return view('User.info', compact('identitas'));
    }
}
