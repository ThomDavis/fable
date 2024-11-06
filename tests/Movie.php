<?php

namespace ThomDavis\Fable\Tests\TestModels;

use Illuminate\Database\Eloquent\Model;
use ThomDavis\Fable\Traits\HasFables;

class Movie extends Model
{
    use HasFables;
}