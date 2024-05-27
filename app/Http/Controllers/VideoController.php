<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function welcome() {
        $videos = Video::orderBy('created_at', 'DESC')->get();
        return view('welcome', ['videos' => $videos]);
    }
}
