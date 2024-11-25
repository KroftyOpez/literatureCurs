<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['content', 'read_time', 'confirmation', 'name', 'description', 'photo'];

    public function grade() {
        return $this->hasMany(Grade::class);
    }

    public function readstatus() {
        return $this->hasMany(ReadStatus::class);
    }

    public function userhistory() {
        return $this->hasMany(UserHistory::class);
    }

    public function historycategory() {
        return $this->hasMany(HistoryCategory::class);
    }
}
