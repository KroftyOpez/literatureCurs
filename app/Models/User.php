<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'nickname',
        'avatar',
        'birth',
        'role_id',
        'password',
        'token',
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    protected function casts(): array
    {
        return [
            'birth' => 'date',
            'password' => 'hashed',
        ];
    }

    // Связь с моделью Role M:1
    public function role() {
        return $this->belongsTo(Role::class);
    }

    // Связь с моделью Grade 1:M
    public function grade() {
        return $this->HasMany(Grade::class);
    }

    // Связь с моделью ReadStatus 1:M
    public function readstatus() {
        return $this->HasMany(ReadStatus::class);
    }

    // Связь с моделью userhistory 1:M
    public function userhistory() {
        return $this->HasMany(UserHistory::class);
    }
}
