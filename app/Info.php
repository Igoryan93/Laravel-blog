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

    public static function createInfoTest($data, $id) {

        $info = new self;
        $info->fill($data);
        $info->user_id = $id;

        $info->save();
    }
}
