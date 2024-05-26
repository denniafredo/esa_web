@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    @php
        if ($locale == 'en'){
            $title = $companyProfile->contentName;
            $content = $companyProfile->content;
        }else{
            $title = $companyProfile->namaKonten;
            $content = $companyProfile->konten;
        }
    @endphp
    <div class="content_desc">
        <div class="content_title">
            <div class="sub_title">
                <p>{{$title}}</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}">> COMPANY INFO
                    >
                    {{$title}}
                </p>
            </div>
        </div>
        <p class="sub_cont11">
            {!! $content !!}
        </p>
    </div>
@endsection
