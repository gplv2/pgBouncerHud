<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    protected $fillable = [
        'cluster_id', 'description', 'label'
    ];
    //
}
