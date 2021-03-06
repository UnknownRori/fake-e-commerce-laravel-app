<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = "blog";

    protected $fillable = [
        'title',
        'content'
    ];

    public function User () {
        return $this->belongsTo(User::class, 'users_id');
    }

}
