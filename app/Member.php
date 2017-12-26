<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    public function cluster() {
        return $this->belongsTo('App\Cluster');
    }
}
