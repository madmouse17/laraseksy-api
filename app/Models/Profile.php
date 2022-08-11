<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Exception;
use Mail;
use App\Mail\SendCodeMail;

class Profile extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(1000, 9999);
  
        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'token' => $code ]
        );
    
        try {
  
            $details = [
                'title' => 'Testing Email Nich',
                'code' => $code
            ];
             
            Mail::to(auth()->user()->email)->send(new SendCodeMail($details));
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
}
