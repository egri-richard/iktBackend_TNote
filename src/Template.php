<?php

namespace Project\Api;

use Illuminate\Database\Eloquent\Model;

class Template extends Model {
    protected $table = 'users';
    public $timestamps = false;
    protected $guarded = ['id'];
}
