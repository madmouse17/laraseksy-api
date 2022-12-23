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
        try {
             $credentials=$this->authRepo->credentials($request->validated());
            if ($credentials) {

                return $credentials;
            }
            $data = $this->authRepo->Authorize($request->validated());
            return $data;
        } catch (\Exception $e ) {
            // dd($e);
            return response()->error( $e);
        }
    }
    public function uploadImage(Request $request)
    {
        try {
            $path = storage_path('app/public/' . $request->dirpath);

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            if ($request->hasfile('image')) {
                $file = $request->file('image');

                $fileName = $file->getClientOriginalName();

                $file->move($path, $fileName);

                return response()->successNoData('Upload Siswa Sukses');
            }
        } catch (\Exception $e) {
            return response()->error( $e);
        }
    }

    public function downloadImage(Request $request)
    {
        try {
            $user = $request->user();
            $file = storage_path() . "/app/public/siswa/" . $user->image;

            $headers = array('Content-Type: image/png');

            return response()->download($file, 'siswa' . $user->nis . '-' . $user->nama . '_' . uniqid() . '.png', $headers);
        } catch (\Exception $e) {
            return response()->error( $e);
        }
    }

    public function logout(Request $request)
    {
        try {
            $user = $request->user();

            $user->currentAccessToken()->delete();

            return response()->successNoData('Keluar dari Aplikasi');
        } catch (\Exception $e) {
            return response()->error( $e);
        }
    }

    public function logoutall(Request $request)
    {
        try {
            $user = $request->user();
            $user->tokens()->delete();
            return response()->successNoData('Keluar dari Aplikasi');
        } catch (\Exception $e) {
            return response()->error( $e);
        }
    }
}
