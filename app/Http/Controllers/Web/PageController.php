<?php


namespace App\Http\Controllers\Web;


use App\Models\Page;
use App\Repositories\NewRepository;
use Illuminate\Http\Request;

class PageController extends BaseController
{



    public function index($uri,Request $request){


        $page = Page::where('uri','/'.trim($request->path(),'/'))->where('status',1)->first();
        if(!$page){
            abort(404);
        }

        return view('web.page',compact('page'));
    }


}
