<?php
namespace App\Repositories\JadwalRepo;



use  Illuminate\Http\Request;

interface JadwalInterface
{
    public function jadwalPerDays(Request $request);
}
