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
    public function gamePublishers(){
        return $this->belongsToMany('gamepedia\models\company', 'game_publishers', 'game_id','comp_id');
    }
}