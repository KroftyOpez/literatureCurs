<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = ['content', 'read_time', 'confirmation', 'name', 'description', 'photo'];

    public function grades() {
        return $this->hasMany(Grade::class);
    }

    public function readstatuses() {
        return $this->hasMany(ReadStatus::class);
    }

    public function historycategories() {
        return $this->hasMany(HistoryCategory::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'histories_categories', 'history_id', 'category_id');
    }
}
