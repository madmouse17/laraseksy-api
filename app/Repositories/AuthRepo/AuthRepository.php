<?php
namespace App\Repositories\AuthRepo;

use App\Models\Siswa;
use App\Models\Distance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AuthRepo\AuthInterface;

class AuthRepository implements AuthInterface
{
    public function credentials($request)
    {
        // dd(request());
        $credentials = request(['nis', 'password']);
        if (!Auth::attempt($credentials)) {
            $respon = [
                'type' => 'error',
                'title'=>'Peringatan!',
                'msg' => "NIS atau Password Yang Anda Masukkan Salah",
            ];
            return response()->json($respon, 401);
        }
    }
    public function Authorize($request)
    {
        $user = Siswa::where('nis', $request['nis'])->first();
        if (!Hash::check($request['password'], $user['password'], [])) {
            $respon = [
                'type' => 'error',
                'title'=>'Peringatan!',
                'msg' => "Password Yang Anda Masukkan Salah",
            ];
            return response()->json($respon, 401);

        }

        $tokenResult = $user->createToken('token-auth')->plainTextToken;
        $data = Siswa::where('nis', $request['nis'])
            ->selectRaw('nis,nama,kelas.kelas kelas,kelas.id kelas_id')
            ->leftjoin('kelas', 'kelas.id', 'siswas.kelas_id')
            ->first();
        $taja = Distance::selectRaw('tahunajarans.tahun tahunajaran,tahunajarans.id tahunajaran_id,semesters.semester semester,semesters.id semester_id')
        ->leftjoin('tahunajarans', 'tahunajarans.id', 'distances.tahunajaran_id')
        ->leftjoin('semesters', 'semesters.id', 'distances.semester_id')
        ->first();

        $respon = [
            'type' => 'success',
            'title'=>'Berhasil',
            'msg' => 'Login Berhasil',
            'login' => [
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'data'=>collect($data),
                'sekolah'=>$taja
            ]
        ];
        return response()->json($respon, 200);
    }

}
