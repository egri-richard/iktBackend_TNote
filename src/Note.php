<?php

namespace Project\Api;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'notes';
    public $timestamps = false;
    protected $guarded = ['id'];
}