<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'code'];

    // Связь с моделью User 1:M

    public function users() {
        return $this->hasMany(User::class);
    }
}
