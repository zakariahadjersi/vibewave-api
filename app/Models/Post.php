<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'caption', 'tags', 'image_url', 'image_id', 'location', 'creator'
    ];

    protected $casts = [
        'tags' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'creator');
    }

    public function likers(): BelongsToMany
    {
       return $this->belongsToMany(User::class); 
    }

    public function saves(): HasMany
    {
        return $this->hasMany(Saves::class);
    }
}
