@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent

@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>

        <li class="active">{{ $cate->name }}</li>
    </ul>
@stop

@section('title-before',$cate->name)

@section('billboard-title',$cate->name)

@section('billboard-desc',$cate->desc)

@section('content')
    <section class="section">
        <div class="section-content wrapper">

            <div class="main">
                <div class="news">
                    @foreach($news as $item)
                        <div class="item">
                            <div class="img-wrapper"><a href="{{ url($cate->uri.'/'.$item->id) }}"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->img_alt?:$item->title }}" ></a></div>
                            <div class="info">
                                <p class="new-title"><a href="{{ url($cate->uri.'/'.$item->id) }}">{{ $item->title }}</a></p>
                                {{--<p class="new-desc">
                                    {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),240) }}
                                </p>--}}
                                <p class="go"><a class="go-btn text-underline" href="{{ url($cate->uri.'/'.$item->id) }}">現在閱讀</a></p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {!! $news->links() !!}
                </div>
            </div>

        </div>
    </section>

@endsection
