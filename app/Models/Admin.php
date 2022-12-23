<?php

namespace App\Models;

use Exception;
use App\Models\WaliKelas;
use App\Mail\SendCodeMail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $guarded = [];

    protected $hidden = ['password'];

    public function walikelas(){
        return $this->hasMany(WaliKelas::class);
    }

    public function jadwaldetail(){
        return $this->belongsTo(JadwalDetail::class);
    }

    public static function question1()
    {
        return ['Film apa yang anda lihat pertama kali?', 'Siapa nama panggilan anda?', 'Siapa nama guru favorite anda waktu sma?', 'Di mana Anda bertemu pasangan Anda?', 'Di kota mana ibu anda lahir?'];
    }
    public static function question2()
    {
        return ['Apa makanan favorite anda?', 'Apa nama tim olahraga favorit Anda?', 'Siapa nama pahlawan terbaikmu??', 'Siapa penyanyi favorite Anda?', 'Di Kota mana orang tua anda bertemu?', 'Dimana pertama kali bekerja?'];
    }

    static function generateCode($email)
    {
        $code = rand(1000, 9999);

        EmailCode::updateOrCreate(['user_id' => auth()->user()->id], ['token' => $code]);

        try {
            $details = [
                'title' => 'Tolong Verifikasi Device Anda :',
                'token' => $code,
            ];

            Mail::to($email)->send(new SendCodeMail($details));
        } catch (Exception $e) {
            //   dd() info("Error: ". $e->getMessage());
            dd($e->getMessage());
        }
    }
}
