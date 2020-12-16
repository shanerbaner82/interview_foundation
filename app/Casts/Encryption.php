<?php


namespace App\Casts;

use \Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Encryption implements CastsAttributes
{

    public function get($model, string $key, $value, array $attributes)
    {
        return $value ? Crypt::decryptString($value) : null;
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return Crypt::encryptString($value);
    }
}
