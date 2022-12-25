<?php

namespace App\Models;

use App\Helper\helper;
use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalDetail extends Model
{
    use HasFactory;

    protected $fillable=['id'];
    public function mapel()
    {

        return $this->hasOne(Mapel::class, 'id', 'mapel_id');
    }


    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class,'id','jadwal_id');
    }

    /**
     * Get all of the Admin for the JadwalDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admin()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}
