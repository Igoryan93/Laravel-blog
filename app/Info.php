<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'info_users';

    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
