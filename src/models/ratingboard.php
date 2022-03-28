<?php

namespace gamepedia\models;

use Illuminate\Database\Eloquent\Model;

class ratingboard extends Model {
    public $timestamps = false;
    protected $table = 'rating_board';
    protected $primaryKey = 'id';

    public function rating(){
        return $this->belongsTo('gamepedia\models\gamerating', 'rating_board_id');
    }
}