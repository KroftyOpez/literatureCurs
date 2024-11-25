<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryCategory extends Model
{
    protected $fillable = ['history_id', 'category_id'];

    // Связь с моделью History M:1
    public function history() {
        return $this->belongsTo(History::class);
    }

    // Связь с моделью Category M:1
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
