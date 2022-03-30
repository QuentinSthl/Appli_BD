<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class character extends Model {
    public $timestamps = false;
    protected $table = 'character';
    protected $primaryKey = 'id';


    public function games(){
        return $this->belongsToMany('gamepedia\models\game', 'game2character', 'character_id', 'game_id');
    }
}