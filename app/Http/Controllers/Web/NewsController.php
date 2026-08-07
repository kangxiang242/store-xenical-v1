<?php

namespace App\Http\Controllers\Web;

use App\Handlers\ArticleAnchorsHandler;
use App\Http\Controllers\Controller;
use App\Models\Anchor;
use App\Models\ArticleCate;
use App\Repositories\NewRepository;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newRepository;



    public function __construct(NewRepository $newRepository)
    {

        $this->newRepository = $newRepository;
    }

    public function index(Request $request){

        $uri = $request->route()->uri;
        $cate = ArticleCate::whereUri($uri)->where('status',1)->first();
        if(!$cate){
            abort(404);
        }
        $news = $this->newRepository->model()->with('cate');


        $news = $news->where('article_cate_id',$cate->id);

        $news = $news->orderBy('sort','desc')->orderBy('created_at','desc')->where('status',1)->paginate(6);


        return view('web.news.index')->with('news',$news)->with('cate',$cate);
    }


    public function show($id){

        $news = $this->newRepository->find(intval($id));
        if(!$news){
            abort(404);
        }

        $next = $this->newRepository->getNextArticle($id,$news->article_cate_id);
        $prev = $this->newRepository->getPrevArticle($id,$news->article_cate_id);
        $news->content = app(ArticleAnchorsHandler::class)->setAnchors($news->content,Anchor::get()->toArray());
        //dd(Anchor::get()->toArray());
        $news->content = app(ArticleAnchorsHandler::class)->relatedArticle($news->content,$id);

        return view('web.news.show',compact('news','next','prev'));

    }
}
