<?php

namespace App\Repositories\AuthRepo;

use App\Http\Resources\AuthResource;
use App\Http\Resources\DistanceResource;
use App\Models\Siswa;
use App\Models\Distance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AuthRepo\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function credentials($request)
    {
        $nis = Siswa::where('nis', $request['nis'])->first();
        if (!$nis) {
            return response()->error("Data Tidak Ditemukan", 404);
        }
        $credentials = request(['nis', 'password']);
        if (!Auth::attempt($credentials)) {

            return response()->error("NIS atau Password Yang Anda Masukkan Salah");
        }
    }
    public function Authorize($request)
    {
        $user = Siswa::where('nis', $request['nis'])->first();
        if (!Hash::check($request['password'], $user['password'], [])) {

            return response()->error("Password Yang Anda Masukkan Salah");
        }

        $tokenResult = $user->createToken('token-auth')->plainTextToken;
        $siswa = Siswa::with('kelas')->where('nis', $request['nis'])
            ->first();
        $data = new AuthResource($siswa);
        // dd($data);

        $taja = new DistanceResource(Distance::with(['taja','semester'])->first()) ;
        $respon = [
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'data' => $data,
            'sekolah' => $taja
        ];

        return response()->success($respon);
    }
}
