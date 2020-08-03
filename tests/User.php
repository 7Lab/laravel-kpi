<?php

namespace SevenLab\Kpi\Tests;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthorizableContract, AuthenticatableContract
{
    use Authorizable, Authenticatable, SoftDeletes;

    protected $guarded = [];

    protected $table = 'users';
}