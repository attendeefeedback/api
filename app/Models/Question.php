<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Question extends Model
{
    //
    protected $fillable = [
        'id', 'event_question', 'canned_que', 'event_id', 'admin_id', 'updated_at', 'created_at', 'active_flag'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }    

}
