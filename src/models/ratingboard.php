<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class ratingboard extends Model {
    public $timestamps = false;
    protected $table = 'rating_board';
    protected $primaryKey = 'id';

    public function rating(){
        return $this->belongsToMany('gamepedia\models\gamerating', 'game_rating', 'id', 'rating_board_id');
    }
}