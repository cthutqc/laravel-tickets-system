<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'message'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function priority():BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    public function status():BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels():BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }

    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }
}
