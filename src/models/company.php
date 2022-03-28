<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class company extends Model {
    public $timestamps = false;
    protected $table = 'company';
    protected $primaryKey = 'id';

    public function games(){
        return $this->belongsToMany('gamepedia\models\game', 'game_developers', 'comp_id','game_id');
    }
    public function gamePublish(){
        return $this->belongsToMany('gamepedia\models\game', 'game_publishers', 'comp_id','game_id');
    }
}