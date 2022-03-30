<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class user extends Model {
    public $timestamps = false;
    protected $table = 'users';
    protected $primaryKey = 'email';

    public function comments() {
        return $this->hasMany('gamepedia\models\comment', 'email');
    }
}