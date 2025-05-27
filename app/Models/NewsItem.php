<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'content',
        'publication_date',
        'user_id',
    ];

    protected $casts = [
        'publication_date' => 'datetime',
    ];

    /**
     * Relatie met user (admin die het nieuws heeft aangemaakt)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relatie met comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    /**
     * Alleen top-level comments
     */
    public function topLevelComments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id')
            ->with('allReplies')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Comments count
     */
    public function getTotalCommentsAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Scope voor gepubliceerde items
     */
    public function scopePublished($query)
    {
        return $query->where('publication_date', '<=', now());
    }

    /**
     * Scope voor recent nieuws
     */
    public function scopeRecent($query)
    {
        return $query->orderBy('publication_date', 'desc');
    }

    /**
     * Accessor voor formatted publication date
     */
    public function getFormattedDateAttribute()
    {
        return $this->publication_date->format('d-m-Y');
    }

    /**
     * Accessor voor excerpt
     */
    public function getExcerptAttribute()
    {
        return \Str::limit($this->content, 100);
    }
}