<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code', 'name'];
    // Связь с моделью Histories_categories 1:M
    public function historycategories() {
        return $this->HasMany(HistoryCategory::class);
    }
    public function histories()
    {
        return $this->belongsToMany(History::class, 'histories_categories', 'category_id', 'history_id');
    }
}
