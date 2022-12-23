<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\tahunajaran;
use App\Models\JadwalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mapel extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }

    public function jadwaldetail(){
        return $this->belongsTo(JadwalDetail::class);
    }
}
