<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadStatus extends Model
{
    protected $fillable = ['status', 'user_id', 'history_id'];



    // Связь с моделью History M:1
    public function history() {
        return $this->belongsTo(History::class);
    }

    // Связь с моделью User M:1
    public function user() {
        return $this->belongsTo(User::class);
    }
}
