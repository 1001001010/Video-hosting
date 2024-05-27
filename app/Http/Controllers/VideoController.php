<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use auth;

class VideoController extends Controller
{
    public function welcome() {
        $videos = Video::orderBy('created_at', 'DESC')->get();
        return view('welcome', ['videos' => $videos]);
    }

    public function new_video(Request $request) {
        $validated = $request->validate([
            'video_name' => 'required',
            'video_message' => 'required',
            'video_file' => 'required|mimes:mp4'
        ]);

        $name = time(). "." . $request->video_file->extension();
        $destination = 'public/video';
        $path = $request->video_file->storeAs($destination, $name);
        $video = [
            'name' => $request->video_name,
            'description' => $request->video_message,
            'path' => $path,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id
        ];
        Video::create($video);
        return redirect()->back();
    }
}
