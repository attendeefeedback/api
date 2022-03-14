<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventStatusTracking extends Model
{
    //
	protected $fillable = [
        'id', 'event_id', 'event_status', 'updated_at', 'created_at'
    ];    
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
