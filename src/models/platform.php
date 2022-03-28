<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class platform extends Model {
    public $timestamps = false;
    protected $table = 'platform';
    protected $primaryKey = 'id';

}