<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'username',
        'birthday',
        'profile_photo',
        'about_me',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'birthday' => 'date',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    /**
     * One-to-many: User has many news items
     */
    public function newsItems()
    {
        return $this->hasMany(NewsItem::class);
    }

    /**
     * Many-to-many: User has many game interests
     */
    public function gameInterests()
    {
        return $this->belongsToMany(GameInterest::class, 'user_game_interests');
    }

    /**
     * Check if user has a specific game interest
     */
    public function hasGameInterest($interestId): bool
    {
        return $this->gameInterests()->where('game_interest_id', $interestId)->exists();
    }

    /**
     * Get formatted display name
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->username ?: $this->name;
    }

    /**
     * Get profile photo URL
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : null;
    }

    /**
     * Get age from birthday
     */
    public function getAgeAttribute(): ?int
    {
        return $this->birthday ? $this->birthday->age : null;
    }
}