<?php

namespace Project\Api;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {
    protected $table = 'notes';
    public $timestamps = false;
    protected $guarded = ['id'];
}