<?php
namespace App\Repositories\PengumumanRepo;

use App\Http\Resources\PengumumanCollection;
use App\Http\Resources\PengumumanResource;
use App\Models\Pengumuman;
use App\Repositories\PengumumanRepo\PengumumanInterface;
use Carbon\Carbon;

class PengumumanRepository implements PengumumanInterface
{
    public function all()
    {
        $data =new PengumumanCollection(Pengumuman::whereDate('expired','>=',Carbon::now())->select('id','image')->get());
        if ($data->isEmpty()) {
            return response()->error('Pengumuman Tidak Ditemukan',404);
        }else{
            return response()->success($data);

        }
    }
    public function detail($pengumuman)
    {
        $data =new PengumumanResource($pengumuman);
        // dd($data);
        if (!$data) {
            return response()->error('Pengumuman Tidak Ditemukan',404);
        }else{
            return response()->success($data);

        }
    }

}
