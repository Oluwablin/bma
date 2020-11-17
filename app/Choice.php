<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Choice extends Model
{
    protected $table   = 'choices';
    protected $guarded = ['ChoiceRef'];
    public $primaryKey = 'ChoiceRef';

    public $with = ['question'];

    public function question()
    {
        return $this->belongsTo(Question::class,  'QuestionRef');
    }
}
