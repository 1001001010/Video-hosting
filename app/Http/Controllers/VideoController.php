<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Video, Category};
use Auth;

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
        $destination = 'public/';
        $path = $request->video_file->storeAs($destination, $name);
        $video = [
            'name' => $request->video_name,
            'description' => $request->video_message,
            'path' => 'storage/' . $name,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id
        ];
        Video::create($video);
        return redirect()->back();
    }

    public function dashboard() {
        $categories = Category::get();
        $user_video = Video::where('user_id', Auth::user()->id);
        return view('dashboard', ['user_videos' => $user_video, 'categories' => $categories]);
    }
}
