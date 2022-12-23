<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Admin;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Distance;
use App\Models\tahunajaran;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);

        $date = Carbon::parse($request->tgl)->locale('id_ID');
        $diff = $date->dayName;
        //  dd($diff);
        $siswa = Siswa::where('nis', $request->nis)->first();
        $taja = Distance::first();
        $jadwal = Jadwal::where('kelas_id', $siswa->kelas_id)
            ->where('tahunajaran_id', $taja->tahunajaran_id)
            ->where('hari', $diff)
            ->select('jadwal', 'hari')
            ->first();
        // dd($jadwal);

        if ($jadwal == null) {
            $respon = [
                'status' => 'success',
                'msg' => 'Empty Data',
                'errors' => null,
                'content' => $jadwal,
            ];
        } else {
            $respon = [
                'status' => 'success',
                'msg' => 'Data Fetched',
                'errors' => null,
                'content' => $jadwal,
            ];
        }
        return response()->json($respon, 200);
    }


}
