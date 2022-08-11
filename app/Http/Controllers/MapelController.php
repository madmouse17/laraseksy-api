<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MapelController extends Controller
{
public function index($nis)
{
    // $user = $request->user();
    // $user->tokens()->delete();
    $siswa=Siswa::where('nis',$nis)->first();
    dd($siswa);
    $respon = [
        'status' => 'success',
        'msg' => 'Logout successfully',
        'errors' => null,
        'content' => null,
    ];
    return response()->json($respon, 200);
}
}
