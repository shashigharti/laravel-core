<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Robust\Core\Helpage\Site;
use Robust\Core\Models\Media;
use Robust\Core\Repositories\MediaRepository;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getMedia()
    {
        $medias = Media::get();
        return response()->json($medias);
    }

    public function uploadMedia(Request $request,MediaRepository $model)
    {

        $validator = Validator::make($request->all(),[
            'file' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()],422);
        }
        $data = $request->files;
        $model->store($data);
        return response()->json(['success' =>true]);
    }

    public function getThumbnail($id)
    {
        $thumbnail = Media::where('id',$id)->first();
        return response()->json($thumbnail);
    }

    public function profile()
    {
        return view(Site::templateResolver('core::website.user.profile'));
    }
}
