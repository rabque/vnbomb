<?php

namespace App\Http\Middleware;

use App\Models\Player;
use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;
use Closure;
class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'sessionid'
    ];


}
