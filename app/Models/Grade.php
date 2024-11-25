<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['comment', 'grade', 'user_id', 'history_id'];


    // Связь с моделью User M:1
    public function user() {
        return $this->belongsTo(User::class);
    }
    // Связь с моделью History M:1
    public function history() {
        return $this->belongsTo(History::class);
    }
}
