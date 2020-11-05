<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;

class NoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 15; $i++){
            $note = new Note;
            $note->content = 'Note '.$i;
            if($i % 2 == 0)
                $note->user_id = 1;
            else
                $note->user_id = 2;
            $note->save();
        }
    }
}
