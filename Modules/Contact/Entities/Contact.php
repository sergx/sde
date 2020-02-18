<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
