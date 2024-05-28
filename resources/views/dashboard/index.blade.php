@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .article-item {
            padding: 20px;
            margin-bottom: 20px;
        }

        .article-item img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .article-item h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .article-item p.grid-label {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .article-item p.grid-date {
            font-size: 14px;
            color: #666;
        }

    </style>
    <div class="content_desc">
        <div class="content_title">
            <div class="sub_title">
                <p>{{$locale == 'en' ? $companyProfile->contentName : $companyProfile->namaKonten}}</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}"> > Company Profile </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            <div class="article-item">
                <img src="{{$companyProfile->coverImage}}"
                     alt="{{$locale == 'en' ? $companyProfile->contentName : $companyProfile->namaKonten}}">
                <p class="grid-label">{!!$locale == 'en' ? $companyProfile->content : $companyProfile->konten!!}</p>
                <p class="grid-date">{{$companyProfile->created_at? $companyProfile->created_at->format('F j, Y'):''}}</p>
            </div>
        </div>
    </div>
@endsection
