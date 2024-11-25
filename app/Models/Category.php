<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['code', 'name'];

    // Связь с моделью Histories_categories 1:M
    public function historycategory() {
        return $this->HasMany(HistoryCategory::class);
    }
}
