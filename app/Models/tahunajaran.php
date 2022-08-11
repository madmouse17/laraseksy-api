<?php

namespace App\Models;

use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Jadwal;
use App\Models\Distance;
use App\Models\WaliKelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class tahunajaran extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function siswa(){
        return $this->hasOne(Siswa::class);
    }

    public function mapel(){
        return $this->hasOne(Mapel::class);
    }
    public function distance(){
        return $this->hasOne(Distance::class);
    }
    public function jadwal(){
        return $this->hasOne(Jadwal::class);
    }
    public function walikelas(){
        return $this->hasOne(WaliKelas::class);
    }
}
