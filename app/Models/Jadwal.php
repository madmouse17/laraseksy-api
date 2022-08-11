<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Semester;
use App\Models\tahunajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $casts = [
        'jadwal' => 'array',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }

    public function semester(){
        return $this->belongsTo(Semester::class);
    }

}
