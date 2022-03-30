<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    public $timestamps = true;
    protected $table = 'comments';
    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo('gamepedia\models\Users', 'user_id');
    }
    public function game() {
        return $this->belongsToMany('gamepedia\models\Games', 'games', 'id', 'id');
    }
}