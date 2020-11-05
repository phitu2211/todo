<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Handler\NoteHandler;
use Illuminate\Http\Request;
use Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = NoteHandler::getAll();

        return response()->json([
            "success" => true,
            "message" => "List notes",
            "data" => $notes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "data" => null
            ]);
        }

        $noteId = NoteHandler::create($data);
        $note = NoteHandler::find($noteId);

        return response()->json([
            "success" => true,
            "message" => "Note created successfully.",
            "data" => $note
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = NoteHandler::find($id);

        if (is_null($note)) {
            return response()->json([
                "success" => false,
                "message" => "Not found",
                "data" => null
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Get note successfully.",
            "data" => $note
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'content' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "message" => $validator->errors()->first(),
                "data" => null
            ]);
        }

        $result = NoteHandler::update($data, $id);

        if($result)
            return response()->json([
                "success" => true,
                "message" => "Note updated successfully.",
                "data" => null
            ]);
        else
            return response()->json([
                "success" => false,
                "message" => "Something went wrong",
                "data" => null
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = NoteHandler::delete($id);

        return response()->json([
            "success" => true,
            "message" => "Note deleted successfully.",
            "data" => $note
        ]);
    }
}
