<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\note;
use App\Models\individu;

class NoteTrackingController extends Controller
{
    public function track(note $note,individu $individu)
    {
        $note->lecteurs()->updateExistingPivot($individu->id_individu,[
            'read_at'=>now(),
        ]);
        if(!$note->unreadLecteurs()->doesntExist()){
            $note->update(['note_status'=>true]);
        }
        $pixel=base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
        return response($pixel)->header('content-type','image/gif');
    }
}
