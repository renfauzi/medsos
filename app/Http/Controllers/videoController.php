<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class VideoController extends Controller
{
   
    public function index()
    {
        $videos = Video::latest()->paginate(3);
        return view('video.index', compact('videos'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

   
    public function create()
    {
        return view('video.create');
    }

    
    public function store(Request $request)
    {
    $request->validate([
        'video' => ['required', 'file', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:10000'],
        'caption' => 'nullable|max:100'
    ]);

    $video = new Video();
    $video->created_by = $request->created_by;
    $video->video = $request->file('video')->store('videos');
    $video->caption = $request->caption ?? ''; 
    $video->save();

    return Redirect::route('video.index')->with(['success' => 'Video berhasil disimpan']);
    }

    
    public function destroy(Video $video)
    {
     
        if ($video->video) {
            Storage::delete($video->video);
        }

        if ($video->delete()) {
            return redirect()->route('video.index')->with('success', 'Video berhasil dihapus!');
        }

        return redirect()->route('video.index')->with('error', 'Gagal menghapus video.');
    }
}
