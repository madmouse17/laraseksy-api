<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailCode extends Model
{
    use HasFactory;

    public $table = "email_verification";

    protected $fillable = [
        'user_id',
        'token',
    ];
}
