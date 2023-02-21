<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Pemberitahuan::where('status', 'aktif')->get(),
        ]);
    }
}
