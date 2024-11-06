<?php

namespace ThomDavis\Fable\Tests\TestModels;

use Illuminate\Database\Eloquent\Model;
use ThomDavis\Fable\Traits\HasFables;

class User extends Model
{
    use HasFables;
}