<?php

namespace ThomDavis\Fable\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fable extends Model
{
    use HasFactory;

    protected $table = 'fables';

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

    public function creator()
    {
        return $this->belongsTo(config('auth.defaults.guard'), 'model');
    }

    public function source()
    {
        return $this->morphTo();
    }
}