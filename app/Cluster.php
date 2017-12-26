<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable = [
        'cluster_id', 'description', 'label'
    ];

    public function members() {
        return $this->hasMany('App\Member','cluster_id','cluster_id');
    }
    //
}
