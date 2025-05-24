<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
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
    public function hasGameInterest($interestId)
    {
        return $this->gameInterests()->where('game_interest_id', $interestId)->exists();
    }

    /**
     * Get formatted display name
     */
    public function getDisplayNameAttribute()
    {
        return $this->username ?: $this->name;
    }
}