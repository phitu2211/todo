<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Handler\NoteHandler;
use Illuminate\Http\Request;
use Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $notes = NoteHandler::getAllByUserId($userId);
        return view('note.index',['notes'=>$notes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        try {
            $data = $request->all();
            NoteHandler::create($data);
            return redirect()->route('note.create')->with('status','Create Success');
        }catch (\Exception $e){
            return redirect()->route('note.create')->with('status',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('note.show',['note'=>$note]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = NoteHandler::find($id);
        $userId = Auth::user()->id;
        if($note->id == $userId)
            return view('note.edit',['note'=>$note]);
        else
            abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NoteRequest $request, Note $note)
    {
        try {
            $data = $request->all();
            if(NoteHandler::update($data, $note->id))
                return redirect()->route('note.show',['note'=>$note])->with('status','Update Success');
            else
                abort(401);
        }catch (\Exception $e){
            return redirect()->route('note.edit',['note'=>$note])->with('status',$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            NoteHandler::delete($id);
            return redirect()->route('note.index')->with('status','Delete Success');
        }catch (\Exception $e){
            return redirect()->route('note.index')->with('status',$e->getMessage());
        }
    }
}
