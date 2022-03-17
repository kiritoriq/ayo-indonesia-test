<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event_log';
    protected $guarded = [
        'id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
