<?php
namespace App\Repositories\PengumumanRepo;

use App\Http\Resources\PengumumanCollection;
use App\Http\Resources\PengumumanResource;
use App\Models\Pengumuman;
use App\Repositories\PengumumanRepo\PengumumanInterface;

class PengumumanRepository implements PengumumanInterface
{
    public function all()
    {
        $data =new PengumumanCollection(Pengumuman::select('id','title','image','description')->get());
        return response()->success($data);
    }

}
