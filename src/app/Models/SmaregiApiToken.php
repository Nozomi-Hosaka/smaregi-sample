<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmaregiApiToken extends Model
{
    use SoftDeletes;

    protected $table = 'smaregi_api_tokens';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'contract_id',
        'token_type',
        'access_token',
    ];
}
