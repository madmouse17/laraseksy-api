<?php

namespace App\Models;

use App\Models\Semester;
use App\Models\tahunajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Distance extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function semester(){
        return $this->belongsTo(Semester::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }
}
