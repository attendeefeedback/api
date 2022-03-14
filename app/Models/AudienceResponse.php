<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudienceResponse extends Model
{
    //
	protected $fillable = [
        'id', 'question_id', 'answer_id', 'updated_at', 'created_at'
    ];    

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
