<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\ArticleCate;
use App\Models\Page;
use App\Models\Product;
use App\Repositories\BannerRepository;
use App\Repositories\FaqRepository;
use App\Repositories\NewRepository;
use App\Repositories\ProductRepository;

class IndexController extends Controller
{
    public function index(ProductRepository $productRepository,NewRepository $newRepository){


        $products = $productRepository->all()->take(8)->chunk(4);


        $new_news = $newRepository->newNews(3);



        $article_cate = ArticleCate::where('status',1)->orderBy('sort','desc')->limit(2)->get()->each(function($cate){
            $cate->load(['article'=>function($query){
                $query->where('status',1)->orderBy('is_recommend','desc')->orderBy('sort','desc')->limit(3);
            }]);
        });


        $banners = app(BannerRepository::class)->getPageBanner('/');




        $faqs = app(FaqRepository::class)->all();

        return view('web.index',compact('products','new_news','article_cate','banners','faqs'));
    }

    public function sitemap(){
        $article_cate = ArticleCate::where('status',1)->get();
        $pages = Page::where('status',1)->get();
        $products = Product::where('status',1)->get();
        return view('web.sitemap',compact('article_cate','pages','products'));
    }
}
