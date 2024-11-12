<?php

namespace ThomDavis\Fable\Tests\TestModels;

use Illuminate\Database\Eloquent\Model;
use ThomDavis\Fable\Traits\TrackHistory;

class User extends Model
{
    use TrackHistory;

    protected $fillable = [
        'first_name',
        'email',
        'password',
    ];
}