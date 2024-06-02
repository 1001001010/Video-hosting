<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Video, Category, Like, Comment};
use Auth;

class VideoController extends Controller
{
    public function welcome() {
        if (Auth::user() and Auth::user()->is_admin == true)
            $videos = Video::orderBy('created_at', 'DESC')->get();
        else
            $videos = Video::orderBy('created_at', 'DESC')->where('visibility', 'unban')->get();
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
        return view('dashboard', [
            'user_videos' => Video::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get(), 
            'categories' => Category::get()]);
    }

    public function watch_video($id) {
        return view('video', [
            'video' => Video::with(['user', 'category'])->where('id', $id)->find($id),
            'like' => Like::where('video_id', $id)->where('status', 'like')->get(),
            'dislike' => Like::where('video_id', $id)->where('status', 'dislike')->get(),
            'comments' => Comment::with(['video', 'user'])->where('video_id', $id)->orderBy('created_at', 'DESC')->get()]);
    }

    public function ban_video($id, $status) {
        $video = Video::where('id', $id)->first();
        Video::where('id', $id)->update(['visibility' => $status]);
        return redirect()->back();
    }

    public function like_video($id, $status) {
        $user = Auth::user();
        $like = Like::where('user_id', $user->id)->where('video_id', $id)->first();
        if ($like) {
            if ($like->status == $status) {
                $like->delete();
            } else {
                $like->status = $status;
                $like->save();
            }
        } else {
            $like_info = ([
                'user_id' => $user->id,
                'video_id' => $id,
                'status' => $status,
            ]);
            Like::create($like_info);
        }
        return redirect()->back();

    }
    public function new_comment($id, Request $request)
    {
        Comment::create([
            'user_id' => Auth::user()->id,
            'video_id' => $id,
            'message' => $request->message
        ]);
        return redirect()->back();
    }
}