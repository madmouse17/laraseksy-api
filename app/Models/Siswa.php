<?php

namespace App\Models;

use App\Models\Kelas;
use App\Helper\Imageable;
use App\Models\tahunajaran;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Authenticatable
{
    use Imageable,HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];

    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }
}
