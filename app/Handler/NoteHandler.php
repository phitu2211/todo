<?php

namespace App\Handler;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteHandler{

    public static function find($id){
        $note = Note::find($id);
        return $note;
    }

    public static function getAllByUserId($id){
        $notes = Note::with('user')
            ->where('user_id',$id)
            ->orderBy('content','asc')
            ->get();
        return $notes;
    }

    public static function getAll(){
        $notes = Note::with('user')
            ->orderBy('content','asc')
            ->get();
        return $notes;
    }

    public static function update($data, $id){
        $note = self::find($id);
        dd(Auth::user()->id);
        if($note){
            if($data['user_id'] == $note->user_id) {
                $note->content = array_key_exists('content', $data)
                    ? $data['content'] : $note->content;
                $note->save();
                return true;
            }
        }
        return false;
    }

    public static function create($data)
    {
        $note = new Note();
        $note->user_id = array_key_exists('user_id', $data) ? $data['user_id'] : null;
        $note->content = array_key_exists('content', $data) ? $data['content'] : null;
        $note->save();

        return $note->id;
    }

    public static function delete($id)
    {
        $note = self::find($id);
        if ($note) {
            $note->delete();
        }
    }
}
