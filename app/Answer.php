<?php

namespace LaraQA;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function question(){
      return $this->belongsTo('LaraQA\Question');
    }
    public function user(){
      return $this->belongsTo('LaraQA\User');
    }
}
