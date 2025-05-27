<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'news_item_id',
        'parent_id',
        'content',
    ];

    protected $with = ['user'];

    /**
     * Relatie met User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relatie met NewsItem
     */
    public function newsItem()
    {
        return $this->belongsTo(NewsItem::class);
    }

    /**
     * Parent comment (voor replies)
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Child comments (replies)
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    /**
     * Alle replies recursief
     */
    public function allReplies()
    {
        return $this->replies()->with('allReplies');
    }

    /**
     * Scope: alleen top-level comments
     */
    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Check of comment een reply is
     */
    public function isReply()
    {
        return !is_null($this->parent_id);
    }

    /**
     * Get formatted created date
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    /**
     * Get depth level voor styling
     */
    public function getDepthAttribute()
    {
        $depth = 0;
        $parent = $this->parent;
        
        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }
        
        return $depth;
    }
}