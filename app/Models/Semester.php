<?php

namespace App\Models;

use App\Models\Jadwal;
use App\Models\Distance;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function distance(){
        return $this->hasOne(Distance::class);
    }
    public function jadwal(){
        return $this->hasOne(Jadwal::class);
    }
}
