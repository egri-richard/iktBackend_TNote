<?php

namespace Project\Api;

use Illuminate\Database\Eloquent\Model;

class TTElements extends Model {
    protected $table = 'ttelements';
    public $timestamps = false;
    protected $guarded = ['id'];
}