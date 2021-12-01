<?php

namespace Project\Api;

use Illuminate\Database\Eloquent\Model;

class Ownership extends Model{
    protected $table = 'ownership';
    public $timestamps = false;
    protected $guarded = ['id'];
}