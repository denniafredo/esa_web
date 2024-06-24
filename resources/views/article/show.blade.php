@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .blog__details--content ol li {
            list-style: decimal !important;
        }

        .blog__details--content ul li {
            list-style: disc !important;
        }
    </style>
    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="#">{{__('ARTICLE')}}</a></li>
                                <li class="breadcrumb__content--menu__items">
                                    <span>{{App::getLocale()=='en'?$data->contentName:$data->namaKonten}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start blog details section -->
        <section class="blog__details--section section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog__details--wrapper">
                            <div class="entry__blog">
                                <div class="blog__post--header mb-30">
                                    <h2 class="post__header--title mb-15">{{App::getLocale()=='en'?$data->contentName:$data->namaKonten}}</h2>
                                    <p class="blog__post--meta">Posted by : Admin / On
                                        : {{$data->created_at}} </p>
                                </div>
                                <div class="blog__thumbnail mb-30">
                                    <img class="blog__thumbnail--img border-radius-10"
                                         src="{{$data->coverImage}}" alt="blog-img">
                                </div>
                                <div class="blog__details--content">
                                    <p class="blog__details--content__desc mb-20">{!! App::getLocale()=='en'?$data->content:$data->konten !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
