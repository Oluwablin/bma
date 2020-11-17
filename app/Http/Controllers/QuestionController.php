<?php

namespace App\Http\Controllers;

use App\Question;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * List all Questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function listAllQuestions()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createQuestion(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function showQuestion(Request $request, $ref)
    {
        //
    }

    /**
     * fetch Question By Category.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function fetchQuestionByCategory(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function updateQuestion(Request $request, $re)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion(Request $request, $ref)
    {
        //
    }

    /**
     * Imort new question through excel.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        Excel::import(new QuestionsImport, 'question_excel.xlsx');
    }
}
