<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GameInterest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($gameInterest) {
            if (empty($gameInterest->slug)) {
                $gameInterest->slug = Str::slug($gameInterest->name);
            }
        });
    }

    /**
     * Many-to-many relationship with users
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_game_interests');
    }

    /**
     * Many-to-many relationship with news items
     */
    public function newsItems()
    {
        return $this->belongsToMany(NewsItem::class, 'news_item_game_interest');
    }
}