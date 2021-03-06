<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $table = 'subscribe';

    protected $fillable = [
        'email'
    ];

    public function User () {
        return $this->belongsTo(User::class, 'users_id');
    }
}
