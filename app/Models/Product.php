<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    public function Users () {
        return $this->hasMany(Users::class, 'users_id');
    }

    public function Reviews () {
        return $this->hasMany(Reviews::class, 'product_id');
    }
}
