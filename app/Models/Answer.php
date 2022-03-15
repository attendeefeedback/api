<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    //

	protected $fillable = [
        'id', 'question_answer', 'question_id', 'admin_id', 'updated_at', 'created_at', 'active_flag'
    ];    

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function audienceresponse()
    {
        return $this->hasMany(AudienceResponse::class);
    }
}
