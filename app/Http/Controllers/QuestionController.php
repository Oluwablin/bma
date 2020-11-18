<?php

namespace App\Http\Controllers;

use App\Question;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QuestionsImport;
use Validator;
use Exception;
use DB;
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
        $questions                      = Question::paginate(10);

        return response()->json($questions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createQuestion(Request $request)
    {
        $validator                      = Validator::make($request->all(), [
            'question'                  => 'required|string',
            'is_general'                => 'required',
            'is_correct_choice_1'       => 'required',
            'is_correct_choice_2'       => 'required',
            'is_correct_choice_3'       => 'required',
            'is_correct_choice_4'       => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
	        	"status"                => "error",
	        	"message"               => $validator->errors(),
            ];
            
	        return response()->json($data, 400);
        }

        try {
            DB::beginTransaction();
            $question                     = new Question($request->all());
            $question->save();
            DB::commit();
            return response()->json(['status' => 'success', 'data' => $question, 'message' => 'Question saved Successfully'], 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage(). ',' . ' Question could not be saved, Please ensure data is inputted correctly.'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function showQuestion(Request $request, $ref)
    {
        $questions                      = Question::findorFail($ref);

        return response()->json($questions, 200);
    }

    /**
     * fetch Question By Category.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function fetchQuestionByCategory(Request $request)
    {
        $questions                      = Question::where('categories', $request->categories)->get();

        return response()->json($questions, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function updateQuestion(Request $request, $ref)
    {
        $validator                      = Validator::make($request->all(), [
            'question'                  => 'required|string',
            'is_general'                => 'required',
            'is_correct_choice_1'       => 'required',
            'is_correct_choice_2'       => 'required',
            'is_correct_choice_3'       => 'required',
            'is_correct_choice_4'       => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
	        	"status"                => "error",
	        	"message"               => $validator->errors(),
            ];
            
	        return response()->json($data, 400);
        }

        $question                       = Question::find($ref);
        try {
            DB::beginTransaction();
            $question->question         = $request->question;
            $question->update($request->all());
            DB::commit();
            return response()->json(['status' => 'success', 'data' => $question, 'message' => 'Question Updated Successfully'], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage(). ',' . ' Question could not be updated, Please ensure data is inputted correctly.'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion(Request $request, $ref)
    {
        $question                       = Question::find($ref);
        if($question !== null){
            if($question->delete()){
                $data = [
                    "status"            => "success",
                    "message"           => "Question was deleted successfully"
                ];
            }else{
                $data = [
                    "status"            => "error",
                    "message"           => "Error deleting Question!"
                ];
            }
        }else{
            $data = [
                "status"                => "error",
                "message"               => "No Question found!"
            ];
        }

        return response()->json($data, 200);
    }

    /**
     * Imort new question through excel.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $file                       = $request->file('excel_file')->getClientOriginalName();
            $filename                   = $request->excel_file->storeAs('public/excel_file', $file);
        }
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required'
        ]);

        // $validator->after(function($validator) use ($file) {
        //     if ($file !=='xlsx') {
        //         $validator->errors()->add('field', 'File type is invalid - only xlsx is allowed');
        //     }
        // });

        if ($validator->fails()) {
            $data = [
	        	"status"                => "error",
	        	"message"               => $validator->errors(),
            ];
            
	        return response()->json($data, 400);
        }

        Excel::import(new QuestionsImport, $file);

        return response()->json(['status' => 'success', 'message' => 'Excel file uploaded successfully'], 200);
    }
}
