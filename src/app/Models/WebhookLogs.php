<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookLogs extends Model
{
    public $incrementing = false;
    protected $table = 'webhook_logs';
    protected $fillable = [
        'id',
        'header',
        'body',
    ];
}
