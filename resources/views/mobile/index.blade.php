@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/index.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/wow/animate.min.css') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('static/ChartJS/chart.min.js') }}"></script>
    <script src="{{ asset('static/wow/wow.min.js') }}"></script>
    <script>
        new WOW().init();
    </script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart;

        $('#chart').waypoint(function() {
            if(!myChart){
                myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },

                    options: {

                        plugins: {

                            legend: {
                                display:false,
                                position: 'top',
                            },

                        },

                    },
                });
            }

        }, { offset: '80%' });
    </script>
    <script>

        $(".accordion>div").mouseover(function(){
            $(this).stop().animate({
                "width":"18rem"
            },200).siblings().stop().animate({
                "width":"3.875rem" //
            },200)
        })

        $(".accordion>div").mouseout(function(){
            $(".accordion>div").stop().animate({
                "width":"6.7rem"
            },200)
        })


    </script>
@stop


@section('content')

    <section class="hero">
        <div class="wrap">
            <h1 class="slogan">{!! app('cache.config')->get('home_slogan') !!}</h1>
        </div>
    </section>

    <section class="about">
        <div class="wrap">
            <div class="row">
                <div class="card">
                    <div class="flex-row">
                        <div class="content">
                            <h2 class="title">{{ app('cache.config')->get('home_lilly_about_title') }}</h2>
                            <div class="text">
                                {{ app('cache.config')->get('home_lilly_about_desc') }}
                            </div>
                            <a class="more text-underline" href="">了解更多 關於禮來</a>
                        </div>
                        <div class="image"><img src="{{ asset_upload(app('cache.config')->get('home_about_img')) }}" alt="{{ app('cache.config')->get('home_lilly_about_title') }}"></div>

                    </div>
                </div>
            </div>
            <div class="row"  id="chart">
                <div class="card">
                    <div class="flex-row-reverse">
                        <div class="content health">
                            <h2 class="title">{{ app('cache.config')->get('home_health_about_title') }}</h2>
                            <div class="text">
                                {{ app('cache.config')->get('home_health_about_desc') }}
                            </div>
                            <a class="more text-underline" href="">了解更多 關於禮來</a>
                        </div>
                        <div class="image">
                            <canvas id="myChart" ></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="channel">
        <div class="wrap">
            <h2 class="title">禮來犀利士<br>有效治療性功能障礙</h2>
            <p class="subtitle">如何獲取？</p>
            <div class="picture">
                @foreach($cialis_adv as $key=>$item)
                    @if($key>=2)
                        @break
                    @endif
                    <div class="image wow animate__animated {{ $key==0?"animate__fadeInLeft":"animate__fadeInRight" }}" data-wow-delay="{{ $key>0?$key-0.5:$key }}s"><img src="{{ asset_upload($item['img']) }}" alt="禮來犀利士"></div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="experience">
        <div class="wrap">
            <h2 class="title">{{ app('cache.config')->get('home_diversified_about_title') }}</h2>
            <div class="content">
                <div class="present">
                    <p class="text">
                        {{ app('cache.config')->get('home_diversified_about_desc') }}
                    </p>
                    <a class="more text-underline" href="">了解更多 包容性與多元化</a>
                </div>
                <div class="accordion">
                    @foreach($diversified_images as $key=>$image)
                        @if($key>=5)
                            @break
                        @endif
                        <div class="back" style="background-image: url({{asset_upload(array_get($image,'img'))}});"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="news">
        <div class="wrap">
            <div class="head">
                <h2 class="title">{{ app('cache.config')->get('home_news_about_title') }}</h2>
                <p class="text">
                    {{ app('cache.config')->get('home_news_about_desc') }}
                </p>
            </div>

            <div class="main">
                @foreach($news as $item)
                    <div class="news-item">
                        <div class="news-image">
                            <a href="{{ url($item->cate->uri.'/'.$item->id) }}"><img src="{{ asset_upload($item->img) }}" alt="{{ $item->title }}"></a>
                        </div>
                        <div class="news-info">
                            <p class="news-title">{{ $item->title }}</p>
                            <a class="more text-underline" href="{{ url($item->cate->uri.'/'.$item->id) }}">現在閱讀</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
