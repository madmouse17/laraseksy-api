<?php

namespace App\Models;

use App\Helper\helper;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\tahunajaran;
use App\Models\JadwalDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $guarded=[];

    // protected $casts = [
    //     'jadwal' => 'array',
    // ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

    public function jadwaldetail(){

        return $this->hasMany(JadwalDetail::class,'jadwal_id','id');
    }


    public function day(){
        return $this->hasOne(Day::class,'id','day_id');
    }

}
