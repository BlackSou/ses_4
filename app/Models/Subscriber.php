<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @property  int $id
 * @property  string $email
*/

class Subscriber extends Model
{
    use HasUuids;

    protected $fillable = [
        'email'
    ];

    protected $keyType = 'string';

    public $incrementing = false;

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

