<?php

namespace ThomDavis\Fable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';

    protected $casts = [
        'old_value' => 'collection',
        'new_value' => 'collection',
    ];

    protected $fillable = [
        'user_id',
        'action',
        'old_value',
        'new_value',
    ];

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(config('auth.defaults.guard'), 'model');
    }

    public function source(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}