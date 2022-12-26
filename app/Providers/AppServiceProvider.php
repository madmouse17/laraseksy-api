<?php

namespace App\Providers;

use App\Http\Resources\JadwalDetailResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Response::macro('success', function ($data) {
            return Response::json([
                'type'  => 'success',
                'title'  => 'Sukses',
                'data' => $data,
            ]);
        });

        Response::macro('successNoData', function ($message) {
            return Response::json([
                'type'  => 'success',
                'title'  => 'Berhasil',
                'message' => $message,
            ]);
        });

        Response::macro('error', function ($message, $status = 422) {
            return Response::json([
                'message'  => 'error',
                'errors' =>['failed' => [$message]],
            ], $status);
        });
    }
}
