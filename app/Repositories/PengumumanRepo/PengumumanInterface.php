<?php
namespace App\Repositories\PengumumanRepo;

use App\Models\Pengumuman;
use  Illuminate\Http\Request;

interface PengumumanInterface
{
    public function all();
    public function detail(Pengumuman $pengumuman);

}
