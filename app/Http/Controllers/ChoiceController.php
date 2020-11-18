<?php

namespace App\Http\Controllers;

use App\Choice;
use Validator;
use Exception;
use Illuminate\Http\Request;

class ChoiceController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createChoice(Request $request)
    {
        $validator                          = Validator::make($request->all(), [
            'description'                   => 'required|string',
            'is_correct_choice'             => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
	        	"status"                    => "error",
	        	"message"                   => $validator->errors(),
            ];
            
	        return response()->json($data, 400);
        }

        try {
            DB::beginTransaction();
            $choice                         = new Choice($request->all());
            $choice->save();
            DB::commit();
            return response()->json(['status' => 'success', 'data' => $choice, 'message' => 'Choice saved Successfully'], 201);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage(). ',' . ' Choice could not be saved, Please ensure data is inputted correctly.'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function show(Choice $choice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function edit(Choice $choice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function updateChoice(Request $request, $ref)
    {
        $validator                          = Validator::make($request->all(), [
            'description'                   => 'required|string',
            'is_correct_choice'             => 'required'
        ]);

        if ($validator->fails()) {
            $data = [
	        	"status"                    => "error",
	        	"message"                   => $validator->errors(),
            ];
            
	        return response()->json($data, 400);
        }
        
        $choice                           = Choice::find($ref);
        try {
            DB::beginTransaction();
            $choice->description          = $request->description;
            $choice->update($request->all());
            DB::commit();
            return response()->json(['status' => 'success', 'data' => $choice, 'message' => 'Choice Updated Successfully'], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage(). ',' . ' Choice could not be updated, Please ensure data is inputted correctly.'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroyChoice(Request $request, $ref)
    {
        $choice                       = Choice::find($ref);
        if($choice !== null){
            if($choice->delete()){
                $data = [
                    "status"        => "success",
                    "message"       => "Choice was deleted successfully"
                ];
            }else{
                $data = [
                    "status"        => "error",
                    "message"       => "Error deleting Choice!"
                ];
            }
        }else{
            $data = [
                "status"            => "error",
                "message"           => "No Choice found!"
            ];
        }

        return response()->json($data, 200);
    }
}
