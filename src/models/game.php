<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class game extends Model {
	public $timestamps = false;
	protected $table = 'game';
	protected $primaryKey = 'id';

    public function characters(){
        return $this->belongsToMany('gamepedia\models\character', 'game2character', 'game_id', 'character_id');
    }

    public function company(){
        return $this->belongsToMany('gamepedia\models\company', 'game_developers', 'game_id','comp_id');
    }
    public function rating(){
        return $this->belongsToMany('gamepedia\models\gamerating', 'game2rating', 'game_id', 'rating_id');
    }
    public function publisher(){
        return $this->belongsToMany('gamepedia\models\company', 'game_publishers', 'game_id','comp_id');
    }
    public function ratingboard(){
        return $this->belongsToMany('gamepedia\models\ratingboard', 'game2rating', 'game_id', 'rating_id')->withPivot('rating_board_id');
    }

    public function genre(){
        return $this->belongsToMany('gamepedia\models\genre', 'game2genre', 'game_id', 'genre_id');
    }
}