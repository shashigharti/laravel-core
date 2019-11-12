<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Robust\Core\Helpage\Site;
use Robust\Core\Models\Media;
use Robust\Core\Repositories\MediaRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

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
        $uploads = [
            $request->file('file')
        ];
        $collection = $model->store($uploads);
        return response()->json($collection);
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

    public function marketSurvey()
    {
        return view(Site::templateResolver('core::website.market.survey'));
    }

    public function marketReport()
    {
        return view(Site::templateResolver('core::website.market.report'));
    }


}
