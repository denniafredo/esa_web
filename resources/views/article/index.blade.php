@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <style>
        .content_desc {
            padding: 20px;
        }

        .content_title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sub_title p, .sub_navi p {
            margin: 0;
        }

        .tbl_wrap {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .article-item {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            align-items: center;
            text-decoration: none;
            color: black !important;
        }


        .article-item img {
            max-width: 100px;
            border-radius: 4px;
            margin-right: 20px;
        }

        .article-content {
            font-family: sans-serif;
            display: block;
            flex-direction: column;
        }

        .grid-title {
            font-family: sans-serif;
            font-size: 1.2em;
            margin: 0 0 10px 0;
        }

        .grid-label {
            font-size: 1.2em;
            padding-bottom: 10px;
            width: 100%;
            display: block;
        }

        .grid-date {
            font-family: sans-serif;
            color: #777;
            font-size: 0.9em;
        }
    </style>
    <div class="content_desc">
        <div class="content_title">
            <div class="sub_title">
                <p>Articles</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}"> > Article </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            @foreach($data as $item)
                <a class="article-item" href="{{route('articleweb.show', $item->id)}}">
                    <img src="{{$item->coverImage}}"
                         alt="{{$locale == 'en' ? $item->contentName : $item->namaKonten}}"
                         class="grid-image">
                    <div class="article-content">
                        <h3 class="grid-title">{{$locale == 'en' ? $item->contentName : $item->namaKonten}}</h3>
                        <p class="grid-label">{{Str::limit($locale == 'en' ? $item->content : $item->konten, 100)}}
                            ...</p>
                        <p class="grid-date">{{$item->created_at->format('F j, Y')}}</p>
                    </div>
                </a>

            @endforeach
        </div>
    </div>
@endsection
