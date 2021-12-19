<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'star',
        'comment'
    ];

    public function Product () {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function User () {
        return $this->belongsTo(Users::class, 'users_id');
    }

}
