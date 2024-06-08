<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Helio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VideoController extends Controller
{
     
    public function index(){
        $videos = Video::latest()->paginate(15);
        return view('admin.video.index', compact('videos'));
    }
    
    public function helioindex(){
        $helios = Helio::latest()->paginate(15);
        return view('admin.helio.index', compact('helios'));
    }

    public function create(){
        return view('admin.video.create');
    }
    
    public function heliocreate(){
        return view('admin.helio.create');
    }
    
    public function store(Request $request)
    {
        $this->storeData($request, new Video());
        return back()->with('success', 'New Video has been added');
    }

    public function heliostore(Request $request)
    {
        $this->storeData($request, new Helio());
        return back()->with('success', 'New helio has been added');
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return view('admin.video.edit', compact('video'));
    }
    
    public function helioedit($id)
    {
        $helio = Helio::findOrFail($id);
        return view('admin.helio.edit', compact('helio'));
    }

    public function update(Request $request, $id)
    {
        $this->storeData($request, Video::findOrFail($id), $id);
        return back()->with('success', 'Video has been updated');
    }
    public function helioupdate(Request $request, $id)
    {
        $this->storeData($request, Helio::findOrFail($id), $id);
        return back()->with('success', 'Helio has been updated');
    }

    public function storeData($request, $data, $id = null)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:videos,title,' . $id,
            'description' => 'required|string',
            'status' => 'required|integer',
        ]);
        
        $data->title = $request->title;
        $data->slug = Str::slug($request->title);
        $data->description = $request->description;
        if($request->is_video == 1){
            $data->video = $request->video;
        }
        else{
            if(isset($request['image'])){
            $status = MediaHelper::ExtensionValidation($request['image']);
            if(!$status){
                return ['errors' => [0=>'file format not supported']];
            }
            if($id){
                $data->image = MediaHelper::handleUpdateImage($request['image'],$data->image);
            }else{
                $data->image = MediaHelper::handleMakeImage($request['image']);
            } 
        }
        }
        $data->is_video = $request->is_video;
        $data->status = $request->status;
      
        $data->save();
    }
    
     public function heliodestroy($id)
    {
        $video = Helio::findOrFail($id);
        $video->delete();
        return back()->with('success', 'Helio has been deleted');
    }


    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();
        return back()->with('success', 'Video has been deleted');
    }
}
