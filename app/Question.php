<?php

namespace LaraQA;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public function answers(){
      return $this->hasMany('LaraQA\Answer');
    }
    public function user(){
      return $this->belongsTo('LaraQA\User');
    }
}
