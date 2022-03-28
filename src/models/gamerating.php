<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class gamerating extends Model {
    public $timestamps = false;
    protected $table = 'game_rating';
    protected $primaryKey = 'id';

    public function games(){
        return $this->belongsToMany('gamepedia\models\game', 'game2rating', 'rating_id', 'game_id');
    }
    public function ratingboard(){
        return $this->hasMany('gamepedia\models\ratingboard', 'id');
    }
}