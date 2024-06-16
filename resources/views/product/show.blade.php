@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .article-item {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .article-item img {
            max-width: 300px;
            height: auto;
            margin-bottom: 10px;
            margin: 0 auto 10px; /* Center align image horizontally */
            display: block; /* Ensure image is block-level for margin auto to work */
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
                <p>Product Info</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}"> > {{ $product->brand->name}} </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            <div class="article-item">
                <img src="{{$product->image}}" alt="{{App::getLocale() == 'en' ? $product->name : $product->nama}}">
                <h3>{{App::getLocale() == 'en' ? $product->name : $product->nama}}</h3>
                <p class="grid-label">{!!App::getLocale() == 'en' ? $product->description : $product->deskripsi!!}</p>
                <p class="grid-label">
                    <i>{!!App::getLocale() == 'en' ? $product->categories->pluck('name')->implode(', ') : $product->categories->pluck('nama')->implode(', ')!!}</i>
                </p>
                <p class="grid-date">{{$product->created_at->format('F j, Y')}}</p>
            </div>
        </div>
    </div>
@endsection
