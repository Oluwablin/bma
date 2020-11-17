<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Choice;

class Question extends Model
{
    protected $table   = 'questions';
    protected $guarded = ['QuestionRef'];
    public $primaryKey = 'QuestionRef';

    public $with = ['choice'];

    public function choice()
    {
        return $this->hasMany(Choice::class, 'ChoiceRef');
    }
}
