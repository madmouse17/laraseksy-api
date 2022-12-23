<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\JadwalRepo\JadwalInterface;

class JadwalController extends Controller
{
    private JadwalInterface $jadwalInterface;
    public function __construct(JadwalInterface $jadwalInterface)
    {
        $this->jadwalInterface = $jadwalInterface;
    }
    public function index(Request $request)
    {
        try {
            return  $this->jadwalInterface->jadwalPerDays($request);

        } catch (\Exception $e) {
            return response()->error($e);
        }
    }
}
