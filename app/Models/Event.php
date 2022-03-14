<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    //
    protected $fillable = [
        'id', 'event_title', 'event_desc', 'event_img', 'event_location', 'event_time', 'event_code', 'unique_id' , 'admin_id' , 'event_status', 'is_published', 'updated_at', 'created_at', 'active_flag'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function audienceresponse()
    {
        return $this->hasMany(AudienceResponse::class);
    }

    public function eventstatustracking()
    {
        return $this->hasMany(EventStatusTracking::class);
    }

    public function audiencefeedback()
    {
        return $this->hasMany(AudienceFeedback::class);
    }
}
