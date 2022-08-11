<?php

namespace App\Models;


use App\Models\Admin;
use App\Models\tahunajaran;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WaliKelas extends Model
{
    use HasFactory,HasRoles;
    protected $guard_name = 'web';
    protected $guarded=[];
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function kelas(){
        return $this->belongsTo(Kelas::class);
    }
    public function taja(){
        return $this->belongsTo(tahunajaran::class,'tahunajaran_id','id');
    }

}
