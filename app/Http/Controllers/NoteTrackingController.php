<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\note;
use App\Models\individu;

class NoteTrackingController extends Controller
{
    public function track(note $note,individu $individu)
    {
        if(!$note->note_status){
            $note->update(['note_status'=>true]);
        }
        $pixel=base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
        return response($pixel)->header('content-type','image/gif');
    }
}
