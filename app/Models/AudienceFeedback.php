<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudienceFeedback extends Model
{
    //

	protected $fillable = [
        'id', 'feedback_respose', 'event_id', 'updated_at', 'created_at'
    ];  


    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
