<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmaregiApiToken extends Model
{
    use SoftDeletes;

    protected $table = 'smaregi_api_tokens';
    protected $fillable = [
        'id',
        'contract_id',
        'token',
    ];
}
