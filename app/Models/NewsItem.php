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
}