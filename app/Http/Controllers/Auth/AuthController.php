<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Distance;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nis' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {

            $credentials = request(['nis', 'password']);
            // $credentials = Arr::add($credentials, 'status', 'aktif');
            if (!Auth::attempt($credentials)) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unathorized',
                    'errors' => null,
                    'content' => null,
                ];
                return response()->json($respon, 401);
            }

            $user = Siswa::where('nis', $request->nis)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Error in Login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $data = Siswa::where('nis', $request->nis)
                ->selectRaw('nis,nama,kelas.kelas kelas')
                ->leftjoin('kelas', 'kelas.id', 'siswas.kelas_id')
                ->first();
            $taja = Distance::selectRaw('tahunajarans.tahun tahunajaran,semesters.semester semester')
            ->leftjoin('tahunajarans', 'tahunajarans.id', 'distances.tahunajaran_id')
            ->leftjoin('semesters', 'semesters.id', 'distances.semester_id')
            ->first();

            // dd($data);
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'errors' => null,
                'content' => [
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer',
                    'data'=>$data,
                    'sekolah'=>$taja
                ]
            ];
            return response()->json($respon, 200);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }

    public function logoutall(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'status' => 'success',
            'msg' => 'Logout successfully',
            'errors' => null,
            'content' => null,
        ];
        return response()->json($respon, 200);
    }
}
