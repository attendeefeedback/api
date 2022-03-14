<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Admin extends Model
{
    //

	protected $fillable = [
        'id', 'first_name', 'last_name', 'email_id', 'contact_no', 'updated_at', 'created_at', 'password','active_flag'
    ];    

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}