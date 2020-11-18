<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Question;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Question([
            'question'              => $row['question'],
            'is_general'            => $row['is_general'],
            'categories'            => $row['categories'],
            'point'                 => $row['point'],
            'icon_url'              => $row['icon_url'],
            'duration'              => $row['duration'],
            'choice_1'              => $row['choice_1'],
            'is_correct_choice_1'   => $row['is_correct_choice_1'],
            'icon_url_1'            => $row['icon_url_1'],
            'Choice_2'              => $row['choice_2'],
            'is_correct_choice_2'   => $row['is_correct_choice_2'],
            'icon_url_2'            => $row['icon_url_2'],
            'Choice_3'              => $row['choice_3'],
            'is_correct_choice_3'   => $row['is_correct_choice_3'],
            'icon_url_3'            => $row['icon_url_3'],
            'Choice_4'              => $row['choice_4'],
            'is_correct_choice_4'   => $row['is_correct_choice_4'],
            'icon_url_4'            => $row['icon_url_4'],
        ]);        
    }
}
