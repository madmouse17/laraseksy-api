<?php

namespace App\Repositories\JadwalRepo;

use App\Helper\helper;
use App\Http\Resources\JadwalResource;
use App\Models\Day;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Distance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class JadwalRepository implements JadwalInterface
{
    public function jadwalPerDays(Request $request)
    {

        $date = Carbon::parse($request['tgl'])->locale('id_ID');
        $day = $date->dayName;

        $id = Crypt::decryptString($request['id']);
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->error('Data Tidak Ditemukan', 404);
        }
        $days = Day::where('hari', $day)->first();
        $taja = Distance::first();
        $jadwal = Jadwal::with(['day', 'jadwaldetail', 'jadwaldetail.admin','jadwaldetail.mapel'])
            ->where('kelas_id', $siswa->kelas_id)
            ->where('tahunajaran_id', $taja->tahunajaran_id)
            ->where('day_id', $days->id)
            // ->select('jadwal', 'hari')
            ->first();
        // dd($jadwal);
        if (!$jadwal) {
            return response()->error('Jadwal Kosong', 404);
        } else {
            $data = new JadwalResource($jadwal);
            return response()->success($data);
        }
    }
}
