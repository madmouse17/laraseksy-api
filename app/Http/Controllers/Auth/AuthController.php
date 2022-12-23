<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use App\Models\Distance;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AuthRepo\AuthInterface;

class AuthController extends Controller
{
    private AuthInterface $authRepo;
    public function __construct(AuthInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function login(LoginRequest $request)
    {
        dd($request);

        if (!$request->validated()) {
            $respon = [
                'type' => 'error',
                'title' => 'Peringatan!',
                'msg' => $request->errors(),
            ];
            return response()->json($respon, 401);
        } else {
            $credentials = $this->authRepo->credentials($request->validated());
            if ($credentials) {
                return $credentials;
            }
            $data = $this->authRepo->Authorize($request->validated());
            return $data;
        }
    }
    public function uploadImage(Request $request)
    {
        // dd($request);
        $path = storage_path('app/public/' . $request->dirpath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->hasfile('image')) {
            $file = $request->file('image');

            $fileName = $file->getClientOriginalName();

            $file->move($path, $fileName);
            $data = [
                'type' => 'success',
                'msg' => 'Upload Siswa Sukses',
                'title' => 'Berhasil',
            ];

            return response()->json($data, 200);
        }
    }

    public function downloadImage(Request $request)
    {
        $user = $request->user();
        $file = storage_path() . "/app/public/siswa/" . $user->image;

        $headers = array('Content-Type: image/png');

        return response()->download($file, 'siswa' . $user->nis . '-' . $user->nama . '_' . uniqid() . '.png', $headers);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        $user->currentAccessToken()->delete();
        $respon = [
            'type' => 'success',
            'msg' => 'Keluar dari Aplikasi',
            'title' => 'Berhasil'
        ];
        return response()->json($respon, 200);
    }

    public function logoutall(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        $respon = [
            'msg' => 'Keluar dari Aplikasi',
            'type' => 'success',
            'title' => 'Berhasil'
        ];
        return response()->json($respon, 200);
    }
}
